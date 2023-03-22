    <section id="doctors" class="w-full mt-28 py-20 bg-white ">
        <div class="container">
            <!-- title  -->
            <h2 class="text-lg text-center mb-14 text-grey-text1">{{ __('Our doctors') }}</h2>

            <!-- Slider -->
            <div class="clinic-swiper-container relative">
                <div class="swiper doctors w-11/12 m-auto">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @forelse ($ranDoctors as $doctor)
                            <div class="swiper-slide p-2 bg-grey-bg2 rounded-lg  flex flex-col">
                                <div class="bg-white rounded-lg p-2">
                                    <div class="bg-main-100  h-32 rounded-lg overflow-hidden relative">
                                        <figure class="absolute left-0 right-0 top-0 bottom-0 ">
                                            @if (file_exists(public_path('storage/doctors_images/' . optional($doctor)['empPhoto'])))
                                                <img class="bg-main-50 object-cover w-full h-full"
                                                    src="{{ asset('storage/doctors_images/' . optional($doctor)['empPhoto']) }}"
                                                    alt="">
                                            @else
                                                <img class="bg-main-50 object-cover w-full h-full"
                                                    src="{{ asset('assets/images/dr-' . optional($doctor)['sex'] . '-no_bg.png') }}"
                                                    alt="">
                                            @endif

                                            {{-- <img class="bg-main-50 object-cover w-full h-full"
                                                src="{{ asset('assets/images/dr-F-no_bg.png') }}" alt=""> --}}

                                        </figure>
                                    </div>
                                    <div class=" pt-2">
                                        <div class="text-sm">
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
                                        <div class="text-xs text-grey-text1">
                                            @if (session('locale') == 'ar')
                                                {{ $doctor['clinicNameB'] }}
                                            @else
                                                {{ $doctor['clinicName'] }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="text-xs text-grey-text1 p-2">
                                        @if (session('locale') == 'ar')
                                            {{ $doctor['hospitalNameB'] }}
                                        @else
                                            {{ $doctor['hospitalName'] }}
                                        @endif
                                    </div>
                                    <a href={{ route('doctor', [
                                        'doctorName' => "$doctor[doctorName1]-$doctor[doctorNameFamily]",
                                        'doctorId' => $doctor['doctorId'],
                                        'centerId' => $doctor['centerId'],
                                        'clinicId' => $doctor['clinicId'],
                                        'locale' => session('locale'),
                                    ]) }}
                                        class="block font-bold  border border-white border-4 text-center bg-main-100 rounded-lg text-main-600 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-main-200">
                                        @lang('Book appointment')
                                    </a>
                                </div>

                            </div>
                        @empty
                        @endforelse


                    </div>
                </div>
                <!-- navigation buttons -->
                <div class="swiper-button-prev doctors !hidden md:!flex"></div>
                <div class="swiper-button-next doctors !hidden md:!flex"></div>
                <!-- pagination -->
                <div class="swiper-pagination doctors"></div>
            </div>
        </div>
    </section>
