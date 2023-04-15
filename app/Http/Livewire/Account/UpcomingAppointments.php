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
    public function render()
    {
        return view('livewire.account.upcoming-appointments');
    }
}
