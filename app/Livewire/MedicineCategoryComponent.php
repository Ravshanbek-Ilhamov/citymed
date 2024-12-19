<?php

namespace App\Livewire;

use App\Models\MedicineCategory;
use Livewire\Component;
use Livewire\WithPagination;

class MedicineCategoryComponent extends Component
{
    use WithPagination;

    public $createForm = false, $editingForm = false;
    public $name, $description,$medicineCategoryIdBeingEdited, $deleteId, $search = '';

    public $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function render()
    {
        $medicineCategories = MedicineCategory::where('name', 'like' ,$this->search . '%')
        ->paginate(10);
        return view('medicines.medicine-category', compact('medicineCategories'));
    }

    public function SetcreateForm(){
        $this->createForm = true;
    }


    public function store(){

        $this->validate();
        MedicineCategory::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        $this->reset();
        $this->createForm = false;
        session()->flash('message', 'Category created successfully!');
    }

    public function SeteditForm(MedicineCategory $medicineCategory){
        
        $this->editingForm = true;
        $this->name = $medicineCategory->name;
        $this->description = $medicineCategory->description;
        $this->medicineCategoryIdBeingEdited = $medicineCategory;
    }

    public function update(){
        $this->validate();
        $this->medicineCategoryIdBeingEdited->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        $this->reset();
        $this->editingForm = false;
        session()->flash('message', 'Category updated successfully!');
    }

    public function delete($id){
        $medicineCategory = MedicineCategory::findOrFail($id);
        $medicineCategory->delete();
        session()->flash('message', 'Category deleted successfully!');
    }    


    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
    }


    public function cancel(){
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }
}
