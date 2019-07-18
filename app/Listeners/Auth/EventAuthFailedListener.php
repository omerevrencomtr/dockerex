<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Failed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Models\User\UserAccountActivity;
use App\User;

class EventAuthFailedListener
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
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $user = User::where('email', '=', $event->credentials['email'])->first();
        if ($user == true) {
            $log = new UserAccountActivity;
            $log->user_id = $user->id;
            $log->key = 'auth_failed';
            $log->ip_address = $this->request->getClientIp();
            $log->user_agent = $this->request->userAgent();
            $log->save();
        }
    }
}
