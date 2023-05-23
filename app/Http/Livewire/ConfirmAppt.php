<?php

namespace App\Http\Livewire;

use App\Http\Helpers\FeachPortalAPI;
use App\Models\Checkout;
use Livewire\Component;

class ConfirmAppt extends Component
{
    public $hospitalId;
    public $patients;
    public $selectedPatient;
    public $showNewPatient = false;
    // submit values:
    public $slot; // coming from parent
    public $firstName;
    public $mobile;
    public $accountId;
    public $patient_id;
    public $centerId;
    public $slotId;
    public $addresses;
    public $location_id;
    public $showModal = 0;
    public $slotType;
    protected $listeners = ['toggleModal',];

    public function mount()
    {
        $this->mobile = session('user')['phone'];
        $response = FeachPortalAPI::feach('/account/patientfinder', [
            'accountId' => session('user')['id'],
            'mobile_no' => session('user')['phone'],
            'hospital_id' => $this->slot['HOSPITAL_ID']
        ], 'post');
        $this->feachAddresses();
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        $this->patients = $response->json()['data'];

        if ($this->slot['APPT_TYPE_ID'] == 225) $this->slotType = 'home';
    }

    public function updatedSelectedPatient()
    {
        if ($this->selectedPatient == 'new') {
            $this->showNewPatient = true;
            $this->firstName = '';
            $this->patient_id = 0;
        } else {
            $this->showNewPatient = false;
            $this->firstName = $this->patients[$this->selectedPatient]['PATIENT_NAME_1'];
            $this->mobile = $this->patients[$this->selectedPatient]['MOBILE_NO'];
            $this->patient_id = $this->patients[$this->selectedPatient]['PATIENT_ID'];
        }
    }
    public function feachAddresses()
    {
        $response = FeachPortalAPI::feach('/account/locations/' . session('user')['id']);
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        // addresses retreived successfully
        $this->addresses = array_reverse($response->json()['data']);
    }

    public function toggleModal($showModal)
    {
        $this->showModal = $showModal;
        $this->feachAddresses();
    }

    public function pay($payOnArrival)
    {

        $this->validate([
            'firstName' => 'required',
            'mobile' => 'required',
            'patient_id' => 'required',
            'location_id' => 'required_with:slotType',
        ]);
        Checkout::create(array_merge($this->slot, [
            'payOnArrival' => $payOnArrival,
            'firstName' => $this->firstName,
            'mobile' =>  $this->mobile,
            'accountId' => session('user')['id'],
            'patient_id' => $this->patient_id,
            'location_id' => $this->location_id
        ]));
        session(['checkout'=>$this->slot['CLIN_APPT_SLOT_ID']]);
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.confirm-appt');
    }
}
