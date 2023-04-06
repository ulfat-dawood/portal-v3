@extends('layout.master')
@section('title', __('Doctors'))

@section('content')

<div class="container xl:px-[15vw]">

    {{-- <x-master.breadcrumbs  path="{{__('doctors')}}" current="{{$breadcrumb}}"/> --}}

    <div class="flex gap-10 items-start my-10">
        {{-- <x-doctors.filter/> --}}
        <x-doctors.cards :doctors="$doctors" totalPages="{{$totalePages}}" pageNumber="{{$pageNo}}"/>

    </div>


</div>

@endsection
