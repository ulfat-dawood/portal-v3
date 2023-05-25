@extends('layout.master')
@section('title', __('Packages'))

@section('content')

    <div class="container xl:px-[9vw]">

        <x-master.breadcrumbs path="{{ __('Packages') }}" current="{{ __('All packages') }}" />



        <div class="container">

            {{-- CLINICS SELECT  --}}
            <div id="clinics" class="w-10/12 mx-auto">

                <div class="bg-grey-bg2 w-full rounded-lg p-3">
                    <div class="parners-swiper-container relative" wire:ignore>
                        <div class="swiper available-days w-11/12 m-auto">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper ">
                                <div class="swiper-slide !w-28  relative">

                                    <div class="group bg-white p-1.5 rounded-xl !w-28 block cursor-pointer">
                                        <div class="rounded-xl overflow-hidden">
                                            <div class="day-name bg-main-100 text-xs font-medium px-3 py-1 text-center text-main-600 group-hover:bg-main-200
                                                @if (is_null($clinicId) || $clinicId <= 0 )
                                                    bg-main-200
                                                @endif
                                            ">
                                                <a href="{{ route('getPackages', ['clinicId' => 0, 'locale' => session('locale')]) }}">
                                                    <div class="h-10 flex items-center justify-center
                                                        @if (is_null($clinicId) || $clinicId <= 0 )
                                                            text-main-600 font-bold
                                                        @endif
                                                    ">
                                                        @lang('All packages')
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @forelse ($clinics as $clinic)
                                    <div class="swiper-slide !w-28  relative">

                                        <div class="group bg-white  rounded-xl !w-28 block cursor-pointer">
                                            <a class="block p-1.5" href="{{ route('getPackages', ['clinicId' => $clinic['CLINIC_ID'], 'clinicName' => str_replace(' ', '_', $clinic['CLINIC_NAME']), 'locale' => session('locale')]) }}">

                                                <div class="rounded-xl overflow-hidden">
                                                    <div
                                                        class="day-name bg-main-100 text-xs font-medium px-3 py-1 text-center text-main-600 group-hover:bg-main-200
                                                        @if ($clinicId == $clinic['CLINIC_ID'])
                                                        bg-main-200
                                                        @endif
                                                        ">

                                                            <div class="h-10 flex items-center justify-center
                                                                @if ($clinicId == $clinic['CLINIC_ID'])
                                                                text-main-600 font-bold
                                                                @endif
                                                            ">
                                                                {{ $clinic['CLINIC_NAME'] }}
                                                            </div>

                                                    </div>

                                                </div>

                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-grey-text1 text-sm w-full text-center">
                                        @lang('No available appointments')
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <!-- navigation buttons -->
                        <div class="swiper-button-prev days !hidden md:!flex"></div>
                        <div class="swiper-button-next days !hidden md:!flex"></div>
                        <!-- pagination -->
                        <div class="swiper-pagination days "></div>
                    </div>

                </div>

                {{-- <ul class="flex gap-4">
                @foreach ($clinics as $clinic)
                    <li class="">
                        <a href="{{ route('getPackages', ['clinicId' => $clinic['CLINIC_ID'] , 'clinicName' => str_replace(' ', "_", $clinic['CLINIC_NAME']), 'locale' => session('locale')]) }}">
                            <div>{{$clinic['CLINIC_NAME']}}</div>
                        </a>
                    </li>
                @endforeach
            </ul> --}}
            </div>

            {{-- PACKAGES CARDS  --}}
            <div class="card w-10/12 mx-auto my-10 flex flex-col flex-wrap justify-center">
                @if (isset($packages))
                    @foreach ($packages as $key => $package)
                        <a class="hover:bg-gray-100"
                            href="{{ route('getPackage', ['locale' => session('locale'), 'packageId' => $package['PKG_ID']]) }}">

                            <div class="flex-grow p-2 my-1 relative">
                                <div class="flex-row rounded overflow-hidden shadow-lg mx-1 mb-1 mt-1 py-2 static bg-white">

                                    <div>
                                        <h1 class="flex text-md font-bold px-3 w-7/12 my-2">{{ $package['PKG_NAME'] }}
                                        </h1>
                                        <h6 class="flex px-3 mx-2 p-3 text-gray-600 text-sm">{{ $package['PKG_DESC'] }}
                                        </h6>
                                        <i class="icofont-location-pin text-xs px-4 mx-2 text-gray-400">
                                            {{ $package['HOSPITAL_NAME'] }}</i>
                                        <i class="icofont-location-pin text-xs px-4 mx-2 text-gray-400">
                                            {{ $package['CITY_NAME'] }}</i>
                                    </div>

                                    <div
                                        class="flex-shrink-0 absolute left-0 top-0 w-28 h-14 py-1 m-1 bg-main-500 rounded-xl text-center items-center">
                                        {{-- @if ($package['PKG_PRICE'] != $package['SRVC_PRICE'])
                                            <h2 class="text-sm text-gray line-through">{{ $package['PKG_PRICE'] }}
                                                @lang('SR')</h2>
                                            <h2 class="text-md text-white">{{ $package['SRVC_PRICE'] }}
                                                @lang('SR')</h2>
                                        @else
                                            <h2 class="text-md text-white">{{ $package['PKG_PRICE'] }} @lang('SR')
                                            </h2>
                                        @endif --}}
                                        @if ($package['PKG_PRICE'] != $package['SRVC_PRICE'])
                                            <h2 class="inline-block text-sm text-gray-200 line-through">
                                                {{ $package['SRVC_PRICE'] }}
                                            </h2>
                                            <h2 class="text-sm font-bold text-main-700">
                                                {{ $package['PKG_PRICE'] }}
                                                @lang('SR')</h2>
                                        @else
                                            <h2 class="text-sm font-bold text-main-700">
                                                {{ $package['PKG_PRICE'] }}
                                                @lang('SR')</h2>
                                        @endif
                                    </div>

                                    <div
                                        class="flex-shrink-0 absolute bottom-3 left-4 w-28 h-14 py-2 m-1 rounded-xl text-center items-center">
                                        <h1 class="text-sm icofont-rounded-left">@lang('Details')</h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center"><span>@lang('No Packages Available')</span></div>
                @endif
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        console.log(Swiper);
        var swiper = new Swiper(".available-days", {

            slidesPerView: 'auto',
            spaceBetween: 30,

            // Optional parameters
            direction: 'horizontal',
            // loop: true,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection
