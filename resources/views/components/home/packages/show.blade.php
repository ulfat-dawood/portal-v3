@extends('layout.master')
@section('title', __('Packages'))

@section('content')

    <div class="container xl:px-[9vw]">

        <x-master.breadcrumbs path="{{ __('Packages') }}" current="{{ $package['PKG_NAME'] }}" />
        <div class="container">
            <div class="flex items-start gap-10 flex-col lg:flex-row">
                <div class="flex-grow flex flex-col gap-5 min-h-0 min-w-0 my-4">
                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Package details')</h3>

                        <div class="flex gap-4 flex-col md:flex-row">

                            <div class="flex-grow flex gap-2 rounded-lg bg-grey-bg2 p-2">
                                {{-- <div class="flex-none bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                    <figure class="absolute left-0 right-0 top-0 bottom-0">
                                        <img src="{{ $package['PKG_PHOTO'] }}" alt=""
                                            class="w-full h-full object-cover">
                                    </figure>
                                </div> --}}

                                <div class="space-y-2 flex-grow">
                                    <div class="text-md font-semibold ps-2">
                                        {{ $package['PKG_NAME'] }}
                                    </div>
                                    <div class="bg-white rounded-md p-2 text-sm w-full flex-wrap">
                                        <i class="text-sm">{{ $package['PKG_DESC'] }}</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Clinic details')</h3>

                        {{-- center info --}}
                        <div class="flex gap-2 rounded-lg bg-grey-bg2 p-2">

                            <div class="bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                <figure class="absolute left-0 right-0 top-0 bottom-0 ">
                                    @if (file_exists(public_path('storage/Logo/')))
                                        <img class=" object-cover" src="#" alt="">
                                    @else
                                        <img class="h-full w-full object-cover"
                                            src="{{ asset('assets/images/athir_logo.png') }}" alt="">
                                    @endif
                                </figure>
                            </div>
                            <div class="space-y-2 flex-grow">
                                <div class="bg-white rounded-md p-2 text-sm w-full">
                                    <i class="text-md"></i>
                                    {{ $package['HOSPITAL_NAME'] }}
                                </div>
                                <div class="text-xs ps-2">
                                    <i class="icofont-location-pin text-xs"></i>
                                    {{-- {{ $package['CITY_NAME'] }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end section  -->
                    <div class="basis-1/4 flex-grow flex-shrink-0 lg:flex-grow-0 ">

                        <div class="box p-4 space-y-2">
                            {{-- appointment info  --}}
                            <h3 class="font-bold text-sm inlin">@lang('Package confirmation')</h3>
                            <p class="my-4 text-sm text-grey-text1">
                                @lang('Order the package by clicking below')
                            </p>
                            <div class="flex-grow gap-2 h-full">
                                <div class="my-3 mx-6">
                                    @if ($package['PKG_PRICE'] != $package['SRVC_PRICE'])
                                        <div class="mr-6 text-sm">
                                            <p class="inline-block w-11/12">@lang('price before discount')</p>
                                            <h2 class="inline-block line-through">{{ $package['PKG_PRICE'] }}
                                                @lang('SR')</h2>
                                        </div>
                                        <div class="mr-6 text-sm">
                                            <p class="inline-block w-11/12">@lang('total')</p>
                                            <h2 class="inline-block">{{ $package['SRVC_PRICE'] }} @lang('SR')</h2>
                                        </div>
                                    @else
                                        <div class="mr-6 text-sm">
                                            <p class="inline-block w-11/12">@lang('total')</p>
                                            <h2 class="inline-block">{{ $package['PKG_PRICE'] }} @lang('SR')</h2>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <form method="GET"
                                action="{{ route('package.order', ['locale' => session('locale'), 'packageId' => $package['PKG_ID']]) }}"
                                class="space-y-2">

                                <button type="submit" class="btn-primary w-full">
                                    @lang('Order the packages')
                                </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection
