<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticatorCodeRequest;
use App\Http\Requests\Auth\Verify\AuthRegisteredAuthenticatorCodeRequest;
use App\Http\Requests\Auth\Verify\AuthRegisteredPhoneCodeRequest;
use App\Models\User\UserAuthCode;
use App\Notifications\Auth\Verify\AuthRegisteredEmailCodeNotification;
use App\Notifications\Auth\Verify\AuthRegisteredPhoneCallNotification;
use App\Notifications\Auth\Verify\AuthRegisteredPhoneSmsNotification;
use App\Notifications\Auth\Verify\RegisteredEmailCodeNotification;
use App\Notifications\Auth\Verify\RegisteredSuccessFullCredentialsNotification;
use App\User;
use Auth;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TwoStepVerificationController extends Controller
{

    public function setUserRegisteredPhoneSmsCode(User $user = null)
    {
        if ($user == null) {
            Auth::user();
        }
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'registered_sms';
        $userLoginCode->save();
        $user->notify(
            new AuthRegisteredPhoneSmsNotification(
                $user,
                $randomKey
            )
        );
    }

    public function setUserLoginPhoneSmsCode(User $user = null)
    {
        if ($user == null) {
            Auth::user();
        }
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'login_sms';
        $userLoginCode->save();
        $user->notify(
            new AuthRegisteredPhoneSmsNotification(
                $user,
                $randomKey
            )
        );
    }

    protected function getUserRegisteredPhoneCode(
        AuthRegisteredPhoneCodeRequest $request
    ) {
        $user = Auth::user();

        $verify = UserAuthCode::where('user_id', $user->id)
            ->where('type', 'registered_sms')
            ->orwhere('type', 'registered_call')
            ->OrderBy('created_at', 'DESC')
            ->first()
            ->getKeySecretAttribute($request->registered_phone_code);

        if ($verify) {
            session(['loginType' => 'registered_sms']);
            session(['loginVerification' => true]);
            $user->update(
                [
                    'phone_confirmed' => true,
                    'phone_login_active' => true,
                    'login_default_type' => 'phone',
                    'active' => true,
                ]
            );

            return $this->setGoogle2FaRegister($user);
        } else {
            return response()->json(
                [
                    'message' => 'Başarısız',
                    'errors' => ['Kayıt kodu hatalı'],
                ],
                422
            );
        }
    }

    private function setGoogle2FaRegister($user = null)
    {
        if ($user->google2fa_active == true) {
            return response()->json(
                ['errors' => ['Yeni kod oluşturmadan önce authenticatorü pasif duruma getirmelisiniz.']],
                422
            );
        }

        $google2fa = new Google2FA();
        $data['secret_key'] = $google2fa->generateSecretKey();
        $string = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $data['secret_key']
        );


        $data['qr_code'] = base64_encode(
            QrCode::format('png')
                ->size(600)
                ->margin(0)
                ->generate($string)
        );
        $user->google2fa_secret = $data['secret_key'];
        $user->save();

        $data['link'] = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $data['secret_key']
        );

        return response()->json(
            [
                'qr_code' => $data['qr_code'],
                'secret_key' => $data['secret_key'],
                'link' => $data['link'],
                'message' => 'Hesap güvenliğiniz maksimun düzende sağlamak için Google Authenticatorü aktifleştirmeniz önerilir.',
            ],
            200
        );

    }

    protected function setUserRegisteredPhoneCallCode(Request $request)
    {
        $user = $request->user();
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'registered_call';
        $userLoginCode->save();
        $user->notify(
            new AuthRegisteredPhoneCallNotification(
                $user,
                $randomKey
            )
        );

        return response()->json(['message' => 'Çağrı gönderildi.'], 200);
    }

    public function setUserRegisteredEmailCode(User $user)
    {
        $randomKey = str_random(50);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'registered_email';
        $userLoginCode->save();
        $user->notify(
            new AuthRegisteredEmailCodeNotification(
                $user,
                $randomKey
            )
        );
    }

    protected function getUserRegisteredEmailCode(
        $userId = null,
        $verificationCode = null
    ) {

        $verifyStep1 = UserAuthCode::where('user_id', $userId)
            ->where('type', 'registered_email')
            ->OrderBy('created_at', 'DESC')
            ->first();

        $verifyStep2 = false;
        if ($verifyStep1) {
            $verifyStep2
                = $verifyStep1->getKeySecretEmailAttribute($verificationCode);
        }


        if ($verifyStep2 == true) {
            $user = User::find($verifyStep1->user_id);
            $user->email_confirmed = true;
            $user->save();
            session(['loginType' => 'registeredEmail']);
            session(['loginVerification' => true]);

            return redirect(route('home') . '?verifyEmail=true');
        } else {
            return redirect(route('home') . '?verifyEmail=false');
        }
    }

    private function setGoogle2FAClose(AuthenticatorCodeRequest $request)
    {
        $user = Auth::user();
        $google2fa = new Google2FA();
        $secret = $request->otp_key;
        $window = 4;
        $valid = $google2fa->verifyKey(
            $user->google2fa_secret,
            $secret,
            $window
        );

        if ($valid == true) {
            $user->google2fa_active = false;
            $user->save();

            return response()->json(
                [
                    'verify' => true,
                    'message' => 'İşlem başarılı yönlendiriliyorsunuz.',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'verify' => false,
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Girilen kod hatalı'],
                ],
                422
            );
        }
    }


    protected function getGoogle2FaRegisterVerify(
        AuthRegisteredAuthenticatorCodeRequest $request
    ) {
        $user = Auth::user();
        $google2fa = new Google2FA();
        $secret = $request->registered_authenticator_code;
        $window = 4;

        $timestamp = $google2fa->verifyKeyNewer(
            $user->google2fa_secret,
            $secret,
            $user->google2fa_ts,
            $window
        );


        if ($timestamp !== false) {
            $user->update(
                [
                    'google2fa_ts' => $timestamp,
                    'google2fa_login_active' => true,
                    'login_default_type' => 'google2fa',
                ]
            );

            return response()->json(
                ['message' => 'İşlem başarılı yönlendiriliyorsunuz.'],
                200
            );
        } else {
            return response()->json(
                [
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Girilen kod hatalı'],
                ],
                422
            );
        }
        $user->save();
    }

    private function getGoogle2FALoginVerify(Request $request)
    {
        $user = Auth::user();
        $google2fa = new Google2FA();
        $secret = $request->authenticator_code;
        $window = 4;
        $valid = $google2fa->verifyKey(
            $user->google2fa_secret,
            $secret,
            $window
        );

        if ($valid == true) {
            return response()->json(
                [
                    'verify' => true,
                    'message' => 'İşlem başarılı yönlendiriliyorsunuz.',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'verify' => false,
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Girilen kod hatalı'],
                ],
                422
            );
        }
    }


    private function getSendUserCredentials(User $user)
    {

        $password = str_random(6);
        $user->password = Hash::make($password);
        $user->active = true;

        $user->save();

        $user->notify(
            new RegisteredSuccessFullCredentialsNotification(
                $user,
                $password
            )
        );
    }

    public function setUserWithdrawPhoneSmsCode(User $user = null)
    {
        if ($user == null) {
            Auth::user();
        }
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'withdraw_sms';
        $userLoginCode->save();
        $user->notify(
            new AuthRegisteredPhoneSmsNotification(
                $user,
                $randomKey
            )
        );
    }


    protected function setUserWithdrawPhoneCallCode(Request $request)
    {
        $user = $request->user();
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'withdraw_call';
        $userLoginCode->save();
        $user->notify(
            new AuthRegisteredPhoneCallNotification(
                $user,
                $randomKey
            )
        );

        return response()->json(['message' => 'Çağrı gönderildi.'], 200);
    }

    protected function getUserWithdrawPhoneCode(
        AuthRegisteredPhoneCodeRequest $request
    ) {
        $user = Auth::user();

        $verify = UserAuthCode::where('user_id', $user->id)
            ->where('type', 'registered_sms')
            ->orwhere('type', 'registered_call')
            ->OrderBy('created_at', 'DESC')
            ->first()
            ->getKeySecretAttribute($request->registered_phone_code);

        if ($verify) {
            session(['loginType' => 'registered_sms']);
            session(['loginVerification' => true]);
            $user->update(
                [
                    'phone_confirmed' => true,
                    'phone_login_active' => true,
                    'login_default_type' => 'phone',
                    'active' => true,
                ]
            );

            return $this->setGoogle2FaRegister($user);
        } else {
            return response()->json(
                [
                    'message' => 'Başarısız',
                    'errors' => ['Kayıt kodu hatalı'],
                ],
                422
            );
        }
    }



}
