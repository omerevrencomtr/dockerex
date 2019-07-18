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
        $gonder = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
    <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
    <TCKimlikNo>' . $bilgiler["tcno"] . '</TCKimlikNo>
    <Ad>' . $bilgiler["isim"] . '</Ad>
    <Soyad>' . $bilgiler["soyisim"] . '</Soyad>
    <DogumYili>' . $bilgiler["dogumyili"] . '</DogumYili>
    </TCKimlikNoDogrula>
    </soap:Body>
    </soap:Envelope>';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $gonder);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'POST /Service/KPSPublic.asmx HTTP/1.1',
            'Host: tckimlik.nvi.gov.tr',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
            'Content-Length: ' . strlen($gonder)
        ));
        $gelen = curl_exec($ch);
        curl_close($ch);
        return strip_tags($gelen);
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


        $bilgiler = array(
            "isim" => "ÖMER", // Isım büyük harflerle yazılmak zorunda
            "soyisim" => "EVREN", // Soyisim Buyuk harflerle yazılmak zorunda
            "dogumyili" => "1997",
            "tcno" => "14284133972"
        );
        $sonuc = $this->tcno_dogrula($bilgiler);
        if ($sonuc == "true") {
            echo "Doğrulama başarılı";
        } else {
            echo "Doğrulama başarısız";
        }
        */
        $tlExchanges = Exchange::where('currency_selling_name', 'TL')->where('active', true)->orderby('order', 'ASC')->get();
        $exchanges = Exchange::orderby('order', 'ASC')->where('active', true)->get();
        $exchangesGroups = $exchanges->groupBy('currency_selling_id');

        return view('index', compact('tlExchanges','exchangesGroups'));

    }
}
