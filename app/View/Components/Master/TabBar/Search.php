<?php

namespace App\View\Components\Master\TabBar;

use App\Models\APIRequest;
use Illuminate\View\Component;

class Search extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function clinics()
    {
        if (!session('clinics')) {
            $clinics = APIRequest::send('/AthirProcedures/GetClinics');
            session(['clinics' => $clinics]);
        }
        return session('clinics');

    }

    public function centers()
    {
        if (!session('centers')) {
            $centers = APIRequest::send('/AthirProcedures/GetCenters');
            session(['centers' => $centers]);
        }
        return session('centers');

    }

    public function doctors()
    {
        if (!session('doctors')) {
            $doctors = APIRequest::send('/AthirProcedures/GetDoctors');
            session(['doctors' => $doctors]);
        }
        return session('doctors');

    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.master.tab-bar.search');
    }
}
