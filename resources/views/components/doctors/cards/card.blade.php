@inject('carbon', 'Carbon\Carbon')
<!-- CARD  -->
<div class="box flex flex-col rounded-none sm:rounded-lg sm:flex-row">
    <!-- doctor img  -->
    <div class="hidden overflow-hidden basis-3/12 relative rounded-lg sm:rounded-te-none sm:rounded-be-none sm:block">
        <figure class="absolute w-full h-full">
            <a
                href={{ route('doctor', [
                    'doctorName' => "$doctor[doctorName1]-$doctor[doctorNameFamily]",
                    'doctorId' => $doctor['doctorId'],
                    'centerId' => $doctor['centerId'],
                    'clinicId' => $doctor['clinicId'],
                    'locale' => session('locale'),
                ]) }}>
                @if (file_exists(public_path('storage/doctors_images/' . $doctor['empPhoto'])))
                    <img class="bg-main-50 object-cover w-full h-full"
                        src="{{ asset('storage/doctors_images/' . $doctor['empPhoto']) }}" alt="">
                @else
                    <img class="border border-grey-border1 border-0 border-e-2  object-cover w-full h-full"
                        src="{{ asset('assets/images/dr-' . $doctor['sex'] . '-no_bg.png') }}" alt="">
                @endif
            </a>
        </figure>
    </div>
    <!-- card information -->
    <div class="flex-grow divide-y divide-grey-border1">
        <!-- doctor info  -->
        {{-- @dump($doctor) --}}
        <div class="">
            <a class=""
                href={{ route('doctor', [
                    'doctorName' => "$doctor[doctorName1]-$doctor[doctorNameFamily]",
                    'doctorId' => $doctor['doctorId'],
                    'centerId' => $doctor['centerId'],
                    'clinicId' => $doctor['clinicId'],
                    'locale' => session('locale'),
                ]) }}>
                <div class="flex flex-col justify-between p-3 hover:bg-grey-bg1 md:flex-row">
                    <!-- start  -->
                    <div class="flex flex-col gap-5">
                        <div class="flex gap-2">
                            <figure class="h-14 w-14 rounded-lg overflow-hidden sm:hidden">
                                @if (file_exists(public_path('storage/doctors_images/' . $doctor['empPhoto'])))
                                    <img class="bg-main-50 object-cover w-full h-full"
                                        src="{{ asset('storage/doctors_images/' . $doctor['empPhoto']) }}"
                                        alt="">
                                @else
                                    <img class="bg-main-50  object-cover w-full h-full"
                                        src="{{ asset('assets/images/dr-' . $doctor['sex'] . '-no_bg.png') }}"
                                        alt="">
                                @endif

                                {{-- <img class="w-full h-full object-cover" src="../img/dr_female.png" alt=""> --}}
                            </figure>
                            <div>
                                <div class="font-normal text-sm sm:text-lg ">{{ __('Dr.') }}
                                    @if (session('locale') == 'ar')
                                        {{ $doctor['doctorName1b'] .
                                            ' ' .
                                            $doctor['doctorName2b'] .
                                            ' ' .
                                            $doctor['doctorName3b'] .
                                            ' ' .
                                            $doctor['doctorNameFamilyb'] }}
                                    @else
                                        {{ $doctor['doctorName1'] .
                                            ' ' .
                                            $doctor['doctorName2'] .
                                            ' ' .
                                            $doctor['doctorName3'] .
                                            ' ' .
                                            $doctor['doctorNameFamily'] }}
                                    @endif
                                </div>
                                <div class="text-grey-border3 text-sm">
                                    @if (session('locale') == 'ar')
                                        {{ $doctor['clinicNameB'] }}
                                    @else
                                        {{ $doctor['clinicName'] }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex gap-1 text-grey-border3 text-sm items-center">
                                <div>
                                    <i class="icofont-bill-alt text-grey-border3 text-sm"></i>
                                </div>
                                @if ($doctor['discountPercent'] != 0)
                                    <div class="text-grey-border3 text-xs line-through">
                                        {{ $doctor['examPrice'] }}
                                    </div>
                                    <div class="text-sm">
                                        {{ $doctor['examPrice'] - ($doctor['discountPercent'] / 100) * $doctor['examPrice'] }}
                                    </div>
                                    <div>@lang('SR')</div>
                                    <div
                                        class="text-xs ms-2 font-bold rounded-full bg-secondary-100 text-secondary-400 px-2">
                                        {{ $doctor['discountPercent'] }}%
                                    </div>
                                @else
                                    <div class="text-sm">
                                        {{ $doctor['examPrice'] }}
                                    </div>
                                    <div>@lang('SR')</div>
                                @endif

                            </div>

                            @if (isset($doctor['earliestAppointment']) &&
                                !is_null($doctor['earliestAppointment']) &&
                                $doctor['earliestAppointment'] !== '')
                                <div class="text-grey-border3 text-sm mt-3">
                                    <i class="icofont-clock-time text-grey-border3 text-xs"></i>
                                    @lang('Nearest appointment')
                                    <span
                                        class="text-grey-border3 text-xs rounded-full bg-grey-bg2 px-2 font-normal  ms-2 w-fit sm:inline sm:ms-auto">
                                        @if (session('locale') == 'ar')
                                            يوم
                                            {{ $carbon::parse($doctor['earliestAppointment'])->format('d-m-y') }}
                                            الساعة
                                            {{ $carbon::parse($doctor['earliestAppointment'])->format('H:i') }}
                                        @else
                                            on
                                            {{ $carbon::parse($doctor['earliestAppointment'])->format('d-m-y') }}
                                            at
                                            {{ $carbon::parse($doctor['earliestAppointment'])->format('H:i') }}
                                        @endif
                                    </span>
                                    {{-- @lang('Nearest appoitnemt on')
                                    <span
                                        class="text-grey-border3 text-xs rounded-full bg-grey-bg2 px-2 font-normal block ms-4 w-fit sm:inline sm:ms-auto">
                                        {{ $carbon::parse($doctor['earliestAppointment'])->format('H:i a') }}
                                    </span>
                                    &nbsp; @lang('at') &nbsp;
                                    <span
                                        class="text-grey-border3 text-xs rounded-full bg-grey-bg2 px-2 font-normal block ms-4 w-fit sm:inline sm:ms-auto">
                                        {{ explode('T', $doctor['earliestAppointment'])[1] }}
                                    </span> --}}
                                </div>
                            @endif
                        </div>

                    </div>
                    <!-- end  -->
                    <div class="flex gap-2 mt-2 md:flex-col md:mt-0">
                        <div
                            class="border  border-main-600 text-main-600 rounded-lg text-center text-xs px-3 py-1 bg-white  hover:bg-main-50 basis-1/2 sm:basis-auto">
                            @lang('View profile')
                        </div>
                        <div
                            class="border border-secondary-300 text-secondary-300 rounded-lg text-center text-xs px-3 py-1 bg-white hover:bg-secondary-100 basis-1/2 sm:basis-auto">
                            @lang('Book appointment')
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- clinic info  -->
        <div>
            <a href="{{ route('home', ['locale' => session('locale'), 'CenterId' => $doctor['centerId']]) }}">
                <div class="flex justify-between p-3 hover:bg-grey-bg1">
                    <!-- start  -->
                    <div>
                        <div class="text-grey-border3 text-sm font-normal">
                            @if (session('locale') == 'ar')
                                {{ $doctor['hospitalNameB'] }}
                            @else
                                {{ $doctor['hospitalName'] }}
                            @endif
                        </div>
                        <div>
                            <i class="icofont-location-pin text-grey-border3 text-xs"></i><span
                                class="text-grey-border3 text-xs">
                                @if (session('locale') == 'ar')
                                    {{ $doctor['addressB'] }}
                                @else
                                    {{ $doctor['address'] }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end  -->
                    {{-- <div class="basis-1/4 h-14"> --}}
                    <div class=" h-10">
                        @if (file_exists(public_path('storage/Logo/' . $doctor['logo'])))
                            <img class="w-full h-full object-contain"
                                src="{{ asset('storage/Logo/' . $doctor['logo']) }}" alt="">
                        @else
                            <img class="w-full h-full object-contain" src="{{ asset('assets/images/athir_logo.png') }}"
                                alt="">
                        @endif

                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
