<?php

namespace App\Livewire;

use App\Models\Manegr;
use Livewire\Component;

class ManagerDetailingComponent extends Component
{

    public $manager;

    public function mount()
    {
        $managerId = session('detailing_managers');

        if ($managerId) {
            $this->manager = Manegr::findOrFail($managerId);
            session()->forget('detailing_managers');
        } else {
            abort(404, 'Manager not found');
        }
    }
    public function render()
    {
        return view('livewire.manager-detailing-component');
    }
}
