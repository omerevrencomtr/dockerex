<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ServiceController extends Controller
{

    public static function voiceKey($key)
    {
        $out =(new self())->voiceKeyGenerator($key);
        $fileId = (new self())->voiceFileUploader($out);
        return $fileId;
    }

    private function voiceKeyGenerator($key)
    {
        $chars = str_split($key);
        foreach ($chars as $char) {
            $code[]     = storage_path('app/voice/spech/' . $char . '.wav');
            $tempCode[] = storage_path('app/voice/spech/' . $char . '.wav');
        }
        array_unshift($code, storage_path('app/voice/spech/merhaba.wav'));
        array_push($code, storage_path('app/voice/spech/tekrar.wav'));
        $result = array_merge($code, $tempCode);
        $voice  = '';

        foreach ($result as $item) {
            $voice .= $item . ' ';
        }
        $out = storage_path('app/voice/text/' . $key . '.wav');
        $process = new Process("sox $voice $out");
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $out;
    }

    private function voiceFileUploader($file)
    {
        $client = new Client();
        $response = $client->request(
            'POST',
            'https://api.netgsm.com.tr/voicesms/upload',
            [
                'multipart' => [
                    [
                        'name'     => 'username',
                        'contents' => config('services.netgsm.key'),
                    ],
                    [
                        'name'     => 'password',
                        'contents' => config('services.netgsm.secret'),
                    ],
                    [
                        'name'     => 'dosya',
                        'contents' => fopen($file, 'r'),
                    ],
                ],
            ]
        );

        if ($response->getStatusCode() == 200) {
            $content = $response->getBody()->getContents();
            if ($content == '10') {
                throw new MessageException('10');
            } elseif ($content == '20') {
                throw new AuthException('20');
            } elseif ($content == '30') {
                throw new HeaderException('30');
            } elseif ($content == '40') {
                throw new ParameterException('40');
            }
            $exp = explode(' ', $content);
            //return $exp[1];
        } else {
            throw new ResponseException($response->getReasonPhrase());
        }
        return $exp[0];
    }
}
