<?php

namespace App\Http\Controllers\Dashboard\User\Activity\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class UserActivityAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.user.activity.account.index');
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
    public function show(Request $request)
    {
        //print_r($request->all());
        $user = Auth::user();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = 'created_at';
        $dir = 'DESC';

        $posts = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userAccountActivity()
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = User::where('id', $user->id)
            ->select('id')
            ->first()
            ->userAccountActivity()
            ->count();

        $data = array();

        if ($posts) {
            $agent = new Agent();
            foreach ($posts as $r) {
                $agent->setUserAgent($r->user_agent);
                $device = $agent->device();
                $platform = $agent->platform();
                $browser = $agent->browser();
                if ($browser == 'Chrome') {
                    $browserIcon = 'fa fa-chrome';
                } elseif ($browser == 'Firefox') {
                    $browserIcon = 'fa fa-firefox';
                } elseif ($browser == 'Opera') {
                    $browserIcon = 'fa fa-opera';
                } elseif ($browser == 'Mozilla') {
                    $browserIcon = 'fa fa-firefox';
                } elseif ($browser == 'Safari') {
                    $browserIcon = 'fa fa-safari';
                } elseif ($browser == 'Edge') {
                    $browserIcon = 'fa fa-edge';
                } else {
                    $browserIcon = 'fa fa-question-circle';
                }

                $nestedData['data'] = ' <div class="Notification__avatar pull-left">
                                                       <i class="fa ' . $browserIcon . ' fa-3x"></i>
                                                    </div>
                                                    <div class="Notification__highlight">
                                                        <p class="Notification__highlight-excerpt"><b>' . $r->created_at . '</b></p>
                                                        <p class="Notification__highlight-excerpt">' . $device . ', ' . $platform . ' işletim sistemi ve ' . $browser . '  tarayıcısıyla başarısız oturum açma isteği. </p>
                                                        <p class="Notification__highlight-time">IP adresi: ' . $r->ip_address . ' </p>
                                                    </div>';
                $data[] = $nestedData;
            }
        }


        return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalFiltered),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data]
            , 200);

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
