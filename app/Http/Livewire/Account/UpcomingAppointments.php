<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class UpcomingAppointments extends Component
{
    public $appointments;
    public $msg= "";

    public function mount(){

        try {
            $response = Http::post(env('API_URL') . '/' . app()->getLocale() . '/patient/appointments', [
                'id' => session('user')['id'],
            ]);
        } catch (\Throwable $th) {
            return  $this->msg = __('Server error: coudn\'t connect. Please try again');
        }
        if ($response->failed()) return  $this->msg = __('Error occured, please try again.');
        if (!$response->json()['status']) { $this->msg = $response->json()['msg']; }
        else {
            // Appointmetns retreived successfully
            $this->appointments = $response->json()['data'];
        }
    }

    public function cancel($slotId){
        // Cancel the Appt
        try {
            $response = Http::post(env('API_URL') . '/' . app()->getLocale() . '/slot/cancellation', [
                'Account_ID' => session('user')['id'],
                'slotId' => $slotId,
            ]);
        } catch (\Throwable $th) {
            return  session()->flash('error',  __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return  session()->flash('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return session()->flash('warning', $response->json()['msg']);

        // If cancellation successful: update appointmets array
        foreach($this->appointments as $key => $appt){
            if($appt['CLIN_APPT_SLOT_ID'] == $slotId) unset($this->appointments[$key]);
        }
        return session()->flash('success', __('Appointment canceled successfully'));

    }
    public function render()
    {
        return view('livewire.account.upcoming-appointments');
    }
}
