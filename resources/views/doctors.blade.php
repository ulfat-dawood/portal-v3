@extends('layout.master')
@section('title', __('Doctors'))

@section('content')

    <div class="container xl:px-[15vw]">

        <x-master.breadcrumbs  current="{{__('doctors')}}"/>

        <div class="flex gap-10 items-start mb-10">
            {{-- <x-doctors.filter/> --}}

            <x-doctors.cards :doctors="$doctors" apptType="{{$appt_type_in}}" totalPages="{{ $totalePages }}" pageNumber="{{ $pageNo }}" />

        </div>

    </div>

@endsection
