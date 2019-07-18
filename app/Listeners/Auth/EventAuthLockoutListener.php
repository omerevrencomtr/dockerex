<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\User;
use App\Models\User\UserAccountActivity;

class EventAuthLockoutListener
{
    protected $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Handle the event.
     *
     * @param  Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        $user = User::Where('email', '=', $this->request->email)->first();
        if ($user == true) {
            $log = new UserAccountActivity;
            $log->user_id = $user->id;
            $log->key = 'auth_lockout';
            $log->ip_address = $this->request->getClientIp();
            $log->user_agent = $this->request->userAgent();
            $log->save();
        }
    }
}
