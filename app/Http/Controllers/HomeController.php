<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return  view('index', [
            'cities' => ['Jeddah', 'Makkah', 'Taif'],
            'clinics' => ['Dental', 'General', 'Dermatology', 'Gynacology'],
            'packages' => [
                ['img'=> 'https://cdn.pixabay.com/photo/2014/12/10/21/01/doctor-563429_960_720.jpg', 'title'=> 'عرض الليزر', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
                ['img'=> 'https://cdn.pixabay.com/photo/2015/08/25/03/50/herbs-906140_960_720.jpg', 'title'=> 'عرض العناية بالوجه', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
                ['img'=> 'https://cdn.pixabay.com/photo/2016/09/14/20/50/tooth-1670434_960_720.png', 'title'=> 'عرض الأسنان', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
                ['img'=> 'https://cdn.pixabay.com/photo/2014/08/26/21/54/dentist-428646_960_720.jpg', 'title'=> 'عرض تقويم الأسنان', 'description'=> 'هنا وصف العرض', 'price'=> '500'],
            ]
        ]);
    }
}
