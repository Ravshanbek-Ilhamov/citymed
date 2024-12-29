<?php

namespace App\Livewire;

use App\Models\Patient;
use Livewire\Component;

class PatientDetailscomponent extends Component
{
    public $patient;

    public function mount()
    {
        $patientId = session('detailing_patient');

        if ($patientId) {
            $this->patient = Patient::findOrFail($patientId);
            session()->forget('detailing_patient');
        } else {
            abort(404, 'Patient not found');
        }
    }

    public function render()
    {
        return view('admin-page.patients.patient-detailscomponent');
    }
}
