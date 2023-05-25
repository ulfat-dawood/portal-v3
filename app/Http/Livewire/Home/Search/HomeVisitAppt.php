<?php

namespace App\Http\Livewire\Home\Search;

use Livewire\Component;

class HomeVisitAppt extends Component
{
    public $cities;
    public $clinics;
    public $msg ='';
    public $appt_type_in = 225;
    public $cityId;
    public $clinicId;

    public function mount($cities , $clinics){
        $this->cities = $cities;
        $this->clinics = $clinics;
        $this->cityId = 3174;

    }
    public function loadSearchResults()
    {
        $this->validate([
            'cityId' => 'required',
            'clinicId' => 'required',
        ]);

        return redirect()->route('getDoctors', [
            'cityId' => $this->cityId,
            'clinicId' => $this->clinicId,
            'appt_type_in' => $this->appt_type_in,

        ]);
    }

    public function sendAlert(){
        $this->msg = __('Sorry, this service is not available at the moment.');
    }

    public function render()
    {
        return view('livewire.home.search.home-visit-appt');
    }
}
