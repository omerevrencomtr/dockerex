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
        $tlExchanges = Exchange::where('currency_selling_name', 'TL')->where('active', true)->orderby('order', 'ASC')->get();
        $exchanges = Exchange::orderby('order', 'ASC')->where('active', true)->get();
        $exchangesGroups = $exchanges->groupBy('currency_selling_id');

        return view('index', compact('tlExchanges','exchangesGroups'));

    }
}
