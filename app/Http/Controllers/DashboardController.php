<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    function index() {

        $logged_in_user = auth()->user();

        $api_key = false;
        if($logged_in_user->coinmarketcap_apikey != null) {
            $api_key = $logged_in_user->coinmarketcap_apikey;
        }

        return view('dashboard', ['api_key' => $api_key, 'user' => $logged_in_user]);

    }

    function donation() {

        $logged_in_user = auth()->user();
        return view('donation', ['user' => $logged_in_user]);

    }

    function how_it_works() {

        return view('how_it_works');

    }

}
