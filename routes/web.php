<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LayoutsController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'index'])->name('login.index');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
Route::get('/layouts' , [LayoutsController::class, 'index']);

Route::resource('doctors', DoctorController::class);
Route::resource('direction' , DirectionController::class);
Route::resource('service' , ServiceController::class);