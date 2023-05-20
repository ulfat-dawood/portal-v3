<?php

namespace App\Http\Livewire\Account;

use App\Http\Helpers\FeachPortalAPI;
use Livewire\Component;

class PastAppointments extends Component
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

            $onlyPastAppt = array_filter($response->json()['data'], function($arr) {
                return time() > strtotime($arr['APPT_DATE']);
            });
            $this->appointments = $onlyPastAppt;
        }
    }

    public function render()
    {
        return view('livewire.account.past-appointments');
    }
}
