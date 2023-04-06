<?php

namespace App\Http\Livewire\Home\Search;

use Livewire\Component;

class ClinicAppt extends Component
{
    public $cities;
    public $clinics;

    public function mount($cities , $clinics){
        $this->cities = $cities;
        $this->clinics = $clinics;
    }

    public function render()
    {
        return view('livewire.home.search.clinic-appt');
    }
}
