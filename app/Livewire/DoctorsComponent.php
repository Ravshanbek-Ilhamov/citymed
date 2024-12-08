<?php

namespace App\Livewire;

use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DoctorsComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $createForm = false;
    public $first_name, $last_name, $username, $password, $gender, $date_of_birth, $email, $phone_number, $address;
    public $specialization, $years_of_experience, $working_hours, $consultation_fee, $profile_picture, $bio, $per_patient_time;
    public $is_active;
    public $userId,$editingDoctor,$editingForm = false;


    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|unique:users,username|max:255',
        // 'password' => 'required|string|min:6',
        'gender' => 'required|in:male,female',
        'date_of_birth' => 'required|date',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required|string|max:15',
        'address' => 'nullable|string',
        'specialization' => 'nullable|string',
        'years_of_experience' => 'nullable|numeric|min:0',
        'working_hours' => 'nullable|string',
        'consultation_fee' => 'nullable|numeric|min:0',
        // 'profile_picture' => 'nullable|image|max:2048',
        'bio' => 'nullable|string|max:500',
        'is_active' => 'required|boolean',
        'per_patient_time' => 'nullable|numeric|min:0',
    ];

    public function store()
    {
        $this->validate();

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'specialization' => $this->specialization,
            'years_of_experience' => $this->years_of_experience,
            'working_hours' => $this->working_hours,
            'consultation_fee' => $this->consultation_fee,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'per_patient_time' => $this->per_patient_time
        ];

        if ($this->profile_picture) {
            $data['profile_picture'] = $this->profile_picture->store('doctors/profile_pictures', 'public');
        }

        Doctor::create($data);

        session()->flash('message', 'Doctor created successfully!');
        $this->reset();
    }

    public function SeteditForm(Doctor $doctor){
        $this->editingDoctor = $doctor;
        $this->editingForm = true;

        $this->first_name = $doctor->first_name;
        $this->last_name = $doctor->last_name;
        $this->username = $doctor->username;
        // $this->password = $doctor->password ?? ;
        $this->gender = $doctor->gender;
        $this->date_of_birth = $doctor->date_of_birth;
        $this->email = $doctor->email;
        $this->phone_number = $doctor->phone_number;
        $this->address = $doctor->address;
        $this->specialization = $doctor->specialization;
        $this->years_of_experience = $doctor->years_of_experience;
        $this->working_hours = $doctor->working_hours;
        $this->consultation_fee = $doctor->consultation_fee;
        $this->profile_picture = $doctor->profile_picture;
        $this->bio = $doctor->bio;
        $this->is_active = $doctor->is_active;
        $this->per_patient_time = $doctor->per_patient_time;
    }
    
    
    public function update(){
        $this->editingForm = false;
    
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $this->editingDoctor->id . ',id|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $this->editingDoctor->id . ',id',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string',
            'specialization' => 'nullable|string',
            'years_of_experience' => 'nullable|numeric|min:0',
            'working_hours' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
            'profile_picture' => 'nullable|image|max:8192',
            'bio' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
            'per_patient_time' => 'nullable|numeric|min:0',
        ]);

        $this->editingDoctor->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'specialization' => $this->specialization,
            'years_of_experience' => $this->years_of_experience,
            'working_hours' => $this->working_hours,
            'consultation_fee' => $this->consultation_fee,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'per_patient_time' => $this->per_patient_time
        ]);

        if ($this->password) {
            $this->editingDoctor->update(['password' => Hash::make($this->password)]);
        }

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
        $doctor = Doctor::findOrFail($id);

        if ($doctor->profile_picture && Storage::disk('public')->exists($doctor->profile_picture)) {
            Storage::disk('public')->delete($doctor->profile_picture);
        }

        $doctor->delete();

        session()->flash('message', 'Doctor deleted successfully!');
    }

    public function SetcreateForm(){
        $this->createForm = true;
    }

    public function cancel(){
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }

    public function render(){
        $doctors = Doctor::paginate( 10 );
        return view('doctors.index',['doctors' => $doctors]);
    }


}
