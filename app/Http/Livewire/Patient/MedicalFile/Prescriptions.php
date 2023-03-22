<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Prescriptions extends Component
{
    public $prescriptions;
    public $patintDocument;
    public $msg = '';

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
        $endpoint = $api . '/AthirProcedures/GetPatientPrescriptionList';
        $parameters = [
            'NationalId' => $patintDocument
        ];
        // Make request:
        try {
            //is success?
            $response = Http::withToken($token)->get($endpoint, $parameters)->json();
            if (isset($response['operationType']) && $response['operationType'] == "Success") {

                // check data is not null before loop
                $prescriptions = is_null($response['data']) ? [] : $response['data'];

                foreach ($prescriptions as $key => $prescription) {
                    $prescriptions[$key]['isOpen'] = false;
                    $prescriptions[$key]['hasChild'] = 0;
                    $prescriptions[$key]['child'] = [];
                }


                $this->prescriptions = $prescriptions;
            } else {
                $this->msg = __('Error occured, please try again.');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function toggleAccordion($hasChild, $phOrderBaseId)
    {

        foreach ($this->prescriptions as $key => $prescription) {

            if ($prescription['phOrderBaseId'] == $phOrderBaseId) {

                //Load child  if  child does not exist
                if (!$this->prescriptions[$key]['hasChild']) {

                    //change hasChild state
                    $this->prescriptions[$key]['hasChild'] = 1;

                    // prepare for the request:
                    $token = session('apiToken');
                    $api = env('API_URI');

                    // Endpoint:
                    $endpoint = $api . '/AthirProcedures/GetPatientPrescription';
                    $parameters = [
                        'NationalId' => $this->patintDocument,
                        'PhOrderId' => $phOrderBaseId
                    ];
                    // Make request:
                    try {
                        //is success?
                        $response = Http::withToken($token)->get($endpoint, $parameters)->json();
                        if (isset($response['operationType']) && $response['operationType'] == "Success") {
                            $this->prescriptions[$key]['child'] = $response['data'];
                        } else {
                            $msg = __('Error occured, please try again.');
                            return redirect()->back()->with('error', $msg);
                        }
                    } catch (\Throwable $th) {
                        return $th;
                    }
                }

                //Open/close accordion
                $this->prescriptions[$key]['isOpen'] = !$prescription['isOpen'];
            }
        }
    }

    public function downloadPdf($PhOrderId)
    {
        return redirect()->route('prescription-pdf', [
            'locale' => session('locale'), 'PhOrderId' => $PhOrderId, 'patintDocument' => $this->patintDocument
        ]);
    }

    public function render()
    {
        if (!Patient::isWathig()) { // if patient is not wathig

            return view('livewire.patient.wathig-btn');
        }

        return view('livewire.patient.medical-file.prescriptions');
    }
}
