<?php

namespace App\Livewire;

use App\Models\Nurse;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class NurseComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['deleteConfirmed'];
    public $search = '';
    public $deleteId;
    public $createForm = false;
    public $first_name, $last_name, $gender, $date_of_birth, $email, $phone_number, $address, $service_id;
    public $working_hours, $profile_picture;
    public $is_active,$services;
    public $userId,$editingNurse,$editingForm = false;


    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'gender' => 'required|in:male,female',
        'date_of_birth' => 'required|date',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required|string|max:15',
        'address' => 'nullable|string',
        'service_id' => 'required|exists:services,id',
        'working_hours' => ['nullable', 'string', 'regex:/^\d{1,2}:\d{2}-\d{1,2}:\d{2}$/'],
        // 'profile_picture' => 'nullable|image|max:2048',
        'is_active' => 'required|boolean',
    ];

    public function render(){
        $nurses = Nurse::where('first_name', 'like',$this->search . '%')
        ->orWhere('last_name', 'like', $this->search . '%')
        ->orWhere('email', 'like',$this->search . '%')
        // ->orWhere('specialization', 'like', $this->search . '%')
        ->paginate(10);

        $this->services = Service::all();
        return view('nurses.index',['nurses' => $nurses]);
    }

    public function store()
    {
        $this->validate();

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'service_id' => $this->service_id,
            'working_hours' => $this->working_hours,
            'is_active' => $this->is_active,
        ];

        if ($this->profile_picture) {
            $data['profile_picture'] = $this->profile_picture->store('nurses/profile_pictures', 'public');
        }

        Nurse::create($data);

        session()->flash('message', 'Doctor created successfully!');
        $this->reset();
    }

    public function SeteditForm(Nurse $nurse){
        $this->editingNurse = $nurse;
        $this->editingForm = true;

        $this->first_name = $nurse->first_name;
        $this->last_name = $nurse->last_name;
        $this->gender = $nurse->gender;
        $this->date_of_birth = $nurse->date_of_birth;
        $this->email = $nurse->email;
        $this->phone_number = $nurse->phone_number;
        $this->address = $nurse->address;
        $this->service_id = $nurse->service_id;
        $this->working_hours = $nurse->working_hours;
        $this->profile_picture = $nurse->profile_picture;
        $this->is_active = $nurse->is_active;
    }


    public function update(){
        $this->editingForm = false;

        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $this->editingDoctor->id . ',id',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
            'working_hours' => ['nullable', 'string', 'regex:/^\d{1,2}:\d{2}-\d{1,2}:\d{2}$/'],
            'profile_picture' => 'nullable|image|max:8192',
            'is_active' => 'required|boolean',
        ]);

        $this->editingDoctor->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'service_id' => $this->service_id,
            'working_hours' => $this->working_hours,
            'is_active' => $this->is_active,
        ]);

        if ($this->profile_picture) {
            if ($this->editingDoctor->profile_picture && Storage::disk('public')->exists($this->editingDoctor->profile_picture)) {
                Storage::disk('public')->delete($this->editingDoctor->profile_picture);
            }
            $this->editingDoctor->update(['profile_picture' => $this->profile_picture->store('doctors/profile_pictures', 'public')]);
        }

        session()->flash('message', 'Doctor updated successfully!');
        $this->reset();
    }

    public function delete($id){
        $nurse = Nurse::findOrFail($id);

        if ($nurse->profile_picture && Storage::disk('public')->exists($nurse->profile_picture)) {
            Storage::disk('public')->delete($nurse->profile_picture);
        }

        $nurse->delete();

        session()->flash('message', 'Doctor deleted successfully!');
    }

    public function SetDeatailingNurse($id){
        session(['detailing_nurse' => $id]);
        return $this->redirect('/nurse-details');
    }

    public function SetcreateForm(){
        $this->createForm = true;
    }

    public function cancel(){
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }
    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
    }
}
