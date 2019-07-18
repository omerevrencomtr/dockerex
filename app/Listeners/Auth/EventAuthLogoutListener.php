<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\User;
use App\Models\User\UserAccountActivity;

class EventAuthLogoutListener
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $user = User::Where('email', '=', $this->request->email)->first();
        if ($user == true) {
            $log = new UserAccountActivity;
            $log->user_id = $user->id;
            $log->key = 'auth_logout';
            $log->ip_address = $this->request->getClientIp();
            $log->user_agent = $this->request->userAgent();
            $log->save();
        }
    }
}
