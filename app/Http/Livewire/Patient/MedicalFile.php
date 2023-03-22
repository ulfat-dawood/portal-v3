<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;

class MedicalFile extends Component
{

    public $selectedTab;
    public $tabs = [];
    public $test;
    public function mount($tabNo = 1)
    {
        //validate URI param is btw 1-7:
        $tabsRange = [1,2,3,4,5,6,7];
        $this->selectedTab= in_array($tabNo, $tabsRange) ? $tabNo : 1;

        $this->tabs = [
            1=> ['title'=> __('Upcoming Appointments'), 'icon'=>'ui-calendar'] ,
            2=> ['title'=> __('Past Visits'), 'icon'=>'history'] ,
            3=> ['title'=> __('Sick Leaves'), 'icon'=>'thermometer'] ,
            4=> ['title'=> __('Prescriptions'), 'icon'=>'pills'] ,
            5=> ['title'=> __('Radiology'), 'icon'=>'radio-active'] ,
            6=> ['title'=> __('Lab Test'), 'icon'=>'laboratory'] ,
            7=> ['title'=> __('Medical Reports'), 'icon'=>'paperclip'] ];
    }

    public function selectTab($selectedTab)
    {
        if($selectedTab==0){return; }
        $this->selectedTab = $selectedTab;
    }
    public function render()
    {
        return view('livewire.patient.medical-file');
    }
}
