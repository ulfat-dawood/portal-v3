@extends('layout.master')
@section('title', __('Payment Information'))

@section('content')

    <div class="container xl:px-[12vw] my-20">

        <div class="flex items-start gap-10 flex-col lg:flex-row">

            <!-- start section  -->
            <div class="basis-full w-full flex-grow flex flex-col gap-5 flex-shrink-0 min-h-0 min-w-0 lg:basis-4/4 lg:w-4/4 lg:flex-grow-0 ">
                <div class="box p-4 space-y-2">

                    <div class="card">
                        <div class="bg-white p-6 my-10 md:mx-auto">
                            <svg viewBox="0 0 528 528" style="border-radius:200px; height:200px; width:200px; margin:0 auto;">
                                <path fill="#c73131"
                                    d="M264 456Q210 456 164 429 118 402 91 356 64 310 64 256 64 202 91 156 118 110 164 83 210 56 264 56 318 56 364 83 410 110 437 156 464 202 464 256 464 310 437 356 410 402 364 429 318 456 264 456ZM264 288L328 352 360 320 296 256 360 192 328 160 264 224 200 160 168 192 232 256 168 320 200 352 264 288Z">
                                </path>
                            </svg>

                            <div class="text-center">
                                <h1 class="font-bold text-xl my-7">@lang('There was a problem executing the action.')!</h1>
                                <p class="text-gray-400 mt-4 mb-14">{{ Session::get('error') }}</p>
                                <p class="text-gray-400 mt-4 mb-14">{{ Session::get('warning') }}</p>

                                <a href="javascript:javascript:history.back()" class="button rounded-md px-12 py-3 bg-main-500 text-white">@lang('Go back')
                                </a>
                                <a href="{{ route('home') }}" class="button rounded-md px-12 py-3 mx-4 bg-main-500 text-white">@lang('Home page')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end section  -->
        </div>
    </div>
@endsection
