<?php

namespace App\Channels;

use Carbon\Carbon;
use Storage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class NetGsmVoiceChannel
{

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     *
     * @return void
     */

    /**
     * $notifiable = User model
     * $message = Data
     */

    public function send($notifiable, Notification $notification)
    {

        $fileId = $notification->toNetGsmVoice($notifiable);

        $call = new Client();
        $callDateTime = Carbon::now()->addMinutes(2);
        $callXml = "<?xml version='1.0'?>
<mainbody>
<header>
<company>Netgsm</company>
<usercode>".config('services.netgsm.key')."</usercode>
<password>".config('services.netgsm.secret')."</password>
<startdate></startdate>
<starttime></starttime>
<stopdate>".$callDateTime->format('dmY')."</stopdate>
<stoptime>".$callDateTime->format('Hi')."</stoptime>
<key>0</key>
<version>1</version>
</header>
<body>
<audioid>".$fileId."</audioid>
<no>".$notifiable->phone."</no>
</body>
</mainbody>";

        $response = $call->request(
            'POST',
            'https://api.netgsm.com.tr/voicesms/send/xml',
            [
                'headers' => [
                    'Content-Type' => 'text/xml; charset=UTF8',
                ],
                'body' => $callXml,
            ]
        );

        if($response->getStatusCode() == 200){
            $content = $response->getBody()->getContents();
            if($content == '30'){
                throw new MessageException('30');
            }
            elseif($content=='40'){
                throw new AuthException('40');
            }
            elseif($content=='45'){
                throw new HeaderException('45');
            }
            elseif($content=='70'){
                throw new ParameterException('70');
            }
            $exp=explode(' ',$content);
            return $exp[1];
        } else {
            throw new ResponseException($response->getReasonPhrase());
        }
    }

}
