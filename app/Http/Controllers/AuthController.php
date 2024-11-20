<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login.index');
    }

    public function login(LoginUserRequest $request){

        dd($request->all());


        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); // Redirect to the intended page or dashboard
        } else {
            return back()->withErrors(['login' => 'These credentials do not match our records.']);
        }
    }

    public function dashboard(){
        return view('index');
    }
}
