<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    /** @use HasFactory<\Database\Factories\CashierFactory> */
    use HasFactory;

    protected $fillable = 
    [
        'first_name',
        'last_name',
        'date_of_birth',
        'email',
        'gender',
        'phone_number',
        'profile_picture',
        'address',
        'working_hours',
        'working_days',
        'salary_type',
    ];
}
