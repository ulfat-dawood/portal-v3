<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DoctorController extends Controller
{
    public function getDoctors(request $request)
    {
        $request->validate([
            'cityId' => 'required',
            'clinicId' => 'required',

        ]);
        try {
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/doctors/search', [
                'pageNo' => '',
                'perPage' => $request->perpage ? $request->perpage : 20,
                'cityId' =>  $request->cityId,
                'clinicId' =>  $request->clinicId,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);

        return view('doctors', [
            'totalePages' => $response->json()['data']['totalPages'],
            'pageNo' => $response->json()['data']['pageNo'],
            'doctors' => $response->json()['data']['doctors'],
        ]);
    }

    public function getDoctor(Request $request)
    {
        $parameters = [
            'DoctorId' => $request->doctorId,
            'CenterId' => $request->centerId,
            'ClinicID' => $request->clinicId,
        ];

        // Make request:

        try {
            $responses = Http::pool(fn (Pool $pool) => [
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/doctor/' . $request->doctorId . '/' . $request->centerId . '/' . $request->clinicId),
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/doctor/days/' . $request->doctorId . '/' . $request->centerId . '/' . $request->clinicId)
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responses[0]->failed() && $responses[1]->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$responses[0]->json()['status']) return redirect()->back()->with('warning', $responses[0]->json()['msg']);
        if (!$responses[1]->json()['status']) return redirect()->back()->with('warning', $responses[1]->json()['msg']);

        return view('doctor', [
            'doctor' => $responses[0]->json()['data'][0],
            'days' => collect($responses[1]->json()['data'])->pluck('available_days'),
            'param' => $parameters,
            'breadcrumb' => session('locale') == 'ar' ? 'د. ' . $responses[0]->json()['data'][0]['DOCTOR_NAME_1'] : 'Dr. ' . $responses[0]->json()['data'][0]['DOCTOR_NAME_1']
        ]);
    }
}
