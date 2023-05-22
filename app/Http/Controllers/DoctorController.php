<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getDoctors(request $request)
    {
        $request->validate([
            'cityId' => 'required',
            'clinicId' => 'required',
        ]);
        $response = FeachPortalAPI::feach('/doctors/search', [
            'pageNo' => '',
            'perPage' => $request->perpage ? $request->perpage : 20,
            'cityId' =>  $request->cityId,
            'clinicId' =>  $request->clinicId,
            'allowCache' => 0,
            'appt_type_in' => $request->appt_type_in ? $request->appt_type_in : 225,
        ]);

        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];

        return view('doctors', [
            'totalePages' => $response->json()['data']['totalPages'],
            'pageNo' => $response->json()['data']['pageNo'],
            'doctors' => $response->json()['data']['doctors'],
            'appt_type_in' => $request->appt_type_in ? $request->appt_type_in : 225,

        ]);
    }

    public function getDoctor(Request $request)
    {
        $parameters = [
            'DoctorId' => $request->doctorId,
            'CenterId' => $request->centerId,
            'ClinicID' => $request->clinicId,
            'appt_type' => $request->appt_type_in,
        ];

        // Make request:
        $response = FeachPortalAPI::pool([
            '/doctor/' . $request->doctorId . '/' . $request->centerId . '/' . $request->clinicId,
            '/doctor/days/' . $request->doctorId . '/' . $request->centerId . '/' . $request->clinicId . '/' . $parameters['appt_type']
        ]);
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];

        return view('doctor', [
            'doctor' => $response[0]->json()['data'][0],
            'days' => collect($response[1]->json()['data'])->pluck('available_days'),
            'param' => $parameters,
            'breadcrumb' => session('locale') == 'ar' ? 'د. ' . $response[0]->json()['data'][0]['DOCTOR_NAME_1'] : 'Dr. ' . $response[0]->json()['data'][0]['DOCTOR_NAME_1'],
            'apptType' => request('appt_type_in')
        ]);
    }
}
