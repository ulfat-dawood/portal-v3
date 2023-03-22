@extends('layout.master')
@section('title', __('Home page'))
@section('content')
<x-home.banner />

{{-- <x-home.clinics :clinics="$clinics"/> --}}

{{-- <x-home.doctors-slider :ranDoctors="$ranDoctors"/> --}}

<x-home.partners/>

<x-home.features/>

<x-home.mobile-app/>

@endsection
