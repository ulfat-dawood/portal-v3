<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PastVisits extends Component
{
    public $appts;
    public $msg= '';

    public function mount($patintDocument)
    {
        if (!Patient::isWathig()) {// if patient is not wathig

            return;
        }
            // prepare for the request:
                $token = session('apiToken');
                $api = env('API_URI');

                // Endpoint:
                $endpoint = $api . '/AthirProcedures/GetPatientAppointmentsPast';
                $parameters = [
                    'DocumentNo' => $patintDocument,
                    'PageSize' => '50'
                ];
                // Make request:
                try {
                    //is success?
                    $response = Http::withToken($token)->get($endpoint, $parameters)->json();
                    // dd($response['data']);
                    if (isset($response['operationType']) && $response['operationType'] == "Success") {
                        $this->appts = $response['data'];
                    } else {
                        $this->msg = __('Error occured, please try again.');
                    }
                } catch (\Throwable $th) {
                    return $th;
                }
    }

    // public function request
    public function render()
    {
        if (!Patient::isWathig()) {// if patient is not wathig

            return view('livewire.patient.wathig-btn');
        }
        return view('livewire.patient.medical-file.past-visits');
    }
}
