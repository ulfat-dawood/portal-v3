<?php

namespace App\Http\Controllers;

use App\View\Components\packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {

        $packages = Http::get(env('API_URL') . '/packages');
        dd($packages);
        // $packages = json_decode($apiResponse);
        // dd($response);
        // $packages = $response['data'];

        // if (is_null($response)){
        //     $packages = __('No Packages Available');
        // } else {
        //     $packages = $response;
        // }

        return view('index', compact('packages'));

        // return  view('index', [
        //     'cities' => ['Jeddah', 'Makkah', 'Taif'],
        //     'clinics' => ['Dental', 'General', 'Dermatology', 'Gynacology'],
        //     'packages' => [
        //         ['img'=> 'https://cdn.pixabay.com/photo/2014/12/10/21/01/doctor-563429_960_720.jpg', 'title'=> 'عرض الليزر', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
        //         ['img'=> 'https://cdn.pixabay.com/photo/2015/08/25/03/50/herbs-906140_960_720.jpg', 'title'=> 'عرض العناية بالوجه', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
        //         ['img'=> 'https://cdn.pixabay.com/photo/2016/09/14/20/50/tooth-1670434_960_720.png', 'title'=> 'عرض الأسنان', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
        //         ['img'=> 'https://cdn.pixabay.com/photo/2014/08/26/21/54/dentist-428646_960_720.jpg', 'title'=> 'عرض تقويم الأسنان', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
        //     ]
        // ]);
    }
}
