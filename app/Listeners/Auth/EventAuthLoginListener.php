<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Models\User\UserAccountActivity;

class EventAuthLoginListener
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->remember == true) {
            $operation = 'auth_login';
        } else {
            $operation = 'auth_login_remember';
        }
        $log = new UserAccountActivity;
        $log->user_id = $event->user->id;
        $log->key = $operation;
        $log->ip_address = $this->request->getClientIp();
        $log->user_agent = $this->request->userAgent();
        $log->save();
    }
}
