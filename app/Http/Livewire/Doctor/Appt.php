<?php

namespace App\Http\Livewire\Doctor;

use App\Http\Helpers\FeachPortalAPI;
use App\Models\Account;
use Livewire\Component;


class Appt extends Component
{
    public $days;
    public $selectedDay;
    public $slots;
    public $doctorInfo = ['doctorId' => '', 'centerId' => '', 'clinicId' => ''];
    public $param;
    public $msg;
    public  $appt_type;
    public function mount()
    {
        if (count($this->days)) { //if days available
            $this->selectedDay =  $this->days[0];
            $this->updatedSelectedDay();
        }
    }

    public function updatedSelectedDay()
    {
        $response = FeachPortalAPI::feach('/slots/' . $this->param['DoctorId'] . '/' . $this->param['CenterId'] . '/' . $this->param['ClinicID'] . '/' . $this->selectedDay . '/' . $this->param['appt_type']);
        if (!$response[0]) {
            $this->msg = $response[2];
        } else {
            $response = $response[0];
            $this->slots = $this->refineSlots($response->json()['data']);
        }
    }

    public function getSlot($slotId)
    {
        if (!Account::isLoggedin()) {
            $previousUrl = route('slot', ['slotId' => $slotId, 'locale' => session('locale')]);
            session(['slot-url' => $previousUrl]);
            return redirect()->route('login', ['locale' => session('locale')])->with('warning', __('Please login first'));
        }
        //is user logged?  login> has register btn
        return redirect()->route('slot', ['slotId' => $slotId, 'locale' => session('locale')]);
    }

    public function refineSlots($slots)
    {
        $am = [];
        $pm = [];
        foreach ($slots as $slot) {
            $afrernoon = date('H:i:s', strtotime('12:00:00'));
            $time = date('H:i:s',  strtotime($slot['slot_time']));
            if ($time < $afrernoon) {
                array_push($am, ['CLIN_APPT_SLOT_ID' => $slot['CLIN_APPT_SLOT_ID'], 'slot_time' => date('g:i', strtotime($time))]);
            } else {
                array_push($pm, ['CLIN_APPT_SLOT_ID' => $slot['CLIN_APPT_SLOT_ID'], 'slot_time' => date('g:i', strtotime($time))]);
            }
        }
        return ['am' => $am, 'pm' => $pm];
    }

    public function render()
    {
        return view('livewire.doctor.appt');
    }
}
