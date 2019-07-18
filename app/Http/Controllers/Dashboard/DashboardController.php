<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\PrivateEvent;
use App\Events\UserDestroyEvent;
use App\Models\Blog\BlogCategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Exchange\Exchange;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index(Request $request)
    {

        $ex=Exchange::all();
        foreach ($ex as $e) {
            broadcast(new \App\Events\TickerEvent($e->id));
        }

        /*
                $object='Merhaba dünya';
                $user=User::find('42fe75d4-3744-499f-834c-703fb6143d93');
                broadcast(new PrivateEvent($user,$object));
                $user = Auth::user();
                $userDefaultLoginType=$user->login_default_type;
                $userGoogle2faActive=(bool)$user->google2fa_login_active;
                $userPhoneLoginActive=(bool)$user->phone_login_active;
                $userEmailLoginActive=(bool)$user->email_login_active;

                return response()->json([
                    'default_login_type'  => $userDefaultLoginType,
                    'login_types' => ['google2fa'=>$userGoogle2faActive,'phone'=>$userPhoneLoginActive,'email'=>$userEmailLoginActive],
                ], 200);
          */
        $tlExchanges = Exchange::where('currency_selling_name', 'TL')->where('active', true)->orderby('order', 'ASC')->get();
        $exchanges = Exchange::orderby('order', 'ASC')->where('active', true)->get();
        $exchangesGroups = $exchanges->groupBy('currency_selling_id');

        $category=BlogCategory::where('title','Medium')->where('active',true)->first();


        return view('dashboard.index', compact('tlExchanges','exchangesGroups','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
