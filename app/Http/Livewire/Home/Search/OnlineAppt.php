<?php

namespace App\Http\Livewire\Home\Search;

use Livewire\Component;

class OnlineAppt extends Component
{
    public $cities;
    public $clinics;
    public $msg = '';

    public function mount($cities , $clinics){
        $this->cities = $cities;
        $this->clinics = $clinics;
    }

    public function sendAlert(){
        $this->msg = __('Sorry, this service is not available at the moment.');
    }
    public function render()
    {
        return view('livewire.home.search.online-appt');
    }
}
