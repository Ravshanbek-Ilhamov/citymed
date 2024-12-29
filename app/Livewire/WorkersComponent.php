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
    public $workerIdBeingEditedOrDeleted,$from_time, $to_time;

    public function mount()
    {
        $this->workers = Worker::all();
    }

    public function render()
    {
        $this->workers = Worker::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->get();

        return view('admin-page.workers.workers-component');
    }

    public function SetcreateForm()
    {
        $this->resetInputFields();
        $this->createForm = true;
    }

    public function SeteditForm($id)
    {
        $worker = Worker::find($id);
        if ($worker) {
            $this->workerIdBeingEditedOrDeleted = $id;
            $this->fillWorkerData($worker);
            $this->editingForm = true;
        }
    }

    private function fillWorkerData($worker)
    {
        $this->first_name = $worker->first_name;
        $this->last_name = $worker->last_name;
        $this->gender = $worker->gender;
        $this->date_of_birth = $worker->date_of_birth;
        $this->phone_number = $worker->phone_number;
        $this->address = $worker->address;
        $this->specialization = $worker->specialization;
        
        if ($worker->working_hours) {
            $hours = explode(' - ', $worker->working_hours);
            $this->from_time = $hours[0] ?? null;
            $this->to_time = $hours[1] ?? null;
        }
        
        $this->working_hours = $worker->working_hours;
        $this->profile_image = $worker->profile_image;
        $this->is_active = $worker->is_active;
        $this->salary_type = $worker->salary_type;
    }

    public function store()
    {
        $this->validate($this->validationRules(), $this->validationMessages());

        $profileImagePath = $this->profile_image->store('workers/profile_images', 'public');

        Worker::create($this->prepareWorkerData($profileImagePath));

        $this->createForm = false;
        $this->resetInputFields();
        session()->flash('message', 'Worker created successfully!');
    }

    public function update()
    {
        $this->validate($this->validationRules(true), $this->validationMessages());

        $worker = Worker::find($this->workerIdBeingEditedOrDeleted);
        if ($worker) {
            $updateData = $this->prepareWorkerDataForUpdate($worker);
            $worker->update($updateData);

            $this->editingForm = false;
            $this->resetInputFields();
            session()->flash('message', 'Worker updated successfully!');
        }
    }

    protected function prepareWorkerData($profileImagePath)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'specialization' => $this->specialization,
            'working_hours' => $this->from_time . ' - ' . $this->to_time, 
            'salary_type' => $this->salary_type,
            'is_active' => $this->is_active,
            'profile_image' => $profileImagePath,
        ];
    }
    

    private function prepareWorkerDataForUpdate($worker)
    {
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'specialization' => $this->specialization,
            'working_hours' => $this->from_time . ' - ' . $this->to_time,
            'is_active' => $this->is_active,
            'salary_type' => $this->salary_type,
        ];
    
        if ($this->profile_image && $this->profile_image instanceof \Illuminate\Http\UploadedFile) {
            if ($worker->profile_image && Storage::exists('public/' . $worker->profile_image)) {
                Storage::delete('public/' . $worker->profile_image);
            }
            $data['profile_image'] = $this->profile_image->store('workers/profile_images', 'public');
        } else {
            $data['profile_image'] = $worker->profile_image;
        }
    
        return $data;
    }

    protected function validationRules($isUpdate = false)
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i|after:from_time', 
            'salary_type' => 'required|string|in:kpi,fixed',
            'is_active' => 'required|boolean',
            'profile_image' => 'required|image|max:5024',
        ];
    }
    

    private function validationMessages()
    {
        return [
            'phone_number.regex' => 'The phone number must start with +998 and have 9 digits after it.',
        ];
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
