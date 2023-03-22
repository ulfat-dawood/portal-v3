<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MedicalReports extends Component
{
    public $patintDocument;
    public $medicalReports;
    public $msg = '';

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
        $endpoint = $api . '/AthirProcedures/GetPatientMedicalReportList';
        $parameters = [
            'NationalId' => $patintDocument
        ];
        // Make request:
        try {
            //is success?
            $response = Http::withToken($token)->get($endpoint, $parameters)->json();
            if (isset($response['operationType']) && $response['operationType'] == "Success") {
                $this->medicalReports = $response['data'];
            } else {
                $this->msg = __('Error occured, please try again.');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function downloadPdf($MedicalReportId){

        return redirect()->route('medical-report-pdf' ,
        [
            'locale' => session('locale'),
            'MedicalReportId'=> $MedicalReportId,
            'patintDocument'=> $this->patintDocument
        ]);

    }
    public function render()
    {
        if (!Patient::isWathig()) {// if patient is not wathig

            return view('livewire.patient.wathig-btn');
        }
        return view('livewire.patient.medical-file.medical-reports');
    }
}
