<div>
    <!-- Sick Leaves  -->
    <div class=" grid  gap-y-10 me-1 justify-start grid-cols-1 md:grid-cols-2">
        @if ($sickLeaves)
            @forelse ($sickLeaves as $sickLeave)
                <!-- CARD -->
                <div>
                    <div class="w-11/12 h-full mx-auto bg-grey-bg2 p-3 rounded-lg flex flex-col gap-3">

                        <!-- report info  -->
                        <div class="bg-white rounded-lg flex justify-between overflow-hidden p-1">
                            <div class="p-2 icon\ flex flex-grow justify-center items-center">
                                <span class="text-sm">@lang('Duration days') ({{ $sickLeave['sickLeaveDays'] }})</span>
                            </div>
                            <div class="starting-date ms-6 p-2 bg-grey-border1 text-center rounded-te-lg rounded-be-lg">
                                <div class="text-xs ">@lang('starting date')</div>
                                <div class="text-xs font-normal ">
                                    {{ explode('T', $sickLeave['sickLeaveStartFromDate'])[0] }}
                                </div>
                            </div>
                        </div>

                        <!-- doc info  -->
                        <div class="flex-grow flex gap-2  bg-white p-2 rounded-lg">
                            <i class="icofont-stethoscope text-sm mt-0.5"></i>
                            <div>
                                <div class="font-normal text-sm">
                                    @lang('Dr.')
                                    @if (session('locale') == 'ar')
                                        {{ $sickLeave['doctorName1b'] .
                                            ' ' .
                                            $sickLeave['doctorName2b'] .
                                            ' ' .
                                            $sickLeave['doctorName3b'] .
                                            ' ' .
                                            $sickLeave['doctorNameFamilyb'] }}
                                    @else
                                        {{ $sickLeave['doctorName1'] .
                                            ' ' .
                                            $sickLeave['doctorName2'] .
                                            ' ' .
                                            $sickLeave['doctorName3'] .
                                            ' ' .
                                            $sickLeave['doctorNameFamily'] }}
                                    @endif

                                </div>
                                <div class="text-grey-border3 text-xs ">
                                    @if (session('locale') == 'ar')
                                        {{ $sickLeave['centerNameB'] }}
                                    @else
                                        {{ $sickLeave['centerName'] }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- download btn  -->
                        <div wire:click='downloadPdf({{ $sickLeave['sickLeaveId'] }})'
                            class="border border-white border-4 rounded-lg bg-main-200 px-3 py-1 text-main-600 text-xs font-normal w-full text-center hover:bg-main-300 cursor-pointer">
                            <i class="icofont-download text-main-600 text-xs"></i>
                            @lang('Download report')
                        </div>

                    </div>
                </div>
            @empty
                @lang('No data to show')
            @endforelse
        @endif


    </div>
    <p class="text-center"> {{ $msg }}</p>
</div>
