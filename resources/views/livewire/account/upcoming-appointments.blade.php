<div class="">
    @include('layout.flash-messages')

    <!-- Coming appointments  -->
    <div class="timeline flex flex-col me-1">
        <!-- ADD NEW APPT  -->
        <div class="flex justify-center md:justify-start">
            <!-- time stamp  -->
            <div
                class="timestamp flex-shrink-0 add-btn self-center justify-self-center w-24 justify-end relative me-6 hidden md:flex group">
                <div class=" rounded-lg p-2.5 bg-grey-bg2 cursor-pointer group-hover:bg-grey-border1"><i
                        class="icofont-ui-add text-sm"></i></div>
            </div>
            <!-- line  -->
            <div class="line hidden md:block"></div>
            <!-- appt info  -->
            <div
                class="flex bg-grey-bg2 rounded-lg cursor-pointer p-2 gap-2 my-3 ms-0 me-0 md:ms-3 hover:bg-grey-border1">
                <div class="text-xs font-normal ">
                    <a href="{{ route('home', ['locale' => session('locale')]) }}" class="block px-4">
                        <i class="icofont-ui-add text-xs me-2  md:hidden"></i>
                        @lang('Add a new appointment')
                    </a>
                </div>
            </div>
        </div>
        @if ($appointments)
            @forelse ($appointments as $appt)
                <!-- APPT card  -->
                <div class="flex">
                    <!-- time stamp  -->
                    <div
                        class="timestamp flex-shrink-0 self-center rounded-lg bg-grey-bg2 p-1.5 w-24 flex-col items-center relative me-6 hidden md:flex">
                        <div class="text-xs">{{ date('d/m/y', strtotime($appt['APPT_DATE'])) }}</div>
                        <div class="text-xs flex gap-1">
                            <div><i class="icofont-clock-time text-xs"></i></div>
                            <div>{{ date('g:i', strtotime($appt['APPT_DATE'])) }}</div>
                            <div>@lang(date('a', strtotime($appt['APPT_DATE'])))</div>
                        </div>
                    </div>
                    <!-- line  -->
                    <div class="line hidden md:block"></div>

                    <!-- appt info  -->
                    <div
                        class="flex flex-grow bg-grey-bg2 rounded-lg p-2 gap-2 flex-col my-3 ms-0 me-0 md:ms-3 md:flex-row">

                        <!-- timestamp for mobile  -->
                        <div
                            class="timestamp self-start rounded-lg bg-grey-bg2 p-1 flex gap-3 items-center relative me-6 md:hidden">
                            <div class="text-xs">{{ explode('T', $appt['APPT_DATE'])[0] }}</div>
                            <div class="text-xs"><i class="icofont-clock-time text-xs"></i>
                                {{ explode(':', $appt['APPT_DATE'])[0] . ':' . explode(':', $appt['APPT_DATE'])[1] }}
                            </div>
                        </div>
                        <!-- doctor details -->
                        <div class="flex-grow bg-white rounded-lg d p-1 flex gap-2">

                            <div class="bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                <figure class="absolute left-0 right-0 top-0 bottom-0 ">
                                    @if (file_exists(public_path('storage/doctors_images/' . $appt['APPT_DATE'])))
                                        <img class="bg-main-50 object-cover w-full h-full"
                                            src="{{ asset('storage/doctors_images/' . $appt['APPT_DATE']) }}"
                                            alt="">
                                    @else
                                        <img class="bg-main-50 object-cover w-full h-full"
                                            src="{{ asset('assets/images/dr-' . 'M' . '-no_bg.png') }}" alt="">
                                    @endif
                                    {{-- <img src="{{ asset('assets/images/dr-' . $appt['sex'] . '-no_bg.png') }}" alt=""
                                        class="w-full h-full object-cover"> --}}
                                </figure>
                            </div>
                            <div>
                                <div class="font-normal text-sm">
                                    @lang('Dr.') {{ $appt['Doctor_Name'] }}


                                </div>
                                <div class="text-xs text-grey-border3">
                                    {{ $appt['Center_Name'] }}
                                </div>
                                <div class="text-xs text-grey-border3">
                                    @lang('appointment for') {{ $appt['Patient_Name'] }}
                                </div>
                                @if ($appt['is_paid'])
                                    <div class="text-xs text-main-600">
                                        @lang('Paid')
                                    </div>
                                @else
                                    <div class="text-xs text-secondary-400">
                                        @lang('Not paid')
                                    </div>
                                @endif

                            </div>
                        </div>
                        <!-- appt details  -->
                        <div class="flex flex-row gap-2  py-1 md:flex-col md:py-0 justify-start">

                            <div wire:click="cancel({{ $appt['CLIN_APPT_SLOT_ID'] }})"
                                class="border border-white  border-4 text-center bg-secondary-100 rounded-lg text-secondary-400 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-secondary-200">
                                <i class="icofont-ui-remove text-secondary-400 text-xs"></i>
                                @lang('Cancel')
                            </div>

                            <a target="_blank"
                                href="https://www.google.com/maps/dir/Current+Location/{{ $appt['CENTER_LATITUDE'] }},{{ $appt['CENTER_LONGITUDE'] }}"
                                class=" block border border-white  border-4 text-center bg-main-100 rounded-lg text-main-600 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-main-200">
                                <i class="icofont-location-arrow text-main-600 text-xs"></i>
                                @lang('Directions')
                            </a>

                        </div>
                    </div>

                </div>
            @empty
                {{-- No Coming Appointments --}}
                <div class="flex justify-center md:justify-start">

                    <!-- time stamp  -->
                    <div
                        class="timestamp flex-shrink-0 add-btn self-center justify-self-center w-24 justify-end relative me-6 hidden md:flex group">
                        <div class=" rounded-lg p-2.5 bg-grey-bg2 cursor-pointer group-hover:bg-grey-border1"><i
                                class="icofont-ui-add text-sm"></i></div>
                    </div>

                    <!-- line  -->
                    <div class="line hidden md:block">

                    </div>

                    <!-- appt info  -->
                    <div
                        class="flex bg-grey-bg2 rounded-lg cursor-pointer p-2 gap-2 my-3 ms-0 me-0 md:ms-3 hover:bg-grey-border1">

                        <div class="text-sm font-normal py-2 px-4">
                            @lang('No upcoming appointments')
                        </div>

                    </div>

                </div>
            @endforelse
        @endif

        <p class="text-center ">{{ $msg }}</p>
    </div>


</div>
