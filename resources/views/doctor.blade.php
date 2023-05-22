@extends('layout.master')
@section('title', __('Doctors'))

@section('content')

    <div class="modal-box" id="doctor-qualifications">
        <header class="modal-header">
            <div class="title">@lang('Qualifications of Dr.') {{ $doctor['DOCTOR_NAME_1'] . ' ' . $doctor['DOCTOR_NAME_2'] . ' ' . $doctor['DOCTOR_NAME_3'] . ' ' . $doctor['DOCTOR_NAME_FAMILY'] }}</div>
            <div class="close-modal" data-close-modal='#doctor-qualifications'> <i class="icofont-close"></i> </div>
        </header>

        <div class="modal-content">

            <p class="p-2">
                {!! html_entity_decode($doctor['Qualifications']) !!}
            </p>

        </div>
    </div>
    <div class="container xl:px-[15vw]">

        <x-master.breadcrumbs path="{{ __('doctors') }}" current="{{ $breadcrumb }}" />
        <div class="container mb-10">
            <div class="flex flex-col gap-10">

                @inject('carbon', 'Carbon\Carbon')
                <!-- DOCTOR CARD  -->
                <div class="box flex flex-col rounded-none sm:rounded-lg sm:flex-row">
                    <!-- doctor img  -->
                    <div class="hidden overflow-hidden basis-3/12 relative rounded-lg sm:rounded-te-none sm:rounded-be-none sm:block">
                        <figure class="absolute w-full h-full">
                            <div>
                                @if (file_exists(public_path('storage/doctors_images/' . $doctor['Photo'])))
                                    <img class="bg-main-50 object-cover w-full h-full" src="{{ asset('storage/doctors_images/' . $doctor['Photo']) }}" alt="">
                                @else
                                    <img class="border border-grey-border1 border-0 border-e-2  object-cover w-full h-full" src="{{ asset('assets/images/dr-' . 'F' . '-no_bg.png') }}" alt="">
                                @endif
                            </div>
                        </figure>
                    </div>
                    <!-- card information -->
                    <div class="flex-grow divide-y divide-grey-border1">
                        <!-- doctor info  -->
                        {{-- @dump($doctor) --}}
                        <div class="">
                            <div>
                                <div class="flex flex-col justify-between p-3 hover:bg-grey-bg1 md:flex-row">
                                    <!-- start  -->
                                    <div class="flex flex-col gap-5">
                                        <div class="flex gap-2">
                                            <figure class="h-14 w-14 rounded-lg overflow-hidden sm:hidden">
                                                @if (file_exists(public_path('storage/doctors_images/' . $doctor['Photo'])))
                                                    <img class="bg-main-50 object-cover w-full h-full" src="{{ asset('storage/doctors_images/' . $doctor['Photo']) }}" alt="">
                                                @else
                                                    <img class="bg-main-50  object-cover w-full h-full" src="{{ asset('assets/images/dr-' . 'F' . '-no_bg.png') }}" alt="">
                                                @endif

                                                {{-- <img class="w-full h-full object-cover" src="../img/dr_female.png" alt=""> --}}
                                            </figure>
                                            <div>
                                                <div class="font-normal text-sm sm:text-lg ">{{ __('Dr.') }}
                                                    {{ $doctor['DOCTOR_NAME_1'] . ' ' . $doctor['DOCTOR_NAME_2'] . ' ' . $doctor['DOCTOR_NAME_3'] . ' ' . $doctor['DOCTOR_NAME_FAMILY'] }}
                                                </div>
                                                <div class="text-grey-border3 text-sm">
                                                    {{ $doctor['CLINIC_NAME'] }}

                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex gap-1 text-grey-border3 text-sm items-center">
                                                <div>
                                                    <i class="icofont-bill-alt text-grey-border3 text-sm"></i>
                                                </div>
                                                @if (/* $doctor['discount_percent'] */ 0 != 0)
                                                    <div class="text-grey-border3 text-xs line-through"> {{ $doctor['EXAM_PRICE'] }} </div>
                                                    <div class="text-sm">
                                                        {{ $doctor['EXAM_PRICE'] - ($doctor['discount_percent'] / 100) * $doctor['EXAM_PRICE'] }}
                                                    </div>
                                                    <div>@lang('SR')</div>
                                                    <div class="text-xs ms-2 font-bold rounded-full bg-secondary-100 text-secondary-400 px-2">
                                                        {{ $doctor['discount_percent'] }}%
                                                    </div>
                                                @else
                                                    <div class="text-sm">{{ $doctor['EXAM_PRICE'] }}</div>
                                                    <div>@lang('SR')</div>
                                                @endif

                                            </div>
                                            @if (!is_null($doctor['PORTAL_DISCOUNT']) && isset($doctor['PORTAL_DISCOUNT']) )
                                                <div class="flex gap-1 text-grey-border3 text-sm items-center">
                                                    <div>
                                                        <i class="icofont-sale-discount text-grey-border3 text-sm"></i>
                                                    </div>

                                                    <div>
                                                        {{$doctor['PORTAL_DISCOUNT']}}% @lang('discount')
                                                    </div>
                                                    <div>
                                                        @lang('on online payment.')
                                                    </div>
                                                </div>
                                            @endif

                                            @if (isset($doctor['earliest_appointment']) && !is_null($doctor['earliest_appointment']) && $doctor['earliest_appointment'] !== '')
                                                <div class="text-grey-border3 text-sm mt-3">
                                                    <i class="icofont-clock-time text-grey-border3 text-xs"></i>
                                                    @lang('Nearest appointment')
                                                    <span class="text-grey-border3 text-xs rounded-full bg-grey-bg2 px-2 font-normal  ms-2 w-fit sm:inline sm:ms-auto">
                                                        @if (session('locale') == 'ar')
                                                            يوم
                                                            {{ $carbon::parse($doctor['earliest_appointment'])->format('d-m-y') }}
                                                            الساعة
                                                            {{ $carbon::parse($doctor['earliest_appointment'])->format('H:i') }}
                                                        @else
                                                            on
                                                            {{ $carbon::parse($doctor['earliest_appointment'])->format('d-m-y') }}
                                                            at
                                                            {{ $carbon::parse($doctor['earliest_appointment'])->format('H:i') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <!-- end  -->
                                    <div class="flex gap-2 mt-2 md:flex-col md:mt-0">
                                        <div data-open-modal="#doctor-qualifications" class="cursor-pointer border border-main-600 text-main-600 rounded-lg text-center text-xs px-3 py-1 bg-white  hover:bg-main-50 basis-1/2 sm:basis-auto">
                                            @lang('View qualifications')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- clinic info  -->
                        <div>
                            <a href="">
                                <div class="flex justify-between p-3 hover:bg-grey-bg1">
                                    <!-- start  -->
                                    <div>
                                        <div class="text-grey-border3 text-sm font-normal">{{ $doctor['CENTER_NAME'] }}</div>
                                        <div>
                                            <i class="icofont-location-pin text-grey-border3 text-xs"></i>
                                            <span class="text-grey-border3 text-xs"> {{ $doctor['ADDRESS'] }} </span>
                                        </div>
                                    </div>
                                    <!-- end  -->
                                    {{-- <div class="basis-1/4 h-14"> --}}
                                    <div class=" h-10">
                                        @if (file_exists(public_path('storage/Logo/' . $doctor['LOGO'])))
                                            <img class="w-full h-full object-contain" src="{{ asset('storage/Logo/' . $doctor['LOGO']) }}" alt="">
                                        @else
                                            <img class="w-full h-full object-contain" src="{{ asset('assets/images/athir_logo.png') }}" alt="">
                                        @endif

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- DOCTOR CARD END -->
                <!-- DOCTOR APPT  -->
                <livewire:doctor.appt :days='$days' :param='$param' />
                <!-- DOCTOR APPT END -->

            </div>
        </div>

    </div>

@endsection
