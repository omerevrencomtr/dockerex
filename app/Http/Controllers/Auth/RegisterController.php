<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country\Country;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public $maxAttempts = 5; // change to the max attemp you want.
    public $decayMinutes = 1; // change to the minutes you want.

    protected function registered(Request $request, $user)
    {
        $twoStepVerification = new TwoStepVerificationController();
        $twoStepVerification->setUserRegisterPhoneSmsCode($user);
        $twoStepVerification->setUserRegisterEmailCode($user);
        return response()->json(['message' => 'Telefonunuza gönderilen doğrulama kodunu giriniz.'],
            200);
    }

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $phoneNumberCode = Country::select('phone_code')
                                  ->where('iso', $data['country'])
                                  ->first();
        $data['phone']   = $phoneNumberCode->phone_code . $data['phone'];
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:191'],
            'surname'  => ['required', 'string', 'max:191'],
            'email'    => ['required', 'string', 'email', 'max:191', 'unique:users',
            ],
            'country'  => 'required|exists:countries,iso',
            'phone'    => 'required|string|unique:users|numeric',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        $phoneNumberCode = Country::select('phone_code')
                                  ->where('iso', $data['country'])
                                  ->first();
        $phoneNumber     = $phoneNumberCode->phone_code . $data['phone'];
        return User::create([
            'name'         => $this->editTr($data['name']),
            'surname'      => $this->editTr($data['surname']),
            'email'        => strtolower($data['email']),
            'country_code' => $data['country'],
            'phone'        => $phoneNumber,
            'password'     => Hash::make($data['password']),
        ]);
    }

    protected function editTr($incoming)
    {
        $result = '';
        $words  = explode(" ", $incoming);

        foreach ($words as $word) {

            $wordLength     = strlen($word);
            $firstCharacter = mb_substr($word, 0, 1, 'UTF-8');

            if ($firstCharacter == 'Ç' or $firstCharacter == 'ç') {
                $firstCharacter = 'Ç';
            } elseif ($firstCharacter == 'Ğ' or $firstCharacter == 'ğ') {
                $firstCharacter = 'Ğ';
            } elseif ($firstCharacter == 'I' or $firstCharacter == 'ı') {
                $firstCharacter = 'I';
            } elseif ($firstCharacter == 'İ' or $firstCharacter == 'i') {
                $firstCharacter = 'İ';
            } elseif ($firstCharacter == 'Ö' or $firstCharacter == 'ö') {
                $firstCharacter = 'Ö';
            } elseif ($firstCharacter == 'Ş' or $firstCharacter == 'ş') {
                $firstCharacter = 'Ş';
            } elseif ($firstCharacter == 'Ü' or $firstCharacter == 'ü') {
                $firstCharacter = 'Ü';
            } else {
                $firstCharacter = strtoupper($firstCharacter);
            }

            $others = mb_substr($word, 1, $wordLength, 'UTF-8');
            $result .= $firstCharacter . $this->makeSmall($others) . ' ';

        }

        $final = trim(str_replace('  ', ' ', $result));
        return $final;
    }

    protected function makeSmall($incoming)
    {
        $incoming = str_replace('Ç', 'ç', $incoming);
        $incoming = str_replace('Ğ', 'ğ', $incoming);
        $incoming = str_replace('I', 'ı', $incoming);
        $incoming = str_replace('İ', 'i', $incoming);
        $incoming = str_replace('Ö', 'ö', $incoming);
        $incoming = str_replace('Ş', 'ş', $incoming);
        $incoming = str_replace('Ü', 'ü', $incoming);
        $incoming = strtolower($incoming);
        return $incoming;
    }
}
