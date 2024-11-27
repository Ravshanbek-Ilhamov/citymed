<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login.index');
    }

    public function login(LoginUserRequest $request){

        // dd($request->all());
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); 
        } else {
            return back()->withErrors(['login' => 'These data do not match our records.']);
        }
    }

    public function dashboard(){
        return view('index');
    }
}
