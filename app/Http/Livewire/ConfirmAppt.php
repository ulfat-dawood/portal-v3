<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ConfirmAppt extends Component
{
    public $slot; // coming from parent
    public $hospitalId;
    public $patients;
    public $selectedPatient;
    // submit values:
    public $firstName;
    public $mobile;
    public $accountId;
    public $patient_id;
    public $centerId;
    public $slotId;
    public $showNewPatient = false;

    public function mount(){
        $this->mobile = session('user')['phone'];
        try{
            $responsePatients = Http::post(env('API_URL') . '/' . app()->getLocale() . '/account/patientfinder',[
                'accountId'=> session('user')['id'] ,
                'mobile_no'=> session('user')['phone'] ,
                'hospital_id'=> $this->slot['HOSPITAL_ID'],
            ]);
        } catch (\Throwable $th){
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responsePatients->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$responsePatients->json()['status']) return redirect()->back()->with('warning', $responsePatients->json()['msg']);
        $this->patients = $responsePatients->json()['data'];
    }

    public function updatedSelectedPatient(){
        if($this->selectedPatient == 'new'){
            $this->showNewPatient = true;
            $this->firstName = ''; 
        }else{
            $this->showNewPatient = false;
            $this->firstName = $this->patients[$this->selectedPatient]['PATIENT_NAME_1'];
            $this->mobile = $this->patients[$this->selectedPatient]['MOBILE_NO'];
            $this->patient_id = $this->patients[$this->selectedPatient]['PATIENT_ID'];
        }
    }

    public function render()
    {
        return view('livewire.confirm-appt');
    }
}
