<?php

namespace App\Livewire;

use App\Models\Nurse;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class NurseComponent extends Component
{
    use WithPagination, WithFileUploads;

    protected $listeners = ['deleteConfirmed'];
    public $search = '';
    public $deleteId;
    public $selectedServices = [];
    public $createForm = false;
    public $first_name, $last_name, $gender, $date_of_birth, $email, $phone_number, $address;
    public $working_hours, $profile_picture, $from_time, $to_time, $times, $salary_type;
    public $is_active, $services, $working_days = [];
    public $userId, $editingNurse, $editingForm = false;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'gender' => 'required|in:male,female',
        'date_of_birth' => 'required|date',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required|string|max:15',
        'address' => 'nullable|string',
        'selectedServices' => 'array|exists:services,id',
        'from_time' => 'required|date_format:H:i',
        'to_time' => 'required|date_format:H:i|after:from_time',
        'profile_picture' => 'nullable|image|max:2048',
        'salary_type' => 'nullable|string',
        'is_active' => 'required|boolean',
    ];

    public function render()
    {
        $nurses = Nurse::where('first_name', 'like', $this->search . '%')
            ->orWhere('last_name', 'like', $this->search . '%')
            ->orWhere('email', 'like', $this->search . '%')
            ->paginate(10);
        $this->services = Service::all();
        return view('nurses.index', ['nurses' => $nurses]);
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
            'working_hours' => $this->from_time . '-' . $this->to_time,
            'working_days' => implode(',', $this->working_days),
            'is_active' => $this->is_active,
            'salary_type' => $this->salary_type,
        ];

        if ($this->profile_picture) {
            $data['profile_picture'] = $this->profile_picture->store('nurses/profile_pictures', 'public');
        }
        $nurse = Nurse::create($data);
        $nurse->services()->sync($this->selectedServices);

        session()->flash('message', 'Nurse created successfully!');
        $this->reset();
    }

    public function SeteditForm(Nurse $nurse)
    {
        $this->editingNurse = $nurse;
        $this->editingForm = true;

        $this->first_name = $nurse->first_name;
        $this->last_name = $nurse->last_name;
        $this->gender = $nurse->gender;
        $this->date_of_birth = $nurse->date_of_birth;
        $this->email = $nurse->email;
        $this->phone_number = $nurse->phone_number;
        $this->address = $nurse->address;

        $this->times = explode('-', $nurse->working_hours);
        $this->from_time = $this->times[0];
        $this->to_time = $this->times[1];
        $this->working_days = explode(',', $nurse->working_days);
        $this->profile_picture = $nurse->profile_picture;
        $this->is_active = $nurse->is_active;
        $this->salary_type = $nurse->salary_type;
    }

    public function update()
    {
        $this->editingForm = false;

        $this->editingNurse->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'working_hours' => $this->from_time . '-' . $this->to_time,
            'is_active' => $this->is_active,
            'working_days' => implode(',', $this->working_days),
            'salary_type' => $this->salary_type,
        ]);

        if (!empty($this->selectedServices)) {
            $this->editingNurse->services()->sync($this->selectedServices);
        }

        if ($this->profile_picture) {
            if ($this->editingNurse->profile_picture && Storage::disk('public')->exists($this->editingNurse->profile_picture)) {
                Storage::disk('public')->delete($this->editingNurse->profile_picture);
            }
            $this->editingNurse->update(['profile_picture' => $this->profile_picture->store('nurses/profile_pictures', 'public')]);
        }

        session()->flash('message', 'Nurse updated successfully!');
        $this->reset();
    }

    public function delete($id)
    {
        $nurse = Nurse::findOrFail($id);

        if ($nurse->profile_picture && Storage::disk('public')->exists($nurse->profile_picture)) {
            Storage::disk('public')->delete($nurse->profile_picture);
        }

        $nurse->delete();

        session()->flash('message', 'Nurse deleted successfully!');
    }

    public function SetDeatailingNurse($id)
    {
        session(['detailing_nurse' => $id]);
        return $this->redirect('/nurse-details');
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
