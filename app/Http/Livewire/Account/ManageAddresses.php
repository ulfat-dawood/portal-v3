<?php

namespace App\Http\Livewire\Account;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ManageAddresses extends Component
{
    public $addresses;
    public $showModal = 0;

    protected $listeners = ['toggleModal'];

    public function mount(){
        $response = FeachPortalAPI::feach( '/account/locations/'. session('user')['id']);

        // addresses retreived successfully
        $this->addresses = $response->json()['data'];
    }

    public function delete($locationId){
        // Cancel the Appt
        FeachPortalAPI::feach('/account/location/delete', ['accountId' => session('user')['id'],'locationId' => $locationId,], 'post');


        // If delete is successful: update addresses array
        foreach($this->addresses as $key => $address){
            if($address['ID'] == $locationId) unset($this->addresses[$key]);
        }
        return session()->flash('success', __('Address removed successfully.'));

    }

    public function toggleModal($showModal){
        $this->showModal = $showModal;
    }

    public function render()
    {
        return view('livewire.account.manage-addresses');
    }
}
