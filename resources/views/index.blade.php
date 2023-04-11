@extends('layout.master')
@section('title', __('Home page'))
@section('content')

<x-home.banner :cities=$cities :clinics=$clinics />

{{-- <x-home.clinics :clinics="$clinics"/> --}}

{{-- <x-home.doctors-slider :ranDoctors="$ranDoctors"/> --}}

{{-- <x-home.packages :packages="$packages"/> --}}

<x-home.partners/>

<x-home.features/>

<x-home.mobile-app/>

@endsection
