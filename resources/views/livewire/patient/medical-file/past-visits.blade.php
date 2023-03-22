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
            <div class="line hidden md:block">

            </div>

            <!-- appt info  -->
            <div
                class="flex bg-grey-bg2 rounded-lg cursor-pointer p-2 gap-2 my-3 ms-0 me-0 md:ms-3 hover:bg-grey-border1">

                <div class="text-xs font-normal px-4">
                    <i class="icofont-ui-add text-xs me-2  md:hidden"></i>
                    @lang('Add a new appointment')
                </div>

            </div>

        </div>
        @if ($appts)

            @forelse ($appts as $appt)
                <!-- APPT CARD  -->
                <div class="flex">

                    <!-- time stamp  -->
                    <div
                        class="timestamp flex-shrink-0 self-center rounded-lg bg-grey-bg2 p-1.5 w-24 flex-col items-center relative me-6 hidden md:flex">
                        <div class="text-xs">{{ explode('T', $appt['slotDay'])[0] }}</div>
                        <div class="text-xs"><i class="icofont-clock-time text-xs"></i> 09:00</div>
                    </div>

                    <!-- line  -->
                    <div class="line hidden md:block">

                    </div>

                    <!-- appt info  -->
                    <div
                        class="flex flex-grow bg-grey-bg2 rounded-lg p-2 gap-2 flex-col my-3 ms-0 me-0 md:ms-3 md:flex-row">

                        <!-- timestamp for mobile  -->
                        <div
                            class="timestamp self-start rounded-lg bg-grey-bg2 p-1 flex gap-3 items-center relative me-6 md:hidden">
                            <div class="text-xs">{{ explode('T', $appt['slotDay'])[0] }}</div>
                            <div class="text-xs"><i class="icofont-clock-time text-xs"></i> 09:00</div>
                        </div>


                        <!-- doctor details       -->
                        <div class="flex-grow bg-white rounded-lg d p-1 flex gap-2">

                            <div class="bg-main-100 w-14 rounded-lg overflow-hidden relative">
                                <figure class="absolute left-0 right-0 top-0 bottom-0 ">
                                    @if (file_exists(public_path('storage/doctors_images/' . $appt['empPhoto'])))
                                        <img class="bg-main-50 object-cover w-full h-full"
                                            src="{{ asset('storage/doctors_images/' . $appt['empPhoto']) }}"
                                            alt="">
                                    @else
                                        <img class="bg-main-50 object-cover w-full h-full"
                                            src="{{ asset('assets/images/dr-' . $appt['sex'] . '-no_bg.png') }}"
                                            alt="">
                                    @endif
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

                        <!-- visit requests (start)  -->
                        @if (isset($appt['srvcMasterId']) &&
                            !is_null($appt['srvcMasterId']) &&
                            isset($appt['diagMasterId']) &&
                            !is_null($appt['diagMasterId']))
                            <div class="flex flex-row gap-2  py-1 md:flex-col md:py-0 justify-start">
                                <form action="{{ route('visit-request', ['locale' => session('locale')]) }}"
                                    method="post">
                                    @csrf 
                                    <input type="hidden" name="SrvcMasterId" value="{{ $appt['srvcMasterId'] }}">
                                    <input type="hidden" name="RequestType" value="sickleave">
                                    <input type="hidden" name="RequestTypeId" value="2">
                                    <input type="hidden" name="centerId" value="{{ $appt['centerId'] }}">
                                    <button type="submit"
                                        class="w-full border border-white  border-4 text-center bg-main-100 rounded-lg text-main-600 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-main-200">
                                        {{-- <i class="icofont-thermometer text-main-600"></i> --}}
                                        @lang('Request sick leave')
                                    </button>
                                </form>

                                <form action="{{ route('visit-request' , [ 'locale' => session('locale')]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="SrvcMasterId" value="{{ $appt['srvcMasterId'] }}">
                                    <input type="hidden" name="RequestType" value="other">
                                    <input type="hidden" name="RequestTypeId" value="3">
                                    <input type="hidden" name="centerId" value="{{ $appt['centerId'] }}">
                                    <button type="submit"
                                        class="w-full border border-white  border-4 text-center bg-main-100 rounded-lg text-main-600 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-main-200">
                                        {{-- <i class="icofont-medical-sign-alt text-main-600"></i> --}}
                                        @lang('Request Medical report')
                                    </button>
                                </form>
                                {{-- <div
                                    class="border border-white  border-4 text-center bg-main-100 rounded-lg text-main-600 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-main-200">
                                    @lang('Request sick leave')
                                </div> --}}

                                {{-- <div
                                    class="border border-white  border-4 text-center bg-main-100 rounded-lg text-main-600 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-main-200">
                                    @lang('Request Medical report')
                                </div> --}}

                            </div>
                        @endif
                        <!-- visit requests (end)  -->

                    </div>

                </div>
            @empty
            @endforelse
        @endif

        <p class="text-center"> {{ $msg }}</p>



    </div>
</div>
