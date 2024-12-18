<?php

namespace App\Livewire;

use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class PatientComponent extends Component
{
    use WithPagination, WithFileUploads;

    public  $first_name, $last_name, $phone_number, $email, $address, $profile_image, 
           $date_of_birth, $gender, $payment_status, $blood_type;

    public $search = '';
    public $createForm = false;
    public $editingForm = false;
    public $patientIdBeingEditedOrDeleted;

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone_number' => ['required', 'regex:/^\+998[0-9]{9}$/'],
        'email' => 'nullable|email',
        'address' => 'required',
        'profile_image' => 'nullable|image|max:5024',
        'date_of_birth' => 'required|date',
        'gender' => 'required',
        'payment_status' => 'required',
        'blood_type' => 'required',
        // dd($this->rules)
    ];
    protected $messages = [
        'phone_number.regex' => 'The phone number must start with +998 and have 9 digits after it.',
    ];

    public function render()
    {
        $patients = Patient::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
            ->paginate(10);
            // dd($patients);
        return view('patients.index',compact('patients'));
    }

    public function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->phone_number = '';
        $this->email = '';
        $this->address = '';
        $this->profile_image = '';
        $this->date_of_birth = '';
        $this->gender = '';
        $this->payment_status = '';
        $this->blood_type = '';
        $this->patientIdBeingEditedOrDeleted = null;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->createForm = true;
    }

    public function store()
    {
        // dd($this->all());
        $this->validate();
        // dd($this->all());
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'payment_status' => $this->payment_status,
            'blood_type' => $this->blood_type,
        ];
        

        if ($this->profile_image) {
            $data['profile_image'] = $this->profile_image->store('patients/profile_images', 'public');
        }
        // dd($data);
        Patient::create($data);

        // dd($test)=
        $this->dispatch('patient-created');
        // session()->flash('message', 'Patient created successfully!');
        $this->createForm = false;
        $this->resetInputFields();
    }

    public function cancel(){
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        $this->patientIdBeingEditedOrDeleted = $patient->id;
        $this->first_name = $patient->first_name;
        $this->last_name = $patient->last_name;
        $this->phone_number = $patient->phone_number;
        $this->email = $patient->email;
        $this->address = $patient->address;
        $this->date_of_birth = $patient->date_of_birth;
        $this->gender = $patient->gender;
        $this->payment_status = $patient->payment_status;
        $this->blood_type = $patient->blood_type;
        $this->editingForm = true;
    }

    public function update()
    {
        $this->validate();

        $patient = Patient::findOrFail($this->patientIdBeingEditedOrDeleted);

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'payment_status' => $this->payment_status,
            'blood_type' => $this->blood_type,
        ];

        if ($this->profile_image) {
            if ($patient->profile_image && Storage::exists('public/' . $patient->profile_image)) {
                Storage::delete('public/' . $patient->profile_image);
            }
            $data['profile_image'] = $this->profile_image->store('patients/profile_images', 'public');
        }

        $patient->update($data);
        $this->dispatch('patient-updated');
        // session()->flash('message', 'Patient updated successfully!');
        $this->editingForm = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $patient = Patient::findOrFail($id);

        if ($patient->profile_image && Storage::exists('public/' . $patient->profile_image)) {
            Storage::delete('public/' . $patient->profile_image);
        }

        $patient->delete();
        session()->flash('message', 'Patient deleted successfully!');
    }
    
    public function prepareDelete($id)
    {
        $this->patientIdBeingEditedOrDeleted = $id;
        session()->flash('deleteConfirmation', 'Are you sure you want to delete this patient?');
    }
    
    public function deleteConfirmed()
    {
        $patient = Patient::findOrFail($this->patientIdBeingEditedOrDeleted);
        
        if ($patient->profile_image && Storage::exists('public/' . $patient->profile_image)) {
            Storage::delete('public/' . $patient->profile_image);
        }
        
        $patient->delete();
        
        $this->dispatch('patient-deleted');
        // dd('Event patient-deleted dispatched');
        // session()->flash('message', 'Patient deleted successfully!');
        $this->patientIdBeingEditedOrDeleted = null;
    }

    public function SetDeatailingpatients($id){
        session(['detailing_patient' => $id]);
        return $this->redirect('/patient-details');
    }

}
