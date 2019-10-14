<?php

namespace App\Http\Controllers;

use App\Models\Exchange\Exchange;
use App\Notifications\Auth\Verify\AuthRegisteredSmsNotification;
use App\Notifications\Auth\Verify\AuthRegisteredVoiceNotification;
use App\User;
use Storage;
use SoapClient;

class IndexController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function home(){
        return redirect()->route('dashboard.index');
    }

    public function tcno_dogrula($bilgiler)
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*
        $client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL", array('trace' => 1, 'encoding' => 'UTF-8'));
        try {
            $result = $client->TCKimlikNoDogrula([
                'TCKimlikNo' => '14284133972',
                'Ad' => 'ÖMER',
                'Soyad' => 'EVREN',
                'DogumYili' => '1997'
            ]);
            dd($result);
            if ($result->TCKimlikNoDogrulaResult) {
                echo 'T.C. Kimlik No Doğru';
            } else {
                echo 'T.C. Kimlik No Hatalı';
            }
        } catch (Exception $e) {
            echo $e->faultstring;
        }
        */
        $tlExchanges = Exchange::where('currency_selling_name', 'TL')->where('active', true)->orderby('order', 'ASC')->get();
        $exchanges = Exchange::orderby('order', 'ASC')->where('active', true)->get();
        $exchangesGroups = $exchanges->groupBy('currency_selling_id');

        return view('index', compact('tlExchanges','exchangesGroups'));

    }
}
