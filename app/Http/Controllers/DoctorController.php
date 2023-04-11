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
        // dd($request->perpage);
        try {
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/doctors/search', [
                'pageNo' => '',
                'perPage' => $request->perpage ? $request->perpage : 20,
                'cityId' =>  $request->cityId,
                'clinicId' =>  $request->clinicId,
                'allowCache' => 0 , 
            ]);
            // dd($response->json());
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

    public function getDoctor()
    {

        $parameters = [
            'DoctorId' => request('doctorId'),
            'CenterId' => request('centerId'),
            'ClinicID' => request('clinicId'),
            'pageSize' => '50'
        ];

        // Make request:

        try {
            $responses = Http::pool(fn (Pool $pool) => [
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/doctor/' . request('doctorId') . '/' . request('centerId') . '/' . request('clinicId')),
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/doctor/days/' . request('doctorId') . '/' . request('centerId') . '/' . request('clinicId'))
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responses[0]->failed() && $responses[1]->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$responses[0]->json()['status']) return redirect()->back()->with('warning', $responses[0]->json()['msg']);
        if (!$responses[1]->json()['status']) return redirect()->back()->with('warning', $responses[1]->json()['msg']);

        $days = [];
        foreach ($responses[1]->json()['data'] as $day) {
            array_push($days, ['date' => $day['available_days'], 'day' => $this->getDay($day['available_days'])]);
        };
        // dd([$responses[0]->json(), $days]);
        $discountInfo = [
            // 'discPercentage' => $responses[0]->json()['data']['discount'],
            // 'priceBeforeDisc' => $responses[0]->json()['data']['examPrice'],
            // 'priceAfterDisc' => $responses[0]->json()['data']['examPrice'] - (($responses[0]->json()['data']['examPrice'] / 100) * $responses[0]->json()['data']['discount'])
        ];
        return view('doctor', [
            'doctor' => array_merge($responses[0]->json()['data'][0],  $discountInfo),
            // 'doctorQualifications' => $responses[0]->json()['data']['qualificationsB'] ,
            'days' => $days,
            'param' => $parameters,
            'breadcrumb' => session('locale') == 'ar' ? 'د. ' . $responses[0]->json()['data'][0]['DOCTOR_NAME_1'] : 'Dr. ' . $responses[0]->json()['data'][0]['DOCTOR_NAME_1']
        ]);
    }

    public function getDay($date)
    {
        $dayName = '';
        // Slot date
        $date = strtotime($date);
        // Today's date
        $today = strtotime('now');
        // Tomorrow's date
        $tomorrow = strtotime('tomorrow');
        // If event date is equal to today's date, show TODAY
        if (date('m-d-Y', $today) == date('m-d-Y', $date)) {
            $dayName = __('Today');
        }
        // If event date is equal to tomorrow's date, show TOMORROW
        if (date('m-d-Y', $tomorrow) == date('m-d-Y', $date)) {
            $dayName = __('Tomorrow');
        }
        // If event date is not equal to today's or tomorrow's date, print the date
        if ((date('m-d-Y', $today) != date('m-d-Y', $date)) && (date('m-d-Y', $tomorrow) != date('m-d-Y', $date))) {
            $dayName = date('l', $date);  //returs full day name
            if (session('locale') == 'ar') { // if locale is Arabic
                switch ($dayName) {
                    case "Saturday":
                        $dayName = "السبت";
                        break;
                    case "Sunday":
                        $dayName = "الأحد";
                        break;
                    case "Monday":
                        $dayName = "الاثنين";
                        break;
                    case "Tuesday":
                        $dayName = "الثلاثاء";
                        break;
                    case "Wednesday":
                        $dayName = "الأربعاء";
                        break;
                    case "Thursday":
                        $dayName = "الخميس";
                        break;
                    case "Friday":
                        $dayName = "الجمعة";
                        break;
                }
            } else { //if locale is English
                // $dayName = date('l' , $date);   //returs full day name
                $dayName = date('D', $date);  // returns short day name
            }
        }
        return $dayName;
    }
}
