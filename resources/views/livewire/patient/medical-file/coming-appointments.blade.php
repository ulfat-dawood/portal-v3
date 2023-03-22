<div class="">
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
        @if($appts)
            @forelse ($appts as $appt)
                <!-- APPT card  -->
                <div class="flex">
                    <!-- time stamp  -->
                    <div
                        class="timestamp flex-shrink-0 self-center rounded-lg bg-grey-bg2 p-1.5 w-24 flex-col items-center relative me-6 hidden md:flex">
                        <div class="text-xs">{{ explode('T', $appt['slotDay'])[0] }}</div>
                        <div class="text-xs"><i class="icofont-clock-time text-xs"></i>
                            {{ explode(':', $appt['slotTime'])[0] . ':' . explode(':', $appt['slotTime'])[1] }}
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
                            <div class="text-xs">{{ explode('T', $appt['slotDay'])[0] }}</div>
                            <div class="text-xs"><i class="icofont-clock-time text-xs"></i>
                                {{ explode(':', $appt['slotTime'])[0] . ':' . explode(':', $appt['slotTime'])[1] }}
                            </div>
                        </div>
                        <!-- doctor details       -->
                        <div class="flex-grow bg-white rounded-lg d p-1 flex gap-2">

                            <div class="bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                <figure class="absolute left-0 right-0 top-0 bottom-0 ">
                                    @if (file_exists(public_path('storage/doctors_images/' . $appt['empPhoto'])))
                                        <img class="bg-main-50 object-cover w-full h-full"
                                            src="{{ asset('storage/doctors_images/' . $appt['empPhoto']) }}" alt="">
                                    @else
                                        <img class="bg-main-50 object-cover w-full h-full"
                                            src="{{ asset('assets/images/dr-' . $appt['sex'] . '-no_bg.png') }}"
                                            alt="">
                                    @endif
                                    {{-- <img src="{{ asset('assets/images/dr-' . $appt['sex'] . '-no_bg.png') }}" alt=""
                                        class="w-full h-full object-cover"> --}}
                                </figure>
                            </div>
                            <div>
                                <div class="font-normal text-sm">
                                    @lang('Dr.')
                                    @if (session('locale') == 'ar')
                                        {{ $appt['doctorName1b'] .
                                            ' ' .
                                            $appt['doctorName2b'] .
                                            ' ' .
                                            $appt['doctorName3b'] .
                                            ' ' .
                                            $appt['doctorNameFamilyb'] }}
                                    @else
                                        {{ $appt['doctorName1'] .
                                            ' ' .
                                            $appt['doctorName2'] .
                                            ' ' .
                                            $appt['doctorName3'] .
                                            ' ' .
                                            $appt['doctorNameFamily'] }}
                                    @endif

                                </div>
                                <div class="text-xs text-grey-border3">
                                    @if (session('locale') == 'ar')
                                        {{ $appt['clinicNameB'] }}
                                    @else
                                        {{ $appt['clinicName'] }}
                                    @endif
                                </div>
                                <div class="text-xs text-grey-border3">
                                    @if (session('locale') == 'ar')
                                        {{ $appt['centerNameB'] }}
                                    @else
                                        {{ $appt['centerName'] }}
                                    @endif
                                </div>
                                <div class="text-xs text-grey-border3 flex gap-1">
                                    @if ($appt['discountPercent'] == 0)
                                        <div>{{ $appt['examPrice'] }}</div>
                                    @else
                                        <span
                                            class="text-xs line-through text-grey-border3">{{ $appt['examPrice'] }}</span>
                                        <div>{{ ($appt['examPrice'] / 100) * $appt['discountPercent'] }}</div>
                                    @endif
                                    <div>@lang('SR')</div>
                                </div>
                            </div>
                        </div>
                        <!-- appt details  -->
                        <div class="flex flex-row gap-2  py-1 md:flex-col md:py-0 justify-start">
                            <div wire:click="cancel({{ $appt['clinApptSlotId'] }})""
                                class="border border-white  border-4 text-center bg-secondary-100 rounded-lg text-secondary-400 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-secondary-200">
                                <i class="icofont-ui-remove text-secondary-400 text-xs"></i>
                                @lang('Cancel')
                            </div>

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
