<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ManageAddresses extends Component
{
    public $addresses;
    public $msg= "";

    public function mount(){

        try {
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/account/locations/'. session('user')['id']);
        } catch (\Throwable $th) {
            return   session()->flash('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return  session()->flash('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return session()->flash('warning', $response->json()['msg']);

        // addresses retreived successfully
        $this->addresses = $response->json()['data'];
    }

    public function delete($locationId){
        // Cancel the Appt
        try {
            $response = Http::post(env('API_URL') . '/' . app()->getLocale() . '/account/location/delete', [
                'accountId' => session('user')['id'],
                'locationId' => $locationId,
            ]);
        } catch (\Throwable $th) {
            return  session()->flash('error',  __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return  session()->flash('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return session()->flash('warning', $response->json()['msg']);

        // If delete is successful: update addresses array
        foreach($this->addresses as $key => $address){
            if($address['ID'] == $locationId) unset($this->addresses[$key]);
        }
        return session()->flash('success', __('Address removed successfully.'));

    }

    public function render()
    {
        return view('livewire.account.manage-addresses');
    }
}
