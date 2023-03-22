<div class="flex flex-col gap-y-10 me-1 justify-center ">
    @if ($labs)
        @forelse ($labs as $key => $lab)
            <!-- CARD #1  -->
            <div wire:key="lb-{{ $lab['labOrderBaseId'] }}"
                class="w-full max-w-11/12 mx-auto bg-grey-bg2 p-3 rounded-lg flex flex-col gap-3">



                <!-- doc info  -->
                <div class="flex-grow flex gap-2  bg-white p-2 rounded-lg">
                    <i class="icofont-stethoscope text-sm mt-0.5"></i>
                    <div>
                        <div class="font-normal text-sm">
                            @lang('Dr.')
                            @if (session('locale') == 'ar')
                                {{ $lab['doctorName1b'] .
                                    ' ' .
                                    $lab['doctorName2b'] .
                                    ' ' .
                                    $lab['doctorName3b'] .
                                    ' ' .
                                    $lab['doctorNameFamilyb'] }}
                            @else
                                {{ $lab['doctorName1'] . ' ' . $lab['doctorName2'] . ' ' . $lab['doctorName3'] . ' ' . $lab['doctorNameFamily'] }}
                            @endif
                        </div>
                        <div class="text-grey-border3 text-xs ">
                            @if (session('locale') == 'ar')
                                {{ $lab['centerNameB'] }}
                            @else
                                {{ $lab['centerName'] }}
                            @endif
                        </div>
                    </div>
                </div>


                <!-- PRESCRIPTIONS  -->
                <div id="prescriptions-{{ $key }}" class="transition-all h-auto overflow-x-auto ">

                    @if ($lab['isOpen'])
                        <div class="flex flex-col gap-0.5 min-w-[450px]">

                            <!-- ROW TITLE -->
                            <div class="bg-white rounded-lg flex gap-5 px-5 py-1.5">

                                <!-- name -->
                                <div class="w-4/12 felx-shrink-0 flex-grow-0 text-main-600 text-xs font-medium">
                                    @lang('Service')
                                </div>

                                <!-- dosage  -->
                                <div class="w-2/12 felx-shrink-0 flex-grow-0 text-main-600 text-xs font-medium">
                                    @lang('Result')
                                </div>

                                <!-- instructions  -->
                                <div class="w-6/12 felx-shrink-0 flex-grow-0 text-main-600 text-xs font-medium">
                                    @lang('Quantity')
                                </div>
                            </div>

                            @forelse ($lab['child']  as $item)
                                <div wire:key='item-{{ $item['labOrderBaseId'] }}'
                                    class="bg-white rounded-lg flex gap-5 px-5 py-1.5">

                                    <!-- name -->
                                    <div
                                        class="w-4/12 min-w-0 felx-shrink-0 flex-grow-0  text-xs font-normal break-words">
                                        {{ $item['srvcName'] }}
                                    </div>

                                    <!-- dosage  -->
                                    <div
                                        class="w-2/12 min-w-0 felx-shrink-0 flex-grow-0  text-xs font-normal break-words">
                                        {{ optional($item)['result'] }}
                                    </div>

                                    <!-- instructions  -->
                                    <div
                                        class="w-6/12 min-w-0 felx-shrink-0 flex-grow-0  text-xs font-normal break-words">
                                        {{ $item['qty'] }}
                                    </div>
                                </div>
                            @empty
                                @lang('No lab tests')
                            @endforelse
                            <!-- ROW  -->





                        </div>
                    @endif
                </div>

                <!-- BOTTOM SECTION  -->
                <div class="flex justify-between gap-2 flex-col items-end sm:flex-row sm:items-center">

                    <!-- BUTTONS  -->
                    <div class="w-full flex gap-2 justify-between sm:justify-start">

                        <!-- Show btn  -->
                        <div wire:click="toggleAccordion({{ $lab['hasChild'] }},{{ $lab['labOrderBaseId'] }})"
                            class="expand border border-white border-4 rounded-lg bg-secondary-100 px-3 py-1 text-secondary-300 text-xs font-medium w-fit text-center hover:bg-secondary-200 cursor-pointer">
                            @if ($lab['isOpen'])
                                @lang('Hide lab tests')
                                <i class="text-secondary-300 icofont-rounded-up"></i>
                            @else
                                @lang('Show lab tests')
                                <i class="text-secondary-300 icofont-rounded-right"></i>
                            @endif
                        </div>





                        <!-- download btn  -->
                        <div wire:click="downloadPdf({{ $lab['labOrderBaseId'] }})"
                            class="border border-white border-4 rounded-lg bg-main-200 px-3 py-1 text-main-600 text-xs font-normal w-fit text-center hover:bg-main-300 cursor-pointer">
                            <i class="text-main-600 icofont-download"></i>
                            @lang('Download report')
                        </div>
                    </div>
                    <!-- date -->
                    <div class="shrink-0">

                        <div class="flex-shrink-0 text-xs font-normal text-grey-border3">
                            {{ explode('T', $lab['labOrderBaseCreated'])[0] }}
                        </div>

                    </div>
                </div>

            </div>
        @empty
            <p>@lang('No data to show')</p>
        @endforelse
    @endif

    <p class="text-center"> {{ $msg }}</p>


</div>
