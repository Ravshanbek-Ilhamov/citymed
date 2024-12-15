<?php

namespace App\Livewire;

use App\Models\Nurse;
use Livewire\Component;

class NurseDetailsComponent extends Component
{
    public $nurse;

    public function mount()
    {
        $nurseId = session('detailing_nurse');

        if ($nurseId) {
            $this->nurse = Nurse::findOrFail($nurseId);
            session()->forget('detailing_nurse');
        } else {
            abort(404, 'Doctor not found');
        }
    }

    public function render()
    {
        return view('nurses.nurse-details-component', [
            'nurse' => $this->nurse,
        ])->layout('components.layouts.app');
    }
}
