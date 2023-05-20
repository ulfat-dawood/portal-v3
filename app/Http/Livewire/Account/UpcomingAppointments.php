<?php

namespace App\Http\Livewire\Account;

use App\Http\Helpers\FeachPortalAPI;
use Livewire\Component;

class UpcomingAppointments extends Component
{
    public $appointments;
    public $msg = "";

    public function mount()
    {
        $response = FeachPortalAPI::feach('/patient/appointments', ['id' => session('user')['id']], 'post');
        if (!$response[0]) {
            $this->msg = $response[2];
        } else {
            $response = $response[0];

            $onlyUpcomingAppt = array_filter($response->json()['data'], function($arr) {
                $date_now = time();
                $date_appt = strtotime($arr['APPT_DATE']);
                if ($date_now < $date_appt)
                    return TRUE;
                else
                    return FALSE;
            });
            $this->appointments = $onlyUpcomingAppt;
        }
    }

    public function cancel($slotId)
    {
        // Cancel the Appt
        $response = FeachPortalAPI::feach('/slot/cancellation', ['Account_ID' => session('user')['id'], 'slotId' => $slotId,], 'post');
        if (!$response[0]) {
            $this->msg = $response[2];
            return  session()->flash($response[1], $response[2]);
        }
        // If cancellation successful: update appointmets array
        foreach ($this->appointments as $key => $appt) {
            if ($appt['CLIN_APPT_SLOT_ID'] == $slotId) unset($this->appointments[$key]);
        }
        return session()->flash('success', __('Appointment canceled successfully'));
    }
    public function render()
    {
        return view('livewire.account.upcoming-appointments');
    }
}
