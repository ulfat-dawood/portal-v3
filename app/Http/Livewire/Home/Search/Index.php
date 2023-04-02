<?php

namespace App\Http\Livewire\Home\Search;

use Livewire\Component;

class Index extends Component
{
    public $selectedTab;
    public $cities;
    public $clinics;

    public function mount($cities , $clinics){
        $this->cities = $cities;
        $this->clinics = $clinics;
        $this->selectedTab = 1;
    }

    public function selectTab($selectedTab){

        $this->selectedTab = $selectedTab;
    }
    public function render()
    {
        return view('livewire.home.search.index');
    }
}
