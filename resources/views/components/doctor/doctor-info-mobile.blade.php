<div class="box flex flex-col rounded-none sm:rounded-lg sm:flex-row lg:hidden">
    <!-- doctor img  -->
    <div class="hidden overflow-hidden basis-3/12 relative rounded-lg sm:rounded-te-none sm:rounded-be-none sm:block">
        <figure class="absolute w-full h-full">
            @if (file_exists(public_path('storage/doctors_images/' . $doctorInfo['photo'])))
            <img class="bg-main-50 object-cover w-full h-full"
                src="{{ asset('storage/doctors_images/' . $doctorInfo['photo']) }}" alt="">
        @else
            <img class="border border-grey-border1 border-0 border-e-2  object-cover w-full h-full"
                src="{{ asset('assets/images/dr-' . 'F' . '-no_bg.png') }}" alt="">
            {{-- src="{{ asset('assets/images/dr-' . $doctorInfo['sex'] . '-no_bg.png') }}" alt=""> --}}
        @endif
            {{-- <a href="#"><img class="object-cover w-full h-full" src="../img/dr_hussam.png" alt=""></a> --}}
        </figure>
    </div>
    <!-- card information -->
    <div class="flex-grow divide-y divide-grey-border1">
        <!-- doctor info  -->
        <div class="flex flex-col justify-between p-3 hover:bg-grey-bg1 md:flex-row">
            <!-- start  -->
            <div class="flex flex-col gap-5">
                <div class="flex gap-2">
                    <figure class="h-14 w-14 rounded-lg overflow-hidden sm:hidden">
                        @if (file_exists(public_path('storage/doctors_images/' . $doctorInfo['photo'])))
                        <img class="bg-main-50 object-cover w-full h-full"
                            src="{{ asset('storage/doctors_images/' . $doctorInfo['photo']) }}" alt="">
                    @else
                        <img class="border border-grey-border1 border-0 border-e-2  object-cover w-full h-full"
                            src="{{ asset('assets/images/dr-' . 'F' . '-no_bg.png') }}" alt="">
                        {{-- src="{{ asset('assets/images/dr-' . $doctorInfo['sex'] . '-no_bg.png') }}" alt=""> --}}
                    @endif
                    </figure>
                    <div>
                        <div class="font-normal text-sm sm:text-lg ">
                            @lang('Dr.')
                            @if (session('locale') == 'ar')
                                {{ $doctorInfo['doctorName1b'] .
                                    ' ' .
                                    $doctorInfo['doctorName2b'] .
                                    ' ' .
                                    $doctorInfo['doctorName3b'] .
                                    ' ' .
                                    $doctorInfo['doctorNameFamilyb'] }}
                            @else
                                {{ $doctorInfo['doctorName1'] .
                                    ' ' .
                                    $doctorInfo['doctorName2'] .
                                    ' ' .
                                    $doctorInfo['doctorName3'] .
                                    ' ' .
                                    $doctorInfo['doctorNameFamily'] }}
                            @endif
                        </div>
                        <div class="text-grey-border3 text-sm">
                            @if (session('locale') == 'ar')
                            {{ $doctorInfo['clinicNameB'] }}
                        @else
                            {{ $doctorInfo['clinicName'] }}
                        @endif
                        </div>
                    </div>
                </div>

                <div>
                    <div class="text-grey-border3 text-sm flex gap-1">
                        <i class="icofont-bill-alt text-grey-border3 text-sm"></i>
                        <div class="flex items-baseline gap-1">
                            @if ($doctorInfo['discPercentage'])
                                <div class="text-grey-border3 text-xs line-through"> {{ $doctorInfo['priceBeforeDisc'] }} </div>
                            @endif
                            <div> {{ $doctorInfo['priceAfterDisc'] }} </div>
                            <div>@lang('SR')</div>
                        </div>
                        @if ($doctorInfo['discPercentage'])
                            <div class="text-secondary-300  text-xs bg-secondary-100 rounded-full px-1 font-bold ">
                                {{ $doctorInfo['discPercentage'] }}%</div>
                        @endif
                    </div>

                </div>

                {{-- <div class="pt-0">
                    <div class="text-sm">Specialized in</div>
                    <!-- tags  -->
                    <ul class="flex gap-2 flex-wrap mt-2">
                        <li class="bg-main-200 rounded-full hover:bg-main-300">
                            <a href="#" class="px-3 py-1 text-xs text-main-600 font-normal">
                                Hand and upper limb surgery
                            </a>
                        </li>
                        <li class="bg-main-200 rounded-full hover:bg-main-300">
                            <a href="#" class="px-3 py-1 text-xs text-main-600 font-normal">
                                Bones
                            </a>
                        </li>
                        <li class="bg-main-200 rounded-full hover:bg-main-300">
                            <a href="#" class="px-3 py-1 text-xs text-main-600 font-normal">
                                Adult orthopedic
                            </a>
                        </li>

                    </ul>
                </div> --}}

            </div>

        </div>



    </div>
</div>
