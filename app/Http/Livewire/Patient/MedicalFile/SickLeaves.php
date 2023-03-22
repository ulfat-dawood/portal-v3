<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SickLeaves extends Component
{
    public $sickLeaves;
    public $patintDocument;
    public $msg= '';

    public function mount($patintDocument)
    {
        if (!Patient::isWathig()) { // if patient is not wathig

            return;
        }

        $this->patintDocument = $patintDocument;
        // prepare for the request:
        $token = session('apiToken');
        $api = env('API_URI');

        // Endpoint:
        $endpoint = $api . '/AthirProcedures/GetPatientSickleaveList';
        $parameters = [
            'NationalId' => $patintDocument
        ];
        // Make request:
        try {
            //is success?
            $response = Http::withToken($token)->get($endpoint, $parameters)->json();
            if (isset($response['operationType']) && $response['operationType'] == "Success") {
                $this->sickLeaves = $response['data'];
            } else {
                $this->msg = __('Error occured, please try again.');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function downloadPdf($SickLeaveId)
    {
        return redirect()->route('sick-leave-pdf', ['locale' => session('locale'), 'SickLeaveId' => $SickLeaveId, 'patintDocument' => $this->patintDocument]);
    }

    public function render()
    {
        if (!Patient::isWathig()) { // if patient is not wathig

            return view('livewire.patient.wathig-btn');
        }
        return view('livewire.patient.medical-file.sick-leaves');
    }
}
