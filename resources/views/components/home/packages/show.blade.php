@extends('layout.master')
@section('title', __('Packages'))

@section('content')

    <div class="container xl:px-[9vw]">

        <x-master.breadcrumbs path="{{ __('Packages') }}" current="{{ $packages['PKG_ID'] }}" />
        <div class="container">
            <div class="flex items-start gap-10 flex-col lg:flex-row">
                <div class="flex-grow flex flex-col gap-5 min-h-0 min-w-0 lg:basis-3/5 lg:w-3/5 lg:flex-grow-0 ">
                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Package details')</h3>

                        <div class="flex gap-4 flex-col md:flex-row">

                            <div class="flex-grow flex gap-2 rounded-lg bg-grey-bg2 p-2">
                                <div class="flex-none bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                    <figure class="absolute left-0 right-0 top-0 bottom-0">
                                        <img src="{{ $packages['PKG_PHOTO'] }}" alt=""
                                            class="w-full h-full object-cover">
                                    </figure>
                                </div>

                                <div class="space-y-2 flex-grow">
                                    <div class="text-sm ps-2">
                                        {{ $packages['PKG_NAME'] }}
                                    </div>
                                    <div class="bg-white rounded-md p-2 text-sm w-full flex-wrap">
                                        <i class="text-sm">{{ $packages['PKG_DESC'] }}</i>
                                    </div>
                                </div>
                            </div>

                            {{-- appointment info  --}}
                            <div class="flex-none bg-grey-bg2 p-1 rounded-lg">
                                <div class="flex gap-2 h-full">
                                    <div class="flex-none bg-white rounded-md text-xs text-center">
                                        <div class="text-xs p-2 px-2">@lang('Package Price')</div>
                                        <i class="icofont-bill-alt"></i>
                                        @if ($packages['PKG_PRICE'] != $packages['PKG_PRICE'])
                                            <div class="text-grey-border3 text-sm line-through">
                                                {{ $packages['PKG_PRICE'] }}
                                            </div>
                                            <div class="text-sm">
                                                {{ $packages['PKG_PRICE'] }}
                                            </div>
                                        @else
                                            <div class="text-xs">
                                                {{ $packages['PKG_PRICE'] }}
                                            </div>
                                        @endif
                                        <label>@lang('SR')</label>
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
                                    {{ $packages['HOSPITAL_NAME'] }}
                                </div>
                                <div class="text-xs ps-2">
                                    <i class="icofont-location-pin text-xs"></i>
                                    {{-- {{ $packages['ADDRESS'] }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end section  -->
                <div class="basis-2/5 flex-grow flex-shrink-0 lg:flex-grow-0 ">

                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Package confirmation')</h3>

                        <p class="my-4 text-sm text-grey-text1">
                            @lang('Please confirm your package reservation and payment method')
                        </p>

                        <form action="{{ route('home', ['locale' => session('locale')]) }}" method="post"
                            class="space-y-2">
                            @csrf

                            <input type="hidden" name="ApptSotId">
                            <div class="btn-primary bg-grey-border1 hover:bg-grey-border1 text-grey-text1">@lang('Pay now')
                                <span class="text-xs text-inherit ps-2"> @lang('currently unavailable')</span>
                            </div>

                            <button class="btn-primary w-full">@lang('Pay on arriaval') <span class="text-xs text-inherit ps-2">
                                    {{ $packages['PKG_PRICE'] }} @lang('SR')</span> </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection
