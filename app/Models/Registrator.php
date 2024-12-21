<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrator extends Model
{
    /** @use HasFactory<\Database\Factories\RegistratorFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'gender',
        'date_of_birth',
        'email',
        'phone_number',
        'address',
        'working_hours',
        'is_active',
        'profile_picture',
        'bio',
        'working_days',
        'salary_type',
        'salary',
    ];
}
