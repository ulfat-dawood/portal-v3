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
                            <svg viewBox="0 0 24 24" style="border-radius:200px; height:150px; width:150px; margin:0 auto;">
                                <path fill="#4e9996" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                                </path>
                            </svg>

                            <div class="text-center">
                                <h1 class="font-bold text-xl my-7">@lang('The action ran successfully!')</h1>
                                <p class="text-gray-400 mt-4 mb-14">{{ Session::get('success') }}</p>
                                <a href="{{ route('home') }}" class="px-12 py-3 rounded-md bg-main-500 text-white">@lang('Home page')
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
