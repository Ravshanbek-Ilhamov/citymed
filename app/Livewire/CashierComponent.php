<?php

namespace App\Livewire;

use App\Models\Cashier;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CashierComponent extends Component
{
    use WithFileUploads;

    public $cashiers;
    public $createForm = false;
    public $editingForm = false;
    public $search = '';
    public $first_name, $last_name, $gender, $date_of_birth, $phone_number, $address, $working_hours, $profile_picture, $working_days = [];
    public $cashierIdBeingEditedOrDeleted, $from_time, $to_time, $email, $salary_type , $deleteId;

    public function mount()
    {
        $this->cashiers = Cashier::all();
    }

    public function render()
    {
        $this->cashiers = Cashier::where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->get();

        return view('admin-page.cashiers.index');
    }

    public function SetcreateForm()
    {
        $this->resetInputFields();
        $this->createForm = true;
    }

    public function SeteditForm($id)
    {
        $cashier = Cashier::find($id);
        if ($cashier) {
            $this->cashierIdBeingEditedOrDeleted = $id;
            $this->fillcashierData($cashier);
            $this->editingForm = true;
        }
    }

    private function fillcashierData($cashier)
    {
        // dd(123);
        $this->first_name = $cashier->first_name;
        $this->last_name = $cashier->last_name;
        $this->gender = $cashier->gender;
        $this->date_of_birth = $cashier->date_of_birth;
        $this->phone_number = $cashier->phone_number;
        $this->email = $cashier->email;
        $this->address = $cashier->address;
        $this->working_days = array_fill_keys(explode(',', $cashier->working_days), true);
        if ($cashier->working_hours) {
            $hours = explode(' - ', $cashier->working_hours);
            $this->from_time = $hours[0] ?? null;
            $this->to_time = $hours[1] ?? null;
        }
        $this->profile_picture = $cashier->profile_picture;
    }

    public function store()
    {
        $this->validate($this->validationRules(), $this->validationMessages());
        $profileImagePath = $this->profile_picture->store('cashiers/profile_pictures', 'public');
        Cashier::create($this->preparecashierData($profileImagePath));
        $this->createForm = false;
        $this->resetInputFields();
        session()->flash('message', 'Cashier created successfully!');
    }

    public function update()
    {
        // dd(123);
        $this->validate($this->validationRules(true), $this->validationMessages());
        // dd($this->profile_picture);
        $cashier = Cashier::find($this->cashierIdBeingEditedOrDeleted);
        if ($cashier) {
            $updateData = $this->preparecashierDataForUpdate($cashier);
            $cashier->update($updateData);

            $this->editingForm = false;
            $this->resetInputFields();
            session()->flash('message', 'Cashier updated successfully!');
        }
    }

    protected function preparecashierData($profileImagePath)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address,
            'salary_type'=>$this->salary_type,
            'working_hours' => $this->from_time . ' - ' . $this->to_time,
            'working_days' => implode(',', array_keys(array_filter($this->working_days))),
            'profile_picture' => $profileImagePath,
        ];
    }

    private function preparecashierDataForUpdate($cashier)
    {
        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address,
            'working_hours' => $this->from_time . ' - ' . $this->to_time,
            'salary_type' => $this->salary_type ?? $cashier->salary_type,
        ];
    
        // Handle profile picture
        if ($this->profile_picture && $this->profile_picture instanceof \Illuminate\Http\UploadedFile) {
            if ($cashier->profile_picture && Storage::exists('public/' . $cashier->profile_picture)) {
                Storage::delete('public/' . $cashier->profile_picture);
            }
            $data['profile_picture'] = $this->profile_picture->store('cashiers/profile_pictures', 'public');
        } else {
            $data['profile_picture'] = $cashier->profile_picture;
        }
    
        // Handle working days
        if (!empty(array_filter($this->working_days))) {
            $data['working_days'] = implode(',', array_keys(array_filter($this->working_days)));
        } else {
            $data['working_days'] = $cashier->working_days;
        }
    
        return $data;
    }
    

    protected function validationRules($isUpdate = false)
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'phone_number' => 'required|regex:/^\+998\d{9}$/',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i|after:from_time',
            'working_days' => 'required|array|min:1',
            'profile_picture' => 'required|image|max:5024',
            'salary_type' =>'required|string|in:kpi,fixed,fixed+kpi',
        ];
    }

    private function validationMessages()
    {
        return [
            'phone_number.regex' => 'The phone number must start with +998 and have 9 digits after it.',
            'working_days.required' => 'Please select at least one working day.',
            'working_days.*.in' => 'Invalid working day selected.',
        ];
    }
    public function getFormattedWorkingDays($working_days)
    {
        return implode(', ', explode(',', $working_days)); 
    }


    private function resetInputFields()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->gender = null;
        $this->date_of_birth = null;
        $this->phone_number = null;
        $this->email = null;
        $this->address = null;
        $this->working_hours = null;
        $this->working_days = array_fill_keys(['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat'], false);
        $this->profile_picture = null;
        $this->from_time = null;
        $this->to_time = null;
        $this->salary_type = null;
    }

    public function SetDeatailingcashiers($id){
        session(['detailing_cashier' => $id]);
        return $this->redirect('/cashier-details');
    }

    public function cancel(){
        $this->createForm = false;
        $this->editingForm = false;
        $this->reset();
    }

    public function deleteConfirmed()
    {
        $this->delete($this->deleteId);
    }

    public function delete($id){
        $cashier = Cashier::findOrFail($id);

        if ($cashier->profile_picture && Storage::disk('public')->exists($cashier->profile_picture)) {
            Storage::disk('public')->delete($cashier->profile_picture);
        }

        $cashier->delete();

        session()->flash('message', 'Cashier deleted successfully!');
    }

    public function prepareDelete($id)
    {
        $this->deleteId = $id;
    }
}
