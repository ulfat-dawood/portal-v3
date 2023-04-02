<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request){

        try {
            $response = Http::pool(fn (Pool $pool) => [
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/cities'),
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/clinics')
            ]);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response[0]->failed() && $response[1]->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        //check if the user exist
        if (!$response[0]->json()['status']) return redirect()->back()->with('warning', $response[0]->json()['msg']);
        if (!$response[1]->json()['status']) return redirect()->back()->with('warning', $response[1]->json()['msg']);


        return  view('index', [
            'cities' => $response[0]['data'],
            'clinics' => $response[1]['data'],
            'packages' => [
                ['img'=> 'https://cdn.pixabay.com/photo/2014/12/10/21/01/doctor-563429_960_720.jpg', 'title'=> 'عرض الليزر', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
                ['img'=> 'https://cdn.pixabay.com/photo/2015/08/25/03/50/herbs-906140_960_720.jpg', 'title'=> 'عرض العناية بالوجه', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
                ['img'=> 'https://cdn.pixabay.com/photo/2016/09/14/20/50/tooth-1670434_960_720.png', 'title'=> 'عرض الأسنان', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
                ['img'=> 'https://cdn.pixabay.com/photo/2014/08/26/21/54/dentist-428646_960_720.jpg', 'title'=> 'عرض تقويم الأسنان', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
            ]
        ]);
    }
}
