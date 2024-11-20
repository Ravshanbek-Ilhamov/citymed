<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/',[AuthController::class,'index'])->name('login.index');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');