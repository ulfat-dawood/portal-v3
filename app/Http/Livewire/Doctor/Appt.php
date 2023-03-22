<?php

namespace App\Http\Livewire\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL as FacadesURL;
use Livewire\Component;
use RalphJSmit\Livewire\Urls\Facades\Url;


class Appt extends Component
{
    public $doctorAppts;
    public $selectedDay;
    public $slots;
    public $doctorInfo = ['doctorId' => '', 'centerId' => '', 'clinicId' => ''];
    public $param;
    public $msg;

    public function mount()
    {
    }

    public function updatedSelectedDay()
    {
        // prepare for the request:
        $token = session('apiToken');
        $api = env('API_URI');

        // Endpoint:
        $endpoint = $api . '/AthirProcedures/GetDoctorSlotsByDay';
        $parameters = [
            'DoctorId' => $this->param['DoctorId'],
            'CenterId' => $this->param['CenterId'],
            'ClinicID' => $this->param['ClinicID'],
            'SlotsDate' => $this->selectedDay,
            'pageSize' => '100'

        ];
        // Make request:
        try {
            //is success?
            $response = Http::withToken($token)->get($endpoint, $parameters)->json();
            if (isset($response['operationType']) && $response['operationType'] == "Success") {
                $this->slots =  $response['data'];
                $this->msg = '';
            } else {
                $this->msg = __('Error occured, please try again.');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getSlot($slotId)
    {
        return redirect()->route('slot', ['slotId' => $slotId, 'locale' => session('locale')]);
    }


    public function render()
    {
        return view('livewire.doctor.appt');
    }
}
