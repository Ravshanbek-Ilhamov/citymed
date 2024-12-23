<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manegr extends Model
{
    /** @use HasFactory<\Database\Factories\ManegrFactory> */
    use HasFactory;

    protected $fillable = 
    [
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'gender',
        'address',
        'salary_type',
        'salary',
        'email',
        'profile_picture',
        'role',
        'working_days',
        'working_hours',
        'is_active',
    ];
}
