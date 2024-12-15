<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LayoutsController;
use App\Livewire\DirectionComponent;
use App\Livewire\ServiceComponent;
use App\Livewire\DoctorDetailsComponent;
use App\Livewire\DoctorsComponent;
use App\Livewire\NurseComponent;
use App\Livewire\SelectComponent;
use App\Livewire\TestComponent;
use App\Livewire\WorkerDetails;
use App\Livewire\WorkersComponent;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'index'])->name('login.index');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/layouts' , [LayoutsController::class, 'index']);

Route::resource('doctors', DoctorController::class);
Route::get('/direction' , DirectionComponent::class);
Route::get('service' , ServiceComponent::class);

Route::get('/doctors', DoctorsComponent::class);
Route::get('/doctor-details',DoctorDetailsComponent::class);

Route::get('/nurses',NurseComponent::class);


Route::get('/categories', SelectComponent::class);
Route::get('/workers' , WorkersComponent::class);
Route::get('/worker-details' , WorkerDetails::class);
