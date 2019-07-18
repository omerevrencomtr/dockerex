<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    protected $redirectTo = '/';

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
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
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
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        //$request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request)
    {
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Web Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addDays(7);
        }
        $token->save();

        $userDefaultLoginType = $user->login_default_type;
        $userGoogle2faLoginActive = (bool)$user->google2fa_login_active;
        $userPhoneLoginActive = (bool)$user->phone_login_active;
        $userEmailLoginActive = (bool)$user->email_login_active;


        if ($userGoogle2faLoginActive == true) {
            $userDefaultLoginType = 'google2fa';
        } elseif ($userPhoneLoginActive == true) {
            $userDefaultLoginType = 'phone';
        } elseif ($userEmailLoginActive == true) {
            $userDefaultLoginType = 'email';
        } else {

        }

        if ($userDefaultLoginType=='phone'){
            $twoStepVerification = new TwoStepVerificationController();
            $twoStepVerification->setUserLoginPhoneSmsCode($user);
        }

        return response()->json([
            'default_login_type' => $userDefaultLoginType,
            'login_types' => ['google2fa' => $userGoogle2faLoginActive, 'phone' => $userPhoneLoginActive, 'email' => $userEmailLoginActive],
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);



        return response()->json([
            'message' => 'Devam etmek için doğrulama kodunu giriniz.',

        ], 200);


    }

}
