<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User\UserAccountActivity;
use Illuminate\Http\Request;

class EventAuthAuthenticatedListener
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
     * @param  Authenticated $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        /*
        $log = new UserAccountActivity;
        $log->user_id = $event->user->id;
        $log->key = 'auth_authenticated';
        $log->ip_address = $this->request->getClientIp();
        $log->user_agent = $this->request->userAgent();
        $log->save();
        */
    }
}
