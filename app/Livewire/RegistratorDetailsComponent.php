<?php

namespace App\Livewire;

use App\Models\Registrator;
use Livewire\Component;

class RegistratorDetailsComponent extends Component
{
    public $registrator;

    public function mount()
    {
        $registratorId = session('detailing_registrator');

        if ($registratorId) {
            $this->registrator = Registrator::findOrFail($registratorId);
            session()->forget('detailing_registrator');
        } else {
            abort(404, 'Registrator not found');
        }
    }

    public function render()
    {
        return view('admin-page.registrators.registrator-details-component', [
            'registrator' => $this->registrator,
        ])->layout('components.layouts.app');
    }
}
