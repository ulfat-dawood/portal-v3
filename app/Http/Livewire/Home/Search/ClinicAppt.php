<?php

namespace App\Http\Livewire\Home\Search;

use Illuminate\Auth\Events\Validated;
use Livewire\Component;

class ClinicAppt extends Component
{
    public $cities;
    public $clinics;
    public $cityId;
    public $clinicId;

    public function mount($cities , $clinics){
        $this->cities = $cities;
        $this->clinics = $clinics;
        $this->cityId = 3174;
    }

    public function loadSearchResults(){
        $this->validate([
            'cityId' => 'required',
            'clinicId' => 'required',
        ]);

        return redirect()->route('getDoctors', [
            'cityId' => $this->cityId,
            'clinicId' => $this->clinicId,
        ]);
    }

    public function render()
    {
        return view('livewire.home.search.clinic-appt');
    }
}