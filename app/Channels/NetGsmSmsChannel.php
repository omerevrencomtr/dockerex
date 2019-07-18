<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use SoapClient;
use Carbon\Carbon;

class NetGsmSmsChannel
{

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return void
     */

    /**
     * $notifiable = User model
     * $message = Data
     */

    public function send($notifiable, Notification $notification)
    {
            $dateTime = Carbon::now()->addMinutes(2)->format('dmYHi');
            $message = $notification->toNetGsmSms($notifiable);
            $client = new SoapClient("http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl");
            $result = $client->sms_gonder_1n(array('username' => config('services.netgsm.key'), 'password' => config('services.netgsm.secret'), 'company' => '', 'header' => config('services.netgsm.from'), 'msg' => $message, 'gsm' => $notifiable->phone, 'encoding' => 'TR', 'startdate' => '', 'stopdate' => $dateTime,));
    }

}
