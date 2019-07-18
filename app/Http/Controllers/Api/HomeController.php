<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function test()
    {
        return response()->json([
            "page" => "ömer",
            "pageSize" => "ömer",
            "sorted" => "evren",
            "filtered" => ["","",""]],
            200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['test'=>'test'],200);
    }
}
