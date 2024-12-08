<?php

namespace App\Livewire;

use Livewire\Component;

class DoctorDetailsComponent extends Component
{

    public $doctor;

    public function mount($doctor){
        $this->doctor = $doctor;
    }

    public function render()
    {
        return view('doctors.doctor-details-component');
    }
}
