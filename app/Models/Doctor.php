<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'gender',
        'per_patient_time',
        'date_of_birth',
        'email',
        'phone_number',
        'address',
        'specialization',
        'years_of_experience',
        'working_hours',
        'is_active',
        'consultation_fee',
        'profile_picture',
        'bio',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
