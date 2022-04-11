<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
        

    public function credentialsPage() {

        $logged_in_user = auth()->user();

        return view('auth.change-password', ['user' => $logged_in_user]);
    }

    public function update(User $user, Request $request) {

        $logged_in_user = auth()->user();

        if($user->id != $logged_in_user->id) 
            abort(403);
        
        $user->coinmarketcap_apikey = $request->coinmarketcap_apikey;
        $user->secret = md5($user->email);
        $user->save();

        return redirect()->back()->with('success', 'Great! The Coinmarket API Key has been updated succesfully.');  


    }

    public function credentials(Request $request) {

        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'password_repeat' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with('success', 'The Password has been changed succesfully');  

    }

}
