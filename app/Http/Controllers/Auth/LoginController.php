<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Illuminate\Http\Request;


class LoginController extends Controller
{

    public $maxAttempts = 5; // change to the max attemp you want.
    public $decayMinutes = 1; // change to the minutes you want.


    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
            'active' => '1',
        ];
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            //'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        // Load user from database
        $user = \App\User::where($this->username(), $request->{$this->username()})->first();
        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->active == 0 && $user->email_confirmed == 0) {
            $errors = [$this->username() => trans('auth.active')];
        }
        if ($request->expectsJson()) {
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {


        $userDefaultLoginType = $user->login_default_type;
        $userGoogle2faLoginActive = (bool)$user->google2fa_login_active;
        $userPhoneLoginActive = (bool)$user->phone_login_active;
        $userEmailLoginActive = (bool)$user->email_login_active;

        $twoStepVerification = new TwoStepVerificationController();

        if ($userEmailLoginActive == true) {
            $userDefaultLoginType = 'email';
        } elseif ($userPhoneLoginActive == true) {
            $userDefaultLoginType = 'phone';
        } elseif ($userGoogle2faLoginActive == true) {
            $userDefaultLoginType = 'google2fa';
        }

        if ($userPhoneLoginActive == true && $userGoogle2faLoginActive == false) {
            $twoStepVerification->setUserLoginPhoneSmsCode($user);
        }

        return response()->json([
            'message' => 'Devam etmek için doğrulama kodunu giriniz.',
            'default_login_type' => $userDefaultLoginType,
            'login_types' => ['google2fa' => $userGoogle2faLoginActive, 'phone' => $userPhoneLoginActive, 'email' => $userEmailLoginActive],
        ], 200);


    }
}
