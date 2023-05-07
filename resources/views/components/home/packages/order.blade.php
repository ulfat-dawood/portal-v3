@extends('layout.master')
@section('title', __('Order package'))

@section('content')

    <div class="container xl:px-[9vw]">

        <x-master.breadcrumbs path="{{ __('Order package') }}" current="{{ $package['PKG_ID'] }}" />
        <div class="container">
            <div class="flex items-start gap-10 flex-col lg:flex-row">
                <div class="flex-grow flex flex-col gap-5 min-h-0 min-w-0 lg:basis-3/4 lg:w-3/4 lg:flex-grow-0 ">
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
                                    <div class="text-sm ps-2">
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
                                        <img class=" object-cover"
                                            src="#" alt="">
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
                </div>
                <!-- end section  -->
                <div class="basis-1/4 flex-grow flex-shrink-0 lg:flex-grow-0 ">

                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Confirm Payment')</h3>

                        <p class="my-4 text-sm text-grey-text1">
                            @lang('Continue to payment by clicking below')
                        </p>

                        <form method="POST"
                        action="{{ route('package.checkout', ['locale' => session('locale')]) }}" class="space-y-2">
                            @csrf
                            <input type="hidden" value="{{ $package['PKG_ID']  }}" name="package_id">
                            <input type="hidden" value="1" name="quantity">


                            <button type="submit" class="btn-primary w-full">
                                @lang('Pay now')
                                <span class="text-xs text-inherit ps-2">
                                    {{ $package['SRVC_PRICE']  }} @lang('SR')
                                    <span class="line-through">{{ $package['PKG_PRICE']  }}</span>
                                </span>
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection
