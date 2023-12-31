@inject('carbon', 'Carbon\Carbon')
<!-- CARD  -->
<div class="box flex flex-col rounded-none sm:rounded-lg sm:flex-row">
    <!-- doctor img  -->
    <div class="hidden overflow-hidden basis-3/12 relative rounded-lg sm:rounded-te-none sm:rounded-be-none sm:block">
        <figure class="absolute w-full h-full">
            <a
                href={{ route('doctor', [
                    'doctorName' => "$doctor[DOCTOR_NAME_1]-$doctor[DOCTOR_NAME_FAMILY]",
                    'doctorId' => $doctor['DOCTOR_ID'],
                    'centerId' => $doctor['CENTER_ID'],
                    'clinicId' => $doctor['CLINIC_ID'],
                    'appt_type_in' => $apptType,
                    'locale' => session('locale'),
                ]) }}>
                @if (file_exists(public_path('storage/doctors_images/' . $doctor['EMP_PHOTO'])))
                    <img class="bg-main-50 object-cover w-full h-full"
                        src="{{ asset('storage/doctors_images/' . $doctor['EMP_PHOTO']) }}" alt="">
                @else
                    <img class="border border-grey-border1 border-0 border-e-2  object-cover w-full h-full"
                        src="{{ asset('assets/images/dr-' . $doctor['SEX'] . '-no_bg.png') }}" alt="">
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
                    'doctorName' => "$doctor[DOCTOR_NAME_1]-$doctor[DOCTOR_NAME_FAMILY]",
                    'doctorId' => $doctor['DOCTOR_ID'],
                    'centerId' => $doctor['CENTER_ID'],
                    'clinicId' => $doctor['CLINIC_ID'],
                    'appt_type_in' => $apptType,
                    'locale' => session('locale'),
                ]) }}>
                <div class="flex flex-col justify-between p-3 hover:bg-grey-bg1 md:flex-row">
                    <!-- start  -->
                    <div class="flex flex-col gap-5">

                        <!-- Doctor info  -->
                        <div class="flex gap-2">

                            <!-- Doctor img for mobile screens only -->
                            <figure class="h-14 w-14 rounded-lg overflow-hidden sm:hidden">
                                @if (file_exists(public_path('storage/doctors_images/' . $doctor['EMP_PHOTO'])))
                                    <img class="bg-main-50 object-cover w-full h-full"
                                        src="{{ asset('storage/doctors_images/' . $doctor['EMP_PHOTO']) }}"
                                        alt="">
                                @else
                                    <img class="bg-main-50  object-cover w-full h-full"
                                        src="{{ asset('assets/images/dr-' . $doctor['SEX'] . '-no_bg.png') }}"
                                        alt="">
                                @endif

                                {{-- <img class="w-full h-full object-cover" src="../img/dr_female.png" alt=""> --}}
                            </figure>

                            <!-- doctor name and specialization -->
                            <div>
                                <div class="font-normal text-sm sm:text-lg ">{{ __('Dr.') }}

                                    {{ $doctor['DOCTOR_NAME_1'] . ' ' . $doctor['DOCTOR_NAME_2'] . ' ' . $doctor['DOCTOR_NAME_3'] . ' ' . $doctor['DOCTOR_NAME_FAMILY'] }}

                                </div>
                                <div class="text-grey-border3 text-sm">
                                    {{ $doctor['CLINIC_NAME'] }}

                                </div>
                            </div>

                        </div>

                        <!-- Appt info  -->
                        <div>

                            <!-- Price  -->
                            <div class="flex gap-1 text-grey-border3 text-sm items-center">

                                <div>
                                    <i class="icofont-bill-alt text-grey-border3 text-sm"></i>
                                </div>
                                <div class="text-sm">
                                    {{ $doctor['EXAM_PRICE'] }}
                                </div>
                                <div>@lang('SR')</div>

                                {{-- @if ($doctor['discount_percent'] != 0)
                                    <div class="text-grey-border3 text-xs line-through">
                                        {{ $doctor['EXAM_PRICE'] }}
                                    </div>
                                    <div class="text-sm">
                                        {{ $doctor['EXAM_PRICE'] - ($doctor['discount_percent'] / 100) * $doctor['EXAM_PRICE'] }}
                                    </div>
                                    <div>@lang('SR')</div>
                                    <div class="text-xs ms-2 font-bold rounded-full bg-secondary-100 text-secondary-400 px-2">
                                        {{ $doctor['discount_percent'] }}%
                                    </div>
                                @else
                                    <div class="text-sm">
                                        {{ $doctor['EXAM_PRICE'] }}
                                    </div>
                                    <div>@lang('SR')</div>
                                @endif --}}

                            </div>

                            <!-- Appt Type -->
                            <div class="flex gap-1 text-grey-border3 text-sm items-center">
                                @if ($apptType == 225)
                                    <!-- home visit -->
                                    <div>
                                        <i class="icofont-home text-grey-border3 text-sm"></i>
                                    </div>
                                    <div class="text-sm">
                                        @lang('Home visit appointment')
                                    </div>
                                @elseif ($apptType == 224)
                                    <!-- Clinic appointment -->
                                    <div>
                                        <i class="icofont-stethoscope text-grey-border3 text-sm"></i>
                                    </div>
                                    <div class="text-sm">
                                        @lang('Clinic appointment')
                                    </div>
                                @endif

                            </div>

                            <!-- Earliest Appt  -->
                            @if (isset($doctor['earliest_appointment']) &&
                                    !is_null($doctor['earliest_appointment']) &&
                                    $doctor['earliest_appointment'] !== '')
                                <div class=" text-sm">
                                    <i class="icofont-clock-time text-grey-border3 text-xs"></i>
                                    @lang('Nearest appointment')
                                    <span class="">
                                            @if (explode(' ' , $doctor['earliest_appointment'])[0] == date('Y-m-d'))
                                                @lang('Today')
                                            @elseif(strtotime(explode(' ' , $doctor['earliest_appointment'])[0]) == strtotime('tomorrow'))
                                                @lang('Tomorrow')
                                            @else
                                                @lang(date('D', strtotime($doctor['earliest_appointment'])))
                                            @endif
                                            {{ $carbon::parse($doctor['earliest_appointment'])->format('d-m-y') }}
                                            @lang('at ')
                                            {{ $carbon::parse($doctor['earliest_appointment'])->format('H:i') }}

                                    </span>

                                </div>
                            @endif
                        </div>

                    </div>
                    <!-- end  -->
                    <div class="flex gap-2 mt-2 md:flex-col md:mt-0">
                        <div
                            class="border  border-main-600 text-main-600 rounded-lg text-center text-xs px-3 py-1 bg-white  hover:bg-main-50 basis-1/2 sm:basis-auto">
                            @lang('Book appointment')
                        </div>
                        {{-- <div
                            class="border border-secondary-300 text-secondary-300 rounded-lg text-center text-xs px-3 py-1 bg-white hover:bg-secondary-100 basis-1/2 sm:basis-auto">
                            @lang('View profile')
                        </div> --}}
                    </div>
                </div>
            </a>
        </div>
        <!-- clinic info  -->
        <div>
            <a href="{{ route('home', ['locale' => session('locale'), 'CenterId' => $doctor['CENTER_ID']]) }}">
                <div class="flex justify-between p-3 hover:bg-grey-bg1">
                    <!-- start  -->
                    <div>
                        <div class="text-grey-border3 text-sm font-normal ms-3.5">
                            {{ $doctor['CENTER_NAME'] }}

                        </div>
                        <div>
                            <i class="icofont-location-pin text-grey-border3 text-xs"></i><span
                                class="text-grey-border3 text-xs">
                                {{ $doctor['ADDRESS'] }}

                            </span>
                        </div>
                    </div>
                    <!-- end  -->
                    {{-- <div class="basis-1/4 h-14"> --}}
                    <div class=" h-10">
                        @if (file_exists(public_path('storage/Logo/' . $doctor['LOGO'])))
                            <img class="w-full h-full object-contain"
                                src="{{ asset('storage/Logo/' . $doctor['LOGO']) }}" alt="">
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
