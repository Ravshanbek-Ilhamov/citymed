<?php

namespace App\Livewire;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class MedicineComponent extends Component
{
    use WithPagination;
    public $createForm = false, $editingForm = false;
    public $categories,$suppliers;
    public function render()
    {
        $medicines = Medicine::paginate(10);
        $this->categories = MedicineCategory::all();
        $this->suppliers = Supplier::all();
        return view('medicines.index', ['medicines' => $medicines]);
    }

    public function SetcreateForm()
    {
        $this->createForm = true;
    }

    public function cancel()
    {
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }
}
