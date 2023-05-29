@extends('layout.master')
@section('title', __('Packages'))

@section('content')

    <div class="container xl:px-[9vw]">

        <x-master.breadcrumbs path="{{ __('Packages') }}" current="{{ __('All packages') }}" />



        <div class="box p-4 w-full mb-4">

            {{-- CLINICS SELECT  --}}
            <div id="clinics" class="">

                <div class="bg-grey-bg2 w-full rounded-lg p-3">
                    <div class="parners-swiper-container relative" wire:ignore>
                        <div class="swiper available-days w-11/12 m-auto">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper ">
                                <div class="swiper-slide !w-28  relative">

                                    <div class="group bg-white p-1.5 rounded-xl !w-28 block cursor-pointer">
                                        <div class="rounded-xl overflow-hidden">
                                            <div
                                                class="day-name bg-main-100 text-xs font-medium px-3 py-1 text-center text-main-600 group-hover:bg-main-200
                                                @if (is_null($clinicId) || $clinicId <= 0) bg-main-200 @endif
                                            ">
                                                <a
                                                    href="{{ route('getPackages', ['clinicId' => 0, 'locale' => session('locale')]) }}">
                                                    <div
                                                        class="h-10 flex items-center justify-center
                                                        @if (is_null($clinicId) || $clinicId <= 0) text-main-600 font-bold @endif
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
                                            <a class="block p-1.5"
                                                href="{{ route('getPackages', ['clinicId' => $clinic['CLINIC_ID'], 'clinicName' => str_replace(' ', '_', $clinic['CLINIC_NAME']), 'locale' => session('locale')]) }}">

                                                <div class="rounded-xl overflow-hidden">
                                                    <div
                                                        class="day-name bg-main-100 text-xs font-medium px-3 py-1 text-center text-main-600 group-hover:bg-main-200
                                                        @if ($clinicId == $clinic['CLINIC_ID']) bg-main-200 @endif
                                                        ">

                                                        <div
                                                            class="h-10 flex items-center justify-center
                                                                @if ($clinicId == $clinic['CLINIC_ID']) text-main-600 font-bold @endif
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
            <div class="mt-7 space-y-7 w-full max-w-2xl mx-auto">
                @foreach ( $packages as $package )
                    <a class="block" href="{{ route('getPackage', ['locale' => session('locale'), 'packageId' => $package['PKG_ID']]) }}">
                        <div class="flex flex-grow shadow-[0px_0px_5px_0px_#00000020] rounded-lg p-4 gap-2 flex-col hover:shadow-[0px_0px_15px_0px_#00000020]">

                            <!-- Package main info -->
                            <div class="flex flex-col justify-between items-center px-4 sm:flex-row">
                                <div class="text-center sm:text-start">
                                    <div class="font-bold text-main-600 text-lg">{{$package['PKG_NAME']}}</div>
                                    <div class="text-xs text-grey-text1">{{$package['CLINIC_NAME']}}</div>
                                </div>
                                <div class="flex gap-1 items-center">
                                    <div class="line-through text-sm text-grey-text1">{{ $package['SRVC_PRICE'] }}</div>
                                    <div class="font-bold text-main-600 text-lg">{{ $package['PKG_PRICE'] }}</div>
                                    <div class="font-bold text-main-600 text-lg">@lang('SR')</div>
                                </div>
                            </div>

                            <!-- Package details -->
                            <div class="bg-grey-bg1 rounded-lg d py-4 px-4 flex flex-col gap-4">
                                <div class="text-xs text-grey-text1 bg-white px-2 py-1 rounded-md">
                                    {{$package['PKG_DESC']}}
                                </div>
                                <div class="flex flex-col justify-between items-center px-2 sm:flex-row">
                                    <div class="text-xs font-bold text-grey-text1 text-center sm:text-start"> {{$package['HOSPITAL_NAME']}}  </div>
                                    <div class="text-xs font-bold text-grey-text1"><i class="icofont-location-pin text-xs"></i>{{$package['CITY_NAME']}}</div>
                                </div>
                            </div>



                        </div>
                    </a>
                @endforeach
            </div>




            {{-- PACKAGES CARDS  --}}

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
