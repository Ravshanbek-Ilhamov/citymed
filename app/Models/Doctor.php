<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;

    protected $fillable = [
        'fullname',
        'username',
        'gender',
        'date_of_birth',
        'email',
        'phone_number',
        'address',
        'specialization',
        'years_of_experience',
        'education',
        'working_hours',
        'is_active',
        'consultation_fee',
        'profile_picture',
        'languages',
        'bio',
    ];
}
