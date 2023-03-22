<div>
<div class=" grid gap-y-10 me-1 justify-start grid-cols-1 md:grid-cols-2">
@if($medicalReports)
    @forelse ($medicalReports as $report)
        <!-- MEDICAL-REPORT CARD  -->
        <div>
            <div class="w-11/12 h-full mx-auto bg-grey-bg2 p-3 rounded-lg flex flex-col gap-3">

                <!-- report info  -->
                <div class="text-end text-xs font-normal text-grey-border3">
                    {{ explode('T', $report['medicalReportCreated'])[0] }}
                </div>

                <!-- doc info  -->
                <div class="flex-grow flex gap-2  bg-white p-2 rounded-lg">
                    <i class="icofont-stethoscope text-sm mt-0.5"></i>
                    <div>
                        <div class="font-normal text-sm">
                            @lang('Dr.')
                            @if (session('locale') == 'ar')
                                {{ $report['doctorName1b'] .
                                    ' ' .
                                    $report['doctorName2b'] .
                                    ' ' .
                                    $report['doctorName3b'] .
                                    ' ' .
                                    $report['doctorNameFamilyb'] }}
                            @else
                                {{ $report['doctorName1'] .
                                    ' ' .
                                    $report['doctorName2'] .
                                    ' ' .
                                    $report['doctorName3'] .
                                    ' ' .
                                    $report['doctorNameFamily'] }}
                            @endif
                        </div>
                        <div class="text-grey-border3 text-xs ">
                            @if (session('locale') == 'ar')
                                {{ $report['centerNameB'] }}
                            @else
                                {{ $report['centerName'] }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- download btn  -->
                <div wire:click='downloadPdf({{ $report['medicalReportId'] }})'
                    class="border border-white border-4 rounded-lg bg-main-200 px-3 py-1 text-main-600 text-xs font-normal w-full text-center hover:bg-main-300 cursor-pointer">
                    <i class="text-main-600 icofont-download"></i>
                    @lang('Download report')
                </div>

            </div>
        </div>

    @empty
        @lang('No data to show')
    @endforelse
@endif


</div>
<p class="text-center"> {{$msg}}</p>
</div>
