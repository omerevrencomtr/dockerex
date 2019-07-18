<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Verify\Login\AuthVerifyLoginAuthenticatorRequest;
use App\Http\Requests\Auth\Verify\Login\AuthVerifyLoginPhoneRequest;
use App\Http\Requests\Auth\Verify\Register\AuthVerifyRegisterAuthenticatorRequest;
use App\Http\Requests\Auth\Verify\Register\AuthVerifyRegisterPhoneRequest;
use App\Models\User\UserAuthCode;
use App\Notifications\Auth\Verify\Login\AuthVerifyLoginPhoneCallNotification;
use App\Notifications\Auth\Verify\Login\AuthVerifyLoginPhoneSmsNotification;
use App\Notifications\Auth\Verify\Register\AuthVerifyRegisterEmailNotification;
use App\Notifications\Auth\Verify\Register\AuthVerifyRegisterPhoneCallNotification;
use App\Notifications\Auth\Verify\Register\AuthVerifyRegisterPhoneSmsNotification;
use App\Notifications\Dashboard\Balance\Verify\DashboardBalanceVerifyPhoneCallNotification;
use App\Notifications\Dashboard\Balance\Verify\DashboardBalanceVerifyPhoneSmsNotification;
use App\User;
use Auth;
use Carbon\Carbon;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;

class TwoStepVerificationController extends Controller
{

    /* Kayıt ekranı doğrulama kodu gönder */
    public function setUserRegisterPhoneSmsCode(User $user = null)
    {

        if ($user == null) {
            Auth::user();
        }
        $time=Carbon::now()->subMinutes(2);
        $oldCode = UserAuthCode::where('user_id',$user->id)
            ->where('type','register_sms')
            ->where('created_at','>=',$time)
            ->orderby('created_at','DESC')
            ->first();
        if ($oldCode){
            return response()->json(['errors'=>['Yeni sms almadan önce 2 dakika beklemelisiniz.']],422);
        }
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'register_sms';
        $userLoginCode->save();
        $user->notify(
            new AuthVerifyRegisterPhoneSmsNotification(
                $user,
                $randomKey
            )
        );
    }

    /* Sms almazsa arama gönder */
    protected function setUserRegisterPhoneCallCode()
    {

        $user = Auth::user();
        $time=Carbon::now()->subMinutes(2);
        $oldCode = UserAuthCode::where('user_id',$user->id)
            ->where('type','register_call')
            ->where('created_at','>=',$time)
            ->orderby('created_at','DESC')
            ->first();
        if ($oldCode){
            return response()->json(['errors'=>['Yeni arama almadan önce 2 dakika beklemelisiniz.']],422);
        }
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'register_call';
        $userLoginCode->save();
        $user->notify(
            new AuthVerifyRegisterPhoneCallNotification(
                $user,
                $randomKey
            )
        );

        return response()->json(['message' => 'Çağrı gönderildi.'], 200);
    }

