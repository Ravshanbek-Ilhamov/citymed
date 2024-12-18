<?php

namespace App\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class MedicineSuppliersComponent extends Component
{
    use WithPagination;

    public $createForm = false , $editingForm = false;

    public $supplier_id,$supplierBeingEdited, $first_name, $last_name,
            $address, $phone_number, $email, $contact_person, $country, $company_name,$deleteId;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string',
        'phone_number' => 'required|string|max:15|regex:/^\+998[0-9]{9}$/',
        'email' => 'required|email',
        'contact_person' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
    ];

    public function render()
    {
        $medicineSuppliers = Supplier::paginate(10);
        return view('medicines.medicine-suppliers', compact('medicineSuppliers'));
    }


    public function store()
    {
        $this->validate();
        Supplier::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'contact_person' => $this->contact_person,
            'country' => $this->country,
            'company_name' => $this->company_name,
        ]);
        $this->cancel();
        session()->flash('success', 'Supplier created successfully.');
    }


    public function SeteditForm(Supplier $supplier)
    {
        $this->editingForm = true;
        $this->supplierBeingEdited = $supplier;
        $this->first_name = $supplier->first_name;
        $this->last_name = $supplier->last_name;
        $this->address = $supplier->address;
        $this->phone_number = $supplier->phone_number;
        $this->email = $supplier->email;
        $this->contact_person = $supplier->contact_person;
        $this->country = $supplier->country;
        $this->company_name = $supplier->company_name;
    }

    public function update()
    {
        $this->validate();
        $this->supplierBeingEdited->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'contact_person' => $this->contact_person,
            'country' => $this->country,
            'company_name' => $this->company_name,
        ]);
        $this->cancel();
        session()->flash('success', 'Supplier updated successfully.');
    }

    public function delete($id){
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        session()->flash('message', 'Supplier deleted successfully!');
    }

    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
    }

    public function SetcreateForm()
    {
        $this->createForm = true;
    }

    public function cancel(){    
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }
}
