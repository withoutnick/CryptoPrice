<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Cache;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CoinmarketCapAPIController extends Controller
{
    
    function latest(Request $request) {

        $currency = explode("/", $request->pair);

        $user = User::where('secret', $request->secret)->first();

        if(!$user) {
            abort(403);
        }

        $request_endpoint = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';

        $request_parameters = [
          'CMC_PRO_API_KEY' => $user->coinmarketcap_apikey,
          'symbol' => trim($currency['0']),
          'convert' => $currency['1']
        ];

        $stack = HandlerStack::create();
        $stack->push(  new CacheMiddleware(
                  new GreedyCacheStrategy(
                    new LaravelCacheStorage(
                      Cache::store('file')
                    ), 1800
                  )
                ),
                'cache');

        $options = ['handler' => $stack];

        $response = Http::withOptions($options)->get($request_endpoint, $request_parameters);

        $data = collect($response->json()['data']);

        $price = round($data->first()['quote'][$currency['1']]['price'], 5);

        if(isset($request->version) && $request->version == 'gdocs')
          $price = str_replace(".", ",", $price);

        return $price;

    }

    function testKey(Request $request) {

      $user = Auth::user();

      $request_parameters = [
        'CMC_PRO_API_KEY' => $user->coinmarketcap_apikey,
        'symbol' => 'CAS',
      ];  

      $request_endpoint = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
      $response = Http::get($request_endpoint, $request_parameters);

      if($response->status() == '401') 
        return redirect()->back()->withErrors(['msg' => 'Your Coinmarketcap API key is not valid.']);
      else {
        return redirect()->back()->with('success', 'Great! Your API key is valid.');
      }
      


    }

}
