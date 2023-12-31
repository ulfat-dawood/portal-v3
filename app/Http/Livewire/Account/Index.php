<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class Index extends Component
{
    public $selectedTab;
    public $tabs = [];
    public $test;
    public function mount($tabNo = 1)
    {
        //validate URI param is btw 1-7:
        $tabsRange = [1,2,3,4];
        $this->selectedTab= in_array($tabNo, $tabsRange) ? $tabNo : 1;

        $this->tabs = [
            1=> ['title'=> __('Upcoming Appointments'), 'icon'=>'ui-calendar'] ,
            2=> ['title'=> __('Past Visits'), 'icon'=>'history'] ,
            3=> ['title'=> __('Manage Addresses'), 'icon'=>'location-pin'] ,
            4=> ['title'=> __('Account info'), 'icon'=>'info-square'] ,
 ];
    }

    public function selectTab($selectedTab)
    {
        if($selectedTab==0){return; }
        $this->selectedTab = $selectedTab;
    }
    public function render()
    {
        return view('livewire.account.index');
    }
}
