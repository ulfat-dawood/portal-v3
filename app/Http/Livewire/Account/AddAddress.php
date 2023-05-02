<?php

namespace App\Http\Livewire\Account;

use App\Http\Helpers\FeachPortalAPI;
use Livewire\Component;

class AddAddress extends Component
{
    public $msg;
    public $label;
    public $address;
    public $latitude;
    public $longitude;
    public $mapStatus; // 1= Location updating  2= Location selected

    public function submit()
    {

        $this->validate([
            'label' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        // Validation successful> Add address
        $response = FeachPortalAPI::feach('/account/location/add', [
            'accountId' =>  session('user')['id'],
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "label" => $this->label,
            "address" => $this->address,
            "buildingType" => '0',
        ], 'post');
        if (!$response[0]) {
            $this->msg = $response[2];
            return  session()->flash($response[1], $response[2]);
        } else {
            $this->msg = __('Address added successfully');
        }
        // Address added succefully
        // $this->emitUp('refreshAddresses');
        $this->emitUp('toggleModal', 0);
    }

    public function render()
    {
        return view('livewire.account.add-address');
    }
}
