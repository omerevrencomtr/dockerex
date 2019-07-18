<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDetailController extends Controller
{
    public function userDetail(Request $request){

        $token = $request->user()->token();
        $token->scopes = ['create','test'];
        $token->save();

        return response()->json([
            'message' => $request->user(),
            'token' => $token
        ], 200);
    }
}
