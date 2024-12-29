<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){

        if (Auth::check()) {
            Auth::logout();
        }

        return view('auth.login.index');
    }

    public function login(LoginUserRequest $request){

        $credentials = $request->only('username', 'password');

        // dd($credentials);
        if (Auth::attempt($credentials)) {
            return redirect('/doctors'); 
        } else {
            return back()->withErrors(['login' => 'These data do not match our records.']);
        }
    }
}
