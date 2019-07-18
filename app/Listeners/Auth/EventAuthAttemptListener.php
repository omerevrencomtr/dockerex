<?php

namespace App\Listeners\Auth;

use App\Notifications\Auth\AuthenticationAttemptNotification;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\User;
use App\Models\User\UserAccountActivity;


class EventAuthAttemptListener
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
     * @param  Attempting $event
     * @return void
     */
    public function handle(Attempting $event)
    {
        $user = User::Where('email', '=', $event->credentials['email'])->first();
        if ($user) {
            $log = new UserAccountActivity;
            $log->user_id = $user->id;
            $log->key = 'auth_attempt';
            $log->ip_address = $this->request->getClientIp();
            $log->user_agent = $this->request->userAgent();
            $log->save();
            //$user->notify(new AuthenticationAttemptNotification($user, $this->request->getClientIp(), $this->request->userAgent()));
        }
    }
}