    /* girilen kodu check et */
    protected function getUserRegisterPhoneCode(
        AuthVerifyRegisterPhoneRequest $request
    )
    {
        $user = Auth::user();

        $verify = UserAuthCode::where('user_id', $user->id)
            ->where('type', 'register_sms')
            ->orwhere('type', 'register_call')
            ->OrderBy('created_at', 'DESC')
            ->first()
            ->getKeySecretAttribute($request->phone_code);

        if ($verify) {
            $value = session(['twoStepVerification' => 'register']);

            $user->update(
                [
                    'phone_confirmed' => true,
                    'phone_login_active' => true,
                    'login_default_type' => 'phone',
                    'active' => true,
                ]
            );
            $user->save();

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

    /* authenticator kodu oluştur */
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

    /* authenticator kodu register check et */
    protected function getGoogle2FaRegisterVerify(
        AuthVerifyRegisterAuthenticatorRequest $request
    )
    {
        $user = Auth::user();
        if ($user->google2fa_active == true) {
            return response()->json(
                ['errors' => ['Yeni kod oluşturmadan önce authenticatorü pasif duruma getirmelisiniz.']],
                422
            );
        }
        $google2fa = new Google2FA();
        $secret = $request->authenticator_code;
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


    /* email doğrulama kodu oluştur */
    public function setUserRegisterEmailCode(User $user)
    {
        $randomKey = str_random(50);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'register_email';
        $userLoginCode->save();
        $user->notify(
            new AuthVerifyRegisterEmailNotification(
                $user,
                $randomKey
            )
        );
    }

    /* email doğrulama kodu check et */
    protected function getUserRegisterEmailCode(
        $userId = null,
        $verificationCode = null
    )
    {

        $verifyStep1 = UserAuthCode::where('user_id', $userId)
            ->where('type', 'register_email')
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

            return redirect(route('home') . '?verifyEmail=true');
        } else {
            return redirect(route('home') . '?verifyEmail=false');
        }
    }



    /* Login */

    /* Login İşlemleri */

    /* Kayıt ekranı doğrulama kodu gönder */
    public function setUserLoginPhoneSmsCode(User $user = null)
    {
        if ($user == null) {
            Auth::user();
        }
        if (!$user->phone_login_active) {
            return response()->json(
                [
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Telefon ile giriş pasif durumda'],
                ],
                422
            );
        }

        $time=Carbon::now()->subMinutes(2);
        $oldCode = UserAuthCode::where('user_id',$user->id)
            ->where('type','login_sms')
            ->where('created_at','>=',$time)
            ->orderby('created_at','DESC')
            ->first();
        if ($oldCode){
            return response()->json(['errors'=>['Yeni arama almadan önce 2 dakika beklemelisiniz.']],422);
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
            new AuthVerifyLoginPhoneSmsNotification(
                $user,
                $randomKey
            )
        );
    }

    /* Sms almazsa arama gönder */
    protected function setUserLoginPhoneCallCode()
    {
        $user = Auth::user();

        $time=Carbon::now()->subMinutes(2);
        $oldCode = UserAuthCode::where('user_id',$user->id)
            ->where('type','login_call')
            ->where('created_at','>=',$time)
            ->orderby('created_at','DESC')
            ->first();
        if ($oldCode){
            return response()->json(['errors'=>['Yeni arama almadan önce 2 dakika beklemelisiniz.']],422);
        }


        if (!$user->phone_login_active) {
            return response()->json(
                [
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Telefon ile giriş pasif durumda'],
                ],
                422
            );
        }
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'login_call';
        $userLoginCode->save();
        $user->notify(
            new AuthVerifyLoginPhoneCallNotification(
                $user,
                $randomKey
            )
        );

        return response()->json(['message' => 'Çağrı gönderildi.'], 200);
    }

    /* girilen kodu check et */
    protected function getUserLoginPhoneCode(
        AuthVerifyLoginPhoneRequest $request
    )
    {
        $user = Auth::user();
        if (!$user->phone_login_active) {
            return response()->json(
                [
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Telefon ile giriş pasif durumda'],
                ],
                422
            );
        }
        $verify = UserAuthCode::where('user_id', $user->id)
            ->where('type', 'login_sms')
            ->orwhere('type', 'login_call')
            ->OrderBy('created_at', 'DESC')
            ->first()
            ->getKeySecretAttribute($request->phone_code);

        if ($verify) {

            $value = session(['twoStepVerification' => 'phone']);

            return response()->json(
                [
                    'message' => 'Giriş işlemi başarılı yönlendiriliyorsunuz.',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'message' => 'Başarısız',
                    'errors' => ['Girmiş olduğunuz kod hatalı'],
                ],
                422
            );
        }
    }


    /* authenticator kodu register check et */
    protected function getGoogle2FaLoginVerify(
        AuthVerifyLoginAuthenticatorRequest $request
    )
    {
        $user = Auth::user();
        if (!$user->google2fa_login_active) {
            return response()->json(
                [
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Google Authenticator pasif durumda'],
                ],
                422
            );
        }
        $google2fa = new Google2FA();
        $secret = $request->authenticator_code;
        $window = 4;

        $timestamp = $google2fa->verifyKeyNewer(
            $user->google2fa_secret,
            $secret,
            $user->google2fa_ts,
            $window
        );


        if ($timestamp !== false) {

            $value = session(['twoStepVerification' => 'authenticator']);
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


    public function setUserWithdrawPhoneSmsCode(User $user = null, $amount, $address, $currency)
    {
        if ($user == null) {
            Auth::user();
        }

        $time=Carbon::now()->subMinutes(2);
        $oldCode = UserAuthCode::where('user_id',$user->id)
            ->where('type','withdraw_sms')
            ->where('created_at','>=',$time)
            ->orderby('created_at','DESC')
            ->first();
        if ($oldCode){
            return response()->json(['errors'=>['Yeni arama almadan önce 2 dakika beklemelisiniz.']],422);
        }


        if (!$user->phone_login_active) {
            return response()->json(
                [
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Telefon ile giriş pasif durumda'],
                ],
                422
            );
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
            new DashboardBalanceVerifyPhoneSmsNotification(
                $user,
                $randomKey, $amount, $address, $currency
            )
        );
        return $userLoginCode->id;
    }

    /* Sms almazsa arama gönder */
    protected function setUserWithdrawPhoneCallCode()
    {
        $user = Auth::user();
        if (!$user->phone_login_active) {
            return response()->json(
                [
                    'message' => 'Girilen kod hatalı',
                    'errors' => ['Telefon ile giriş pasif durumda'],
                ],
                422
            );
        }

        $time=Carbon::now()->subMinutes(2);
        $oldCode = UserAuthCode::where('user_id',$user->id)
            ->where('type','withdraw_call')
            ->where('created_at','>=',$time)
            ->orderby('created_at','DESC')
            ->first();
        if ($oldCode){
            return response()->json(['errors'=>['Yeni arama almadan önce 2 dakika beklemelisiniz.']],422);
        }
        $randomKey = rand(100000, 999999);
        $userLoginCode = new UserAuthCode;
        $userLoginCode->user_id = $user->id;
        $userLoginCode->setKeySecretAttribute($randomKey);
        $userLoginCode->phone = $user->phone;
        $userLoginCode->email = $user->email;
        $userLoginCode->type = 'withdraw_call';
        $userLoginCode->save();
        $user->notify(
            new DashboardBalanceVerifyPhoneCallNotification(
                $user,
                $randomKey
            )
        );

        return response()->json(['message' => 'Çağrı gönderildi.'], 200);
    }

    /* girilen kodu check et */
    public function getUserWithdrawPhoneCode($user, $code)
    {

        if (!$user->phone_login_active) {
            return false;
        }
        $verify = UserAuthCode::where('user_id', $user->id)
            ->where('type', 'withdraw_sms')
            ->orwhere('type', 'withdraw_call')
            ->OrderBy('created_at', 'DESC')
            ->first()
            ->getKeySecretAttribute($code);

        if ($verify) {
            return true;
        } else {
            return false;
        }
    }


    /* authenticator kodu register check et */
    public function getGoogle2FaWithdrawVerify(User $user, $code)
    {
        if ($user->google2fa_active == true) {
            return false;
        }
        $google2fa = new Google2FA();
        $secret = $code;
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
                ]
            );
            $user->save();
            return true;
        } else {
            return false;
        }

    }


}
