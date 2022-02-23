<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CoinmarketCapAPIController extends Controller
{
    
    function latest(Request $request) {

        $currency = explode("/", $request->pair);


        $response = Http::get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest', [
        'CMC_PRO_API_KEY' => '5792c5b0-9685-4c73-8309-ab85628f5a01',
        'symbol' => trim($currency['0'])
        ]);

        $data = collect($response->json()['data']);

        return round($data->first()['quote']['USD']['price'], 5);

    }

}
