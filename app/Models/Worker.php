<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;


    protected $fillable = 
    [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'profile_image',
        'phone_number',
        'address',
        'specialization',
        'working_hours',
        'salary_type',  
        'is_active',
    ];
}
