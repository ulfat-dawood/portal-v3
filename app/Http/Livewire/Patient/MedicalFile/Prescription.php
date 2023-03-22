<?php

namespace App\Http\Livewire\Patient\MedicalFile;

use Livewire\Component;

class Prescription extends Component
{
    public $child;
    public function render()
    {

        return view('livewire.patient.medical-file.prescription');
    }
}
