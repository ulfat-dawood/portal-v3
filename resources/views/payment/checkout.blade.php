@extends('layout.master')
@section('title', __('Doctors'))

@section('content')

    <div class="container xl:px-[12vw]">

        <x-master.breadcrumbs path="doctors" current="Check out" />
        <div class="container mb-10">
            <div class="flex items-start gap-10 flex-col lg:flex-row">

                <!-- start section  -->
                <div class="basis-full w-full flex-grow flex flex-col gap-5 flex-shrink-0 min-h-0 min-w-0 lg:basis-4/4 lg:w-4/4 lg:flex-grow-0 ">
                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Appointment details')</h3>

                        <div class="flex gap-4  flex-col lg:flex-row">

                            <iframe src="{{ $url }}" frameborder="0" class="" width="100%" height="700px"  ></iframe>

                        </div>

                    </div>
                </div>
                <!-- end section  -->

            </div>
        </div>

    </div>

@endsection
