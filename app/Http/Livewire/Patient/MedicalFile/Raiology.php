<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Raiology extends Component
{
    public $patintDocument;
    public $radiologyReports;
    public $msg= '';

    public function mount($patintDocument)
    {
        if (!Patient::isWathig()) {// if patient is not wathig

            return;
        }

        $this->patintDocument = $patintDocument;
        // prepare for the request:
        $token = session('apiToken');
        $api = env('API_URI');

        // Endpoint:
        $endpoint = $api . '/AthirProcedures/GetPatientRadiologyReportList';
        $parameters = [
            'NationalId' => $patintDocument
        ];
        // Make request:
        try {
            //is success?
            $response = Http::withToken($token)->get($endpoint, $parameters);
            if (isset($response['operationType']) && $response['operationType'] == "Success") {
                $this->radiologyReports = $response['data'];
            } else {
                $this->msg = __('Error occured, please try again.');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function downloadPdf($RdlgyOrderId){

        return redirect()->route('radiology-pdf' ,
        [
            'locale' => session('locale'),
            'RdlgyOrderId'=> $RdlgyOrderId,
            'patintDocument'=> $this->patintDocument
        ]);

    }
    public function render()
    {
        if (!Patient::isWathig()) {// if patient is not wathig

            return view('livewire.patient.wathig-btn');
        }

        return view('livewire.patient.medical-file.raiology');
    }
}
