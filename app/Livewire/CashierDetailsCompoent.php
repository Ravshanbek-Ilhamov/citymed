<?php

namespace App\Livewire;

use App\Models\Cashier;
use Livewire\Component;

class CashierDetailsCompoent extends Component
{
    public $cashier;

    public function mount()
    {
        $cashierId = session('detailing_cashier');

        if ($cashierId) {
            $this->cashier = Cashier::findOrFail($cashierId);
            session()->forget('detailing_cashier');
        } else {
            abort(404, 'Doctor not found');
        }
    }

    public function render()
    {
        return view('admin-page.cashiers.cashier-details-compoent', [
            'cashier' => $this->cashier,
        ])->layout('components.layouts.app');
    }

    
}
