<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'patient_id',
        'service_id',
        'doctor_id',
        'nurse_id',
        'phone_number',
        'fullName',
        'summ',
        'payment_time',
    ]; 
}
