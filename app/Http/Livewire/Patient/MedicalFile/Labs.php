<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Labs extends Component
{
    public $labs;
    public $patintDocument;
    public $msg ='';

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
        $endpoint = $api . '/AthirProcedures/GetPatientLabTestList';
        $parameters = [
            'NationalId' => $patintDocument
        ];

        // Make request:
        try {
            //is success?
            $response = Http::withToken($token)->get($endpoint, $parameters)->json();
            // dd($response);
            if (isset($response['operationType']) && $response['operationType'] == "Success") {

                // check data is not null before loop
                $labs = is_null($response['data']) ? [] : $response['data'];

                foreach ($labs as $key => $prescription) {
                    $labs[$key]['isOpen'] = false;
                    $labs[$key]['hasChild'] = 0;
                    $labs[$key]['child'] = [];
                }


                $this->labs = $labs;
            } else {
                $this->msg = __('Error occured, please try again.');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function toggleAccordion( $hasChild, $labOrderBaseId){

        foreach ($this->labs as $key => $lab) {

            if($lab['labOrderBaseId'] == $labOrderBaseId){

                //Load child  if  child does not exist
                if(!$this->labs[$key]['hasChild']){

                    //change hasChild state
                    $this->labs[$key]['hasChild'] = 1;

                    // prepare for the request:
                    $token = session('apiToken');
                    $api = env('API_URI');

                    // Endpoint:
                    $endpoint = $api . '/AthirProcedures/GetPatientLabTest';
                    $parameters = [
                        'NationalId' => $this->patintDocument,
                        'LabOrderID' => $labOrderBaseId
                    ];
                    // Make request:
                    try {
                        //is success?
                        $response = Http::withToken($token)->get($endpoint, $parameters)->json();
                        if (isset($response['operationType']) && $response['operationType'] == "Success") {
                            $this->labs[$key]['child']= $response['data'];

                        } else {
                            $msg = __('Error occured, please try again.');
                            return redirect()->back()->with('error', $msg);
                        }
                    } catch (\Throwable $th) {
                        return $th;
                    }
                }

                //Open/close accordion
                $this->labs[$key]['isOpen'] = !$lab['isOpen'];
            }
        }
    }

    public function downloadPdf($LabOrderID){
        return redirect()->route('lab-pdf' , [
            'locale' => session('locale'),
            'LabOrderID'=> $LabOrderID,
            'patintDocument'=> $this->patintDocument
        ]);
    }

    public function render()
    {
        if (!Patient::isWathig()) {// if patient is not wathig

            return view('livewire.patient.wathig-btn');
        }
        return view('livewire.patient.medical-file.labs');
    }
}
