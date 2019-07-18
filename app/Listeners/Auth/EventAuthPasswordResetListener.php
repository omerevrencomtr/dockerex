<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Models\User\UserAccountActivity;

class EventAuthPasswordResetListener
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
     * @param  PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $log = new UserAccountActivity;
        $log->user_id = $event->user->id;
        $log->key='auth_password_reset';
        $log->ip_address=$this->request->getClientIp();
        $log->user_agent=$this->request->userAgent();
        $log->save();
    }
}
