<?php

namespace App\Livewire;

use App\Models\Registrator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class RegistratorComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['deleteConfirmed'];
    public $search = '';
    public $deleteId;
    public $createForm = false;
    public $first_name, $last_name, $username, $password, $gender, $date_of_birth, $email, $phone_number, $address;
    public $working_hours, $profile_picture, $bio, $salary_type;
    public $is_active, $from_time, $to_time, $times, $working_days = [];
    public $userId, $editingRegistrator, $editingForm = false;
    public $selectedValues = [];

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
        'from_time' => 'required|date_format:H:i', // Validate from_time
        'to_time' => 'required|date_format:H:i|after:from_time', // Validate to_time
        // 'working_hours' => ['nullable', 'string', 'regex:/^\d{1,2}:\d{2}-\d{1,2}:\d{2}$/'],
        // 'profile_picture' => 'nullable|image|max:2048',
        'bio' => 'nullable|string|max:500',
        'is_active' => 'required|boolean',
        'salary_type' => 'nullable|string',
    ];
    public function render()
    {
        $registrators = Registrator::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orderBy('id','desc');

        return view('registrators.index', ['registrators' => $registrators]);
    }


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
            'working_hours' => $this->from_time . '-' . $this->to_time, // Combine the times
            'bio' => $this->bio,
            'working_days' => implode(',', $this->working_days),
            'is_active' => $this->is_active,
            'salary_type' => $this->salary_type,
        ];
        if ($this->profile_picture) {
            $data['profile_picture'] = $this->profile_picture->store('registrators/profile_pictures', 'public');
        }

        Registrator::create($data);

        session()->flash('message', 'Registrator created successfully!');
        $this->reset();
    }

    public function SeteditForm(Registrator $registrator)
    {
        $this->editingRegistrator = $registrator;
        $this->editingForm = true;

        $this->first_name = $registrator->first_name;
        $this->last_name = $registrator->last_name;
        $this->username = $registrator->username;
        $this->gender = $registrator->gender;
        $this->date_of_birth = $registrator->date_of_birth;
        $this->email = $registrator->email;
        $this->phone_number = $registrator->phone_number;
        $this->address = $registrator->address;

        $this->times = explode('-', $registrator->working_hours);
        $this->from_time = $this->times[0];
        $this->to_time = $this->times[1];

        $this->working_days = explode(',', $registrator->working_days);

        $this->profile_picture = $registrator->profile_picture;
        $this->bio = $registrator->bio;
        $this->is_active = $registrator->is_active;
        $this->salary_type = $registrator->salary_type;
    }


    public function update()
    {
        $this->editingForm = false;

        $this->editingRegistrator->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'working_hours' => $this->from_time . '-' . $this->to_time,
            'working_days' => implode(',', $this->working_days),
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'salary_type' => $this->salary_type,
        ]);


        if ($this->password) {
            $this->editingRegistrator->update(['password' => Hash::make($this->password)]);
        }

        if ($this->profile_picture instanceof \Illuminate\Http\UploadedFile) {
            if ($this->editingRegistrator->profile_picture && Storage::disk('public')->exists($this->editingRegistrator->profile_picture)) {
                Storage::disk('public')->delete($this->editingRegistrator->profile_picture);
            }
            $this->editingRegistrator->update(['profile_picture' => $this->profile_picture->store('Registrators/profile_pictures', 'public')]);
        }

        session()->flash('message', 'Registrator updated successfully!');
        $this->reset();
    }

    public function delete($id)
    {
        $Registrator = Registrator::findOrFail($id);

        if ($Registrator->profile_picture && Storage::disk('public')->exists($Registrator->profile_picture)) {
            Storage::disk('public')->delete($Registrator->profile_picture);
        }

        $Registrator->delete();

        session()->flash('message', 'Registrator deleted successfully!');
    }

    public function SetDeatailingRegistrator($id)
    {
        session(['detailing_registrator' => $id]);
        return $this->redirect('/registrator-details');
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
