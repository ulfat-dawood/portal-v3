<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return  view('index', [
            'cities' => ['Jeddah', 'Makkah', 'Taif'],
            'clinics' => ['Dental', 'General', 'Dermatology', 'Gynacology']
        ]);
    }
}
