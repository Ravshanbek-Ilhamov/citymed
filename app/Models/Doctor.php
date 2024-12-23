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
        'direction_id',
        'years_of_experience',
        'working_hours',
        'is_active',
        'consultation_fee',
        'profile_picture',
        'bio',
        'working_days',
        'salary_type',
        'salary',
    ];

    public function direction()
    {
        return $this->belongsTo(Direction::class,'direction_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'doctor_services', 'doctor_id', 'service_id');
    }
}
