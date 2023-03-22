<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComingAppointments extends Component
{
    public $appts ;
    public $msg= "";

    public function mount($patintDocument)
    {
        // prepare for the request:
        $token = session('apiToken');
        $api = env('API_URI');

        // Endpoint:
        $endpoint = $api . '/AthirProcedures/GetPatientAppointmentsUpcoming';
        $parameters = [
            'DocumentNo' => $patintDocument
        ];
        // Make request:
        try {
            $response = Http::withToken($token)->get($endpoint, $parameters)->json();
        } catch (\Throwable $th) {
            return $th;
        }
        if (isset($response['operationType']) && $response['operationType'] == "Success") {
            $this->appts = $response['data'];
            $this->msg = '';
        } else {
            $this->msg = __('Error occured, please try again.');
        }
    }

    public function cancel($ApptSotId)
    {
        return redirect()->route('delete-slot', ['slotId' => $ApptSotId, 'locale' => session('locale')]);
    }
    public function render()
    {
        return view('livewire.patient.medical-file.coming-appointments');
    }
}
