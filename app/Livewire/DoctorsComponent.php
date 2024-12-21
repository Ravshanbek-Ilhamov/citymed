<?php

namespace App\Livewire;

use App\Models\Direction;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DoctorsComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['deleteConfirmed'];
    public $search = '';
    public $serviceList = [];
    // public $direction_id = '';
    public $deleteId, $services = [];
    public $createForm = false;
    public $first_name, $last_name, $username, $password, $gender, $date_of_birth, $email, $phone_number, $address, $direction_id;
    public $specialization, $years_of_experience, $working_hours, $consultation_fee, $profile_picture, $bio, $per_patient_time, $salary_type;
    public $is_active, $directions, $from_time, $to_time, $times, $working_days = [];
    public $userId, $editingDoctor, $editingForm = false;
    public $selectedValues = [];
    public $options;
    public $selectedServices = [];

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|unique:users,username|max:255',
        // 'password' => 'required|string|min:6',
        'gender' => 'required|in:male,female',
        'date_of_birth' => 'required|date',
        'email' => 'required|email|unique:users,email',
        'phone_number' => ['required', 'regex:/^\+998[0-9]{9}$/'],
        'address' => 'nullable|string',
        'direction_id' => 'required|exists:directions,id',
        'years_of_experience' => 'nullable|numeric|min:0',
        'from_time' => 'required|date_format:H:i', // Validate from_time
        'to_time' => 'required|date_format:H:i|after:from_time', // Validate to_time
        // 'working_hours' => ['nullable', 'string', 'regex:/^\d{1,2}:\d{2}-\d{1,2}:\d{2}$/'],
        'consultation_fee' => 'nullable|numeric|min:0',
        // 'profile_picture' => 'nullable|image|max:2048',
        'bio' => 'nullable|string|max:500',
        'is_active' => 'required|boolean',
        'per_patient_time' => 'nullable|numeric|min:0',
        'salary_type' => 'nullable|string',
        'selectedServices' => 'array|exists:services,id',
    ];

    public function mount()
    {
        $this->options = [
            '1' => 'Option 1',
            '2' => 'Option 2',
            '3' => 'Option 3',
            '4' => 'Option 4',
            '5' => 'Option 5'
        ];
        $this->services = collect();
    }
    public function updatedDirectionId($value)
    {
        if ($value) {
            $this->services = Service::where('direction_id', $value)->get();
            $this->selectedServices = [];
        } else {
            $this->services = collect();
        }
    }

    public function updatedSelectedValues($value)
    {
        $this->dispatch('values-changed', $this->selectedValues);
    }

    public function render()
    {
        $doctors = Doctor::whereHas('direction', function ($query) {
            $query->where('name', 'like', $this->search . '%');
        })
        ->orWhere('first_name', 'like', $this->search . '%')
        ->orWhere('last_name', 'like', $this->search . '%')
        ->orWhere('email', 'like', $this->search . '%')
        ->paginate(10);

        $this->directions = Direction::all();
        return view('doctors.index', ['doctors' => $doctors]);
    }


    public function store()
    {
        $this->validate();
        // dd($this->working_days);
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
            'direction_id' => $this->direction_id,
            'years_of_experience' => $this->years_of_experience,
            'working_hours' => $this->from_time . '-' . $this->to_time, // Combine the times
            'consultation_fee' => $this->consultation_fee,
            'bio' => $this->bio,
            'working_days' => implode(',', $this->working_days),
            'is_active' => $this->is_active,
            'per_patient_time' => $this->per_patient_time,
            'salary_type' => $this->salary_type,
        ];
        if ($this->profile_picture) {
            $data['profile_picture'] = $this->profile_picture->store('doctors/profile_pictures', 'public');
        }

        $doctor = Doctor::create($data);

        $doctor->services()->sync($this->selectedServices);

        session()->flash('message', 'Doctor created successfully!');
        $this->reset();
    }

    public function SeteditForm(Doctor $doctor)
    {
        $this->editingDoctor = $doctor;
        $this->editingForm = true;

        $this->first_name = $doctor->first_name;
        $this->last_name = $doctor->last_name;
        $this->username = $doctor->username;
        $this->gender = $doctor->gender;
        $this->date_of_birth = $doctor->date_of_birth;
        $this->email = $doctor->email;
        $this->phone_number = $doctor->phone_number;
        $this->address = $doctor->address;
        $this->direction_id = $doctor->direction_id;
        $this->years_of_experience = $doctor->years_of_experience;

        $this->times = explode('-', $doctor->working_hours);
        $this->from_time = $this->times[0];
        $this->to_time = $this->times[1];

        $this->working_days = explode(',', $doctor->working_days);

        $this->services = Service::where('direction_id', $doctor->direction_id)->get();

        $this->consultation_fee = $doctor->consultation_fee;
        $this->profile_picture = $doctor->profile_picture;
        $this->bio = $doctor->bio;
        $this->is_active = $doctor->is_active;
        $this->per_patient_time = $doctor->per_patient_time;
        $this->salary_type = $doctor->salary_type;
    }


    public function update()
    {
        $this->editingForm = false;

        $this->editingDoctor->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'direction_id' => $this->direction_id,
            'years_of_experience' => $this->years_of_experience,
            'working_hours' => $this->from_time . '-' . $this->to_time,
            'working_days' => implode(',', $this->working_days),
            'consultation_fee' => $this->consultation_fee,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'per_patient_time' => $this->per_patient_time,
            'salary_type' => $this->salary_type,
        ]);

        if (!empty($this->selectedServices)) {
            $this->editingDoctor->services()->sync($this->selectedServices);
        }


        if ($this->password) {
            $this->editingDoctor->update(['password' => Hash::make($this->password)]);
        }

        if ($this->profile_picture instanceof \Illuminate\Http\UploadedFile) {
            if ($this->editingDoctor->profile_picture && Storage::disk('public')->exists($this->editingDoctor->profile_picture)) {
                Storage::disk('public')->delete($this->editingDoctor->profile_picture);
            }
            $this->editingDoctor->update(['profile_picture' => $this->profile_picture->store('doctors/profile_pictures', 'public')]);
        }

        session()->flash('message', 'Doctor updated successfully!');
        $this->reset();
    }

    public function delete($id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($doctor->profile_picture && Storage::disk('public')->exists($doctor->profile_picture)) {
            Storage::disk('public')->delete($doctor->profile_picture);
        }

        $doctor->delete();

        session()->flash('message', 'Doctor deleted successfully!');
    }

    public function SetDeatailingDoctor($id)
    {
        session(['detailing_doctor' => $id]);
        return $this->redirect('/doctor-details');
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
    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
    }
}
