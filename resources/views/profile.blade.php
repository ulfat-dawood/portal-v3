@extends('layout.master')
@section('title', __('User Profile'))

@section('content')
    <div class="flex justify-center">
        <div class="box max-w-xl w-full mt-10 overflow-hidden">
            <div class="bg-main-600 text-white text-xs text-center py-2 font-semibold">@lang('USER PROFILE')</div>

            <form action="" class="p-4 space-y-4 md:p-7 md:space-y-7">

                {{-- Name  --}}
                <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                    <div class="w-40 shrink-0 grow-0 text-xs">@lang('Name')</div>

                    <div class="input-box-wrapper w-full">
                        <div class="input-box">
                            @if (session('locale') == 'ar')
                                {{ session('user')['patientName1b'] .
                                ' ' .
                                session('user')['patientName2b'] .
                                ' ' .
                                session('user')['patientName3b'] .
                                ' ' .
                                session('user')['patientNameFamilyb'] .
                                ' ' }}
                            @else
                                {{ session('user')['patientName1'] .
                                ' ' .
                                session('user')['patientName2'] .
                                ' ' .
                                session('user')['patientName3'] .
                                ' ' .
                                session('user')['patientNameFamily'] .
                                ' ' }}
                            @endif

                        </div>
                        <i class="text-sm icofont-ui-user"></i>
                    </div>

                </div>

                {{-- ID Number  --}}
                <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                    <div class="w-40 shrink-0 grow-0 text-xs">@lang('ID Number')</div>

                    <div class="input-box-wrapper w-full">
                        <div class="input-box">
                            {{ session('user')['documentNumber'] }}
                        </div>
                        <i class="text-sm icofont-id"></i>
                    </div>

                </div>

                {{-- DOB --}}
                <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                    <div class="w-40 shrink-0 grow-0 text-xs">@lang('Date of birth')</div>

                    <div class="input-box-wrapper w-full">
                        <div class="input-box">{{ explode('T', session('user')['dateOfBirth'])[0] }}</div>
                        <i class="text-sm icofont-calendar"></i>
                    </div>

                </div>

                {{-- Nationality --}}
                <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                    <div class="w-40 shrink-0 grow-0 text-xs">@lang('Nationality')</div>

                    <div class="input-box-wrapper w-full">
                        <div class="input-box">{{ session('user')['nationaltyCode'] }}</div>
                        <i class="text-sm icofont-globe"></i>
                    </div>

                </div>

                {{-- Mobile Number  --}}
                <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                    <div class="w-40 shrink-0 grow-0 text-xs">@lang('Mobile No.')</div>

                    <div class="input-box-wrapper w-full">
                        <div class="input-box">{{ session('user')['mobileNo'] }}</div>
                        <i class="text-sm icofont-mobile-phone"></i>
                    </div>

                </div>


            </form>
        </div>
    </div>


@endsection
