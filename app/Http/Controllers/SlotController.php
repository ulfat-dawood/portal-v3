<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SlotController extends Controller
{
    public function getSlotX(Request $request)
    {
        //validate
        if (!$request->slotId) {
            return redirect()->back();
        }

        try {
            $responses = Http::pool(fn (Pool $pool) => [
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/slot/' . $request->slotId),
                $pool->get(env('API_URL') . '/' . app()->getLocale() . 'account/patientfinder', [
                    'accountId' => session('user')['id'],
                    'mobile_no' => session('user')['phone'],
                    'hospital_id' => '',
                ])
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responses[0]->failed() && $responses[1]->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$responses[0]->json()['status']) return redirect()->back()->with('warning', $responses[0]->json()['msg']);
        if (!$responses[1]->json()['status']) return redirect()->back()->with('warning', $responses[1]->json()['msg']);

        return view('slot', [
            'slot' => $responses[0]['data'][0],
            'patients' => $responses[1]['data']
        ]);
    }
    public function getSlot(Request $request)
    {
        //validate
        if (!$request->slotId) {
            return redirect()->back();
        }

        // Lock the slot if is not locked:
        try {
            $responseSlot = Http::get(env('API_URL') . '/' . app()->getLocale() . 'slot/locksingleslot' ,[
                'account_id'=> session('user')['id'],
                'slot_id' => $request->slotId
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responseSlot->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$responseSlot->json()['status']) return redirect()->back()->with('warning', $responseSlot->json()['msg']);

        // The slot is available and is not locked:
        try {
            $responseSlot = Http::get(env('API_URL') . '/' . app()->getLocale() . '/slot/' . $request->slotId);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responseSlot->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$responseSlot->json()['status']) return redirect()->back()->with('warning', $responseSlot->json()['msg']);
        return view('slot', [
            'slot' => $responseSlot['data'][0],
        ]);
    }
}
