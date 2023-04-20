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
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        // addresses retreived successfully
        $this->addresses = $response->json()['data'];
    }

    public function delete($locationId){
        // Cancel the Appt
        $response = FeachPortalAPI::feach('/account/location/delete', ['accountId' => session('user')['id'],'locationId' => $locationId,], 'post');
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];

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
