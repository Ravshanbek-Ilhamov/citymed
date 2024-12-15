<?php

namespace App\Livewire;

use App\Models\Worker;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class WorkersComponent extends Component
{
    use WithFileUploads;
    public $workers;
    public $createForm = false;
    public $editingForm = false;
    public $search = '';
    public $first_name, $last_name, $gender, $date_of_birth, $phone_number, $address, $specialization, $working_hours, $profile_image, $is_active, $salary_type;
    public $workerIdBeingEditedOrDeleted;

    public function mount()
    {
        $this->workers = Worker::all();
    }

    public function render()
    {
        $this->workers = Worker::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->get();

        return view('workers.workers-component');
    }

    public function SetcreateForm()
    {
        $this->resetInputFields();
        $this->createForm = true;
    }

    public function SeteditForm($id)
    {
        // dd(123);
        $worker = Worker::find($id);
        if ($worker) {
            $this->workerIdBeingEditedOrDeleted = $id;
            $this->first_name = $worker->first_name;
            $this->last_name = $worker->last_name;
            $this->gender = $worker->gender;
            $this->date_of_birth = $worker->date_of_birth;
            $this->phone_number = $worker->phone_number;
            $this->address = $worker->address;
            $this->specialization = $worker->specialization;
            $this->working_hours = $worker->working_hours;
            $this->profile_image = $worker->profile_image;
            $this->is_active = $worker->is_active;
            $this->salary_type = $worker->salary_type;
            $this->editingForm = true;
        }
        // dd($worker);
    }

    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'phone_number' => ['required', 'regex:/^\+998[0-9]{9}$/'],
        ], [
            'phone_number.regex' => 'The phone number must start with +998 and have 9 digits after it.',
        
            'address' => 'required',
            'specialization' => 'required',
            'working_hours' => ['nullable', 'string', 'regex:/^\d{1,2}:\d{2}-\d{1,2}:\d{2}$/'],
            'salary_type' => 'required',
            'is_active' => 'required',
        ]);
    
        $profileImagePath = $this->profile_image->store('workers/profile_images', 'public');
    
        Worker::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'specialization' => $this->specialization,
            'working_hours' => $this->working_hours,
            'salary_type' => $this->salary_type,
            'is_active' => $this->is_active,
            'profile_image' => $profileImagePath,
        ]);
    
        $this->createForm = false;
        $this->resetInputFields();
        session()->flash('message', 'Worker created successfully!');
    }
    

    public function update()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => ['required', 'regex:/^\+998[0-9]{9}$/'],
        ], [
            'phone_number.regex' => 'The phone number must start with +998 and have 9 digits after it.',
        
            'address' => 'required',
            'specialization' => 'required',
            'working_hours' => ['nullable', 'string', 'regex:/^\d{1,2}:\d{2}-\d{1,2}:\d{2}$/'],
            'is_active' => 'required',
            'salary_type' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $worker = Worker::find($this->workerIdBeingEditedOrDeleted);
    
        if ($worker) {
            $updateData = [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'gender' => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'phone_number' => $this->phone_number,
                'address' => $this->address,
                'specialization' => $this->specialization,
                'working_hours' => $this->working_hours,
                'is_active' => $this->is_active,
                'salary_type' => $this->salary_type,
            ];
    
            if ($this->profile_image && $this->profile_image instanceof \Illuminate\Http\UploadedFile) {
                if ($worker->profile_image && Storage::exists('public/' . $worker->profile_image)) {
                    Storage::delete('public/' . $worker->profile_image);
                }
                $updateData['profile_image'] = $this->profile_image->store('workers/profile_images', 'public');
            }
            
    
            $worker->update($updateData);
    
            $this->editingForm = false;
            $this->resetInputFields();
            session()->flash('message', 'Worker updated successfully!');
        }
    }
    

    public function cancel()
    {
        $this->createForm = false;
        $this->editingForm = false;
        $this->resetInputFields();
    }

    public function prepareDelete($id)
    {
        $this->workerIdBeingEditedOrDeleted = $id;
    }

    public function deleteConfirmed()
    {
        $worker = Worker::find($this->workerIdBeingEditedOrDeleted);
        if ($worker) {
            if ($worker->profile_image && Storage::exists('public/' . $worker->profile_image)) {
                Storage::delete('public/' . $worker->profile_image);
            }
            $worker->delete();
            session()->flash('message', 'Worker deleted successfully!');
        }
    }

    private function resetInputFields()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->gender = null;
        $this->date_of_birth = null;
        $this->phone_number = null;
        $this->address = null;
        $this->specialization = null;
        $this->working_hours = null;
        $this->profile_image = null;
        $this->is_active = null;
        $this->salary_type = null;
    }

    public function SetDeatailingWorkers($id)
    {
        session(['detailing_workers' => $id]);
        return $this->redirect('/worker-details');
    }
}
