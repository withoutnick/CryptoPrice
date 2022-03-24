<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function update(User $user, Request $request) {

        $logged_in_user = auth()->user();

        if($user->id != $logged_in_user->id) 
            abort(403);
        
        $user->coinmarketcap_apikey = $request->coinmarketcap_apikey;
        $user->secret = md5($user->email);
        $user->save();

        return redirect()->back()->with('success', 'Great! Coinmarket API Key was updated succesfully.');  


    }

}
