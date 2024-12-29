<?php

namespace App\Livewire;

use App\Models\Manegr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ManagerComponet extends Component
{
    use WithFileUploads;

    public $managers;
    public $createForm = false;
    public $editingForm = false;
    public $search = '';
    public $first_name,$last_name,$gender, $date_of_birth,$phone_number,$address,$salary,$working_hours,$profile_picture,$is_active,$salary_type,$email, $working_days;
    public $managerIdBeingEditedOrDeleted,$from_time,$to_time;

    public function mount()
    {
        $this->managers = Manegr::all();
    }

    public function render()
    {
        $this->managers = Manegr::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->get();

        return view('manager.index');
    }

    public function SetcreateForm()
    {
        $this->resetInputFields();
        $this->createForm = true;
    }

    public function SeteditForm($id)
    {
        $manager = Manegr::find($id);
        if ($manager) {
            $this->managerIdBeingEditedOrDeleted = $id;
            $this->fillmanagerData($manager);
            $this->editingForm = true;
        }
    }

    private function fillmanagerData($manager)
    {
        $this->first_name = $manager->first_name;
        $this->last_name = $manager->last_name;
        $this->gender = $manager->gender;
        $this->date_of_birth = $manager->date_of_birth;
        $this->phone_number = $manager->phone_number;
        $this->address = $manager->address;
        $this->salary = $manager->salary;
        $this->working_days = array_fill_keys(explode(',', $manager->working_days), true);
        $this->email = $manager->email;
        
        // Parse working hours with proper format
        if ($manager->working_hours) {
            $hours = explode(' - ', $manager->working_hours);
            if (count($hours) == 2) {
                $this->from_time = Carbon::createFromFormat('h:i A', trim($hours[0]))->format('H:i');
                $this->to_time = Carbon::createFromFormat('h:i A', trim($hours[1]))->format('H:i');
            }
        }
        
        $this->working_hours = $manager->working_hours;
        $this->profile_picture = $manager->profile_picture;
        $this->is_active = $manager->is_active;
        $this->salary_type = $manager->salary_type;
    }

    public function store()
    {
        // dd(123);
        $this->validate($this->validationRules(), $this->validationMessages());
        // dd($this->validationRules());
        $profileImagePath = $this->profile_picture->store('managers/profile_pictures', 'public');

        Manegr::create($this->preparemanagerData($profileImagePath));

        $this->createForm = false;
        $this->resetInputFields();
        session()->flash('message', 'Manager created successfully!');
    }

    public function update()
    {
        // dd(123);
        $this->validate($this->validationRules(true), $this->validationMessages());

        $manager = Manegr::find($this->managerIdBeingEditedOrDeleted);
        if ($manager) {
            $updateData = $this->preparemanagerDataForUpdate($manager);
            $manager->update($updateData);

            $this->editingForm = false;
            $this->resetInputFields();
            session()->flash('message', 'Manager updated successfully!');
        }
    }

    protected function preparemanagerData($profileImagePath)
    {
        $from_time = Carbon::createFromFormat('H:i', $this->from_time)->format('h:i A');
        $to_time = Carbon::createFromFormat('H:i', $this->to_time)->format('h:i A');
        
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,    
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'salary' => $this->salary,
            'working_hours' => $from_time . ' - ' . $to_time, 
            'salary_type' => $this->salary_type,
            'is_active' => $this->is_active,
            'working_days' => implode(',', array_keys(array_filter($this->working_days))),
            'profile_picture' => $profileImagePath
        ];
    }
    

    private function preparemanagerDataForUpdate($manager)
    {
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'salary' => $this->salary,
            'working_days' => !empty($this->working_days) ? implode(',', array_keys(array_filter($this->working_days))) : $manager->working_days,
            'is_active' => $this->is_active,
            'salary_type' => $this->salary_type,
        ];
    
        if ($this->from_time && $this->to_time) {
            $data['working_hours'] = Carbon::createFromFormat('H:i', $this->from_time)->format('h:i A') .
                ' - ' .
                Carbon::createFromFormat('H:i', $this->to_time)->format('h:i A');
        } else {
            $data['working_hours'] = $manager->working_hours;
        }
    
        if ($this->profile_picture instanceof \Illuminate\Http\UploadedFile) {
            if ($manager->profile_picture && Storage::exists('public/' . $manager->profile_picture)) {
                Storage::delete('public/' . $manager->profile_picture);
            }
            $data['profile_picture'] = $this->profile_picture->store('managers/profile_pictures', 'public');
        } else {
            $data['profile_picture'] = $manager->profile_picture;
        }
    
        return $data;
    }
    protected function cleanupOldUpload()
    {
        if ($this->profile_picture instanceof \Illuminate\Http\UploadedFile) {
            $this->profile_picture = null;
        }
    }

    public function hydrate()
    {
        $this->cleanupOldUpload();
    }

    protected function validationRules($isUpdate = false)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'salary' => 'required|integer',
            'working_days' => 'required|array',
            'working_days.*' => 'boolean',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i|after:from_time',
            'salary_type' => 'required|string|in:kpi,fixed,fixed+kpi',
            'is_active' => 'required|boolean'
        ];
        
        // dd($rules);
        if (!$isUpdate) {
            $rules['profile_picture'] = 'required|image|max:5024';
        } else {
            $rules['profile_picture'] = 'nullable|image|max:5024';
        }
    
        return $rules;
    }
    
    private function validationMessages()
    {
        return [
            'phone_number.required' => 'Phone number is required',
            'phone_number.regex' => 'The phone number must start with +998 and have 9 digits after it.',
            'working_days.required' => 'Please select at least one working day.',
            'working_days.*.boolean' => 'Working day values must be true or false.',
            'salary_type.in' => 'Salary type must be one of: KPI, FIXED, or FIXED+KPI',
            'profile_picture.required' => 'Profile picture is required for new managers',
            'profile_picture.image' => 'The file must be an image',
            'profile_picture.max' => 'The image must not be larger than 5MB',
            'to_time.after' => 'End time must be after start time'
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
        $this->managerIdBeingEditedOrDeleted = $id;
    }

    public function deleteConfirmed()
    {
        $manager = Manegr::find($this->managerIdBeingEditedOrDeleted);
        if ($manager) {
            if ($manager->profile_picture && Storage::exists('public/' . $manager->profile_picture)) {
                Storage::delete('public/' . $manager->profile_picture);
            }
            $manager->delete();
            session()->flash('message', 'Manager deleted successfully!');
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
        $this->working_days = array_fill_keys(['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat'], false);
        $this->salary = null;
        $this->working_hours = null;
        $this->profile_picture = null;
        $this->is_active = null;
        $this->salary_type = null;
    }

    public function SetDeatailingManagers($id)
    {
        session(['detailing_managers' => $id]);
        return $this->redirect('/managers-details');
    }
}
