<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Http;
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
        try {
            $response = Http::post(
                env('API_URL') . '/' . app()->getLocale() . '/account/location/add',
                [
                    'accountId' =>  session('user')['id'],
                    "latitude" => $this->latitude,
                    "longitude" => $this->longitude,
                    "label" => $this->label,
                    "address" => $this->address,
                    "buildingType" => '0',
                ]
            );
        } catch (\Throwable $th) {
            return  session()->flash('error',  __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return  session()->flash('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return session()->flash('warning', $response->json()['msg']);

        // Address added succefully
        // $this->emitUp('refreshAddresses');
        $this->emitUp('toggleModal', 0);
    }

    public function render()
    {
        return view('livewire.account.add-address');
    }
}
