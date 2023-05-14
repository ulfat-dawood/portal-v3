@extends('layout.master')
@section('title', __('Doctors'))

@section('content')

    <div class="container xl:px-[9vw]">

        <x-master.breadcrumbs path="doctors" current="Dr. Hussam" />
        <div class="container mb-10">
            <div class="flex items-start gap-10 flex-col lg:flex-row">

                <!-- start section  -->
                <div class="basis-full w-full flex-grow flex flex-col gap-5 flex-shrink-0 min-h-0 min-w-0 lg:basis-3/4 lg:w-3/4 lg:flex-grow-0 ">
                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Appointment details')</h3>

                        <div class="flex gap-4  flex-col lg:flex-row">

                            {{-- doctor info --}}
                            <div class="flex-grow flex gap-2 rounded-lg bg-grey-bg2 p-2">

                                <div class="bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                    <figure class="absolute left-0 right-0 top-0 bottom-0 ">
                                        <img src="{{ asset('assets/images/dr-' . $slot['SEX'] . '-no_bg.png') }}" alt="" class="w-full h-full object-cover">
                                    </figure>
                                </div>

                                <div class="space-y-2 flex-grow">
                                    <div class="text-xs ps-2">
                                        {{ $slot['CLINIC_NAME'] }}
                                    </div>
                                    <div class="bg-white rounded-md p-2 text-xs w-full">
                                        <i class="icofont-stethoscope text-xs"></i>
                                        {{ __('Dr.') . ' ' . $slot['DOCTOR_NAME_1'] . ' ' . $slot['DOCTOR_NAME_2'] . ' ' . $slot['DOCTOR_NAME_3'] . ' ' . $slot['DOCTOR_NAME_FAMILY'] }}
                                    </div>
                                </div>
                            </div>

                            {{-- appointment info  --}}
                            <div class="flex-grow space-y-2 bg-grey-bg2 p-2 rounded-lg">
                                <div class="text-xs ps-2">@lang('Reservation details')</div>
                                <div class="flex gap-2">
                                    <div class="flex-grow bg-white rounded-md p-2 text-xs flex justify-center items-center gap-1">
                                        <i class="icofont-clock-time"></i>
                                        {{ explode(':', $slot['slot_time'])[0] . ':' . explode(':', $slot['slot_time'])[1] }}
                                    </div>
                                    <div class="flex-grow bg-white rounded-md p-2 text-xs flex justify-center items-center gap-1">
                                        <i class="icofont-ui-calendar"></i>
                                        {{ explode('T', $slot['slot_day'])[0] }}
                                    </div>
                                    <div class="flex-grow bg-white rounded-md p-2 text-xs flex justify-center items-center gap-1">
                                        <i class="icofont-bill-alt"></i>
                                        {{-- @if ($slot['priceAfterDisc'] != $slot['priceBeforeDisc'])
                                            <div class="text-grey-border3 text-xs line-through">
                                                {{ $slot['priceBeforeDisc'] }}
                                            </div>
                                            <div class="text-sm">
                                                {{ $slot['priceAfterDisc'] }}
                                            </div>
                                        @else
                                            {{ $slot['examPrice'] }}
                                        @endif --}}
                                        {{ $slot['EXAM_PRICE'] }}

                                        <div>@lang('SR')</div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Clinic details')</h3>

                        {{-- center info --}}
                        <div class="flex gap-2 rounded-lg bg-grey-bg2 p-2">

                            <div class=" bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                <figure class="absolute left-0 right-0 top-0 bottom-0 ">
                                    @if (file_exists(public_path('storage/Logo/' . $slot['CENTER_LONG'])))
                                        <img class="w-full h-full object-cover" src="{{ asset('storage/Logo/' . $slot['CENTER_LONG']) }}" alt="">
                                    @else
                                        <img class="w-full h-full object-cover" src="{{ asset('assets/images/athir_logo.png') }}" alt="">
                                    @endif
                                    {{-- <img src="{{ asset('assets/images/dr-' . $slot['sex'] . '-no_bg.png') }}" alt=""
                                        class="w-full h-full object-cover"> --}}
                                </figure>
                            </div>
                            <div class="space-y-2 flex-grow">
                                <div class="text-xs ps-2">
                                    {{ $slot['CENTER_NAME'] }}
                                </div>
                                <div class="bg-white rounded-md p-2 text-xs w-full flex gap-3 items-center justify-between">
                                    <div>
                                        <i class="icofont-location-pin text-xs"></i>
                                        {{ $slot['ADDRESS'] }}
                                    </div>
                                    <div class="text-center bg-main-200 text-main-600 font-semibold rounded-lg hover:bg-main-300 text-xs transition-all
                                    focus:bg-main-300 focus:ring-2 focus:outline-none focus:ring-main-200">
                                        <a class="py-1 px-4 block" target="_blank" href="https://www.google.com/maps/dir/Current+Location/{{ $slot['CENTER_LAT'] }},{{ $slot['CENTER_LONG'] }}">@lang('Directions')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end section  -->
                <div class="basis-1/4 w-full flex-grow flex-shrink-0 lg:flex-grow-0 ">
                    <livewire:confirm-appt :slot='$slot'>
                </div>

            </div>
        </div>

    </div>

@endsection
