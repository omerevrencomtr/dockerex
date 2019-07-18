<?php

namespace App\Http\Controllers\Template;

use App\Models\Country\Country;
use App\Models\Exchange\Exchange;
use App\Models\User\UserBalance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    static function getCountries()
    {
        $countries = Country::orderBy('full_name', 'ASC')->get();
        return $countries;
    }

    static function getExchangeMenu()
    {
        $exchanges = Exchange::orderby('order','ASC')->where('active',true)->get();
        $groups=$exchanges->groupBy('currency_selling_id');

        return $groups;
    }

}
