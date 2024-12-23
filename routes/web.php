<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LayoutsController;
use App\Livewire\CashierComponent;
use App\Livewire\CashierDetailsCompoent;
use App\Livewire\DirectionComponent;
use App\Livewire\DistributeWarehouseComponent;
use App\Livewire\ServiceComponent;
use App\Livewire\DoctorDetailsComponent;
use App\Livewire\DoctorsComponent;
use App\Livewire\ManagerComponet;
use App\Livewire\ManagerDetailingComponent;
use App\Livewire\MedicineCategoryComponent;
use App\Livewire\MedicineComponent;
use App\Livewire\MedicineSuppliersComponent;
use App\Livewire\NurseComponent;
use App\Livewire\NurseDetailsComponent;
use App\Livewire\PositionComponent;
use App\Livewire\PatientComponent;
use App\Livewire\PatientDetailscomponent;
use App\Livewire\RegistratorComponent;
use App\Livewire\RegistratorDetailsComponent;
use App\Livewire\SelectComponent;
use App\Livewire\WarehouseComponent;
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
Route::get('/nurse-details',NurseDetailsComponent::class);

Route::get('/categories', SelectComponent::class);
Route::get('/workers' , WorkersComponent::class);
Route::get('/worker-details' , WorkerDetails::class);

Route::get('/positions',PositionComponent::class);

Route::get('/medicines',MedicineComponent::class);
Route::get('/medicine-category',MedicineCategoryComponent::class);
Route::get('/medicine-suppliers',MedicineSuppliersComponent::class);

Route::get('/patients' , PatientComponent::class);
Route::get('/patient-details' , PatientDetailscomponent::class);


Route::get('/cashier' , CashierComponent::class);
Route::get('/cashier-details', CashierDetailsCompoent::class);

Route::get('/warehouses', WarehouseComponent::class);
Route::get('/distribute-warehouse/{id}', DistributeWarehouseComponent::class);

Route::get('/registrators',RegistratorComponent::class);
Route::get('/registrator-details',RegistratorDetailsComponent::class);

Route::get('/manager', ManagerComponet::class);
Route::get('/managers-details' , ManagerDetailingComponent::class);
