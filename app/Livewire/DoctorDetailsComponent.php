<?php

namespace App\Livewire;

use App\Models\Doctor;
use Livewire\Component;

class DoctorDetailsComponent extends Component
{
    public $doctor;

    public function mount()
    {
        $doctorId = session('detailing_doctor');

        if ($doctorId) {
            $this->doctor = Doctor::findOrFail($doctorId);
            session()->forget('detailing_doctor');
        } else {
            abort(404, 'Doctor not found');
        }
    }

    public function render()
    {
        return view('admin-page.doctors.doctor-details-component', [
            'doctor' => $this->doctor,
        ])->layout('components.layouts.app');
    }
}

