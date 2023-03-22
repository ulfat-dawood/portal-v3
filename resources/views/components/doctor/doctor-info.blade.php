<div class="box p-5 space-y-5">

    <div class="w-full aspect-square rounded-lg overflow-hidden">

        @if (file_exists(public_path('storage/doctors_images/' . $doctorInfo['photo'])))
            <img class="bg-main-50 object-cover w-full h-full"
                src="{{ asset('storage/doctors_images/' . $doctorInfo['photo']) }}" alt="">
        @else
            <img class="border border-grey-border1 border-0 border-e-2  object-cover w-full h-full"
                src="{{ asset('assets/images/dr-' . 'F' . '-no_bg.png') }}" alt="">
            {{-- src="{{ asset('assets/images/dr-' . $doctorInfo['sex'] . '-no_bg.png') }}" alt=""> --}}
        @endif

    </div>

    <div class="text-xl text-main-600 font-normal">
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

    <ul class="bg-grey-bg2 rounded-lg divide-y-4 divide-white">
        <li class="py-3 px-5 flex gap-4">
            <i class="icofont-stethoscope text-sm"></i>
            <span class="text-sm">
                @if (session('locale') == 'ar')
                    {{ $doctorInfo['clinicNameB'] }}
                @else
                    {{ $doctorInfo['clinicName'] }}
                @endif
            </span>
        </li>
        {{-- <li class="py-3 px-5 flex gap-4">
            <i class="icofont-clock-time text-sm"></i>
            <span class="text-sm">Nearest appointment today in 1 hours 6 minutes</span>
        </li> --}}
        <li class="py-3 px-5 flex gap-4">
            <i class="icofont-bill-alt text-sm"></i>
            <div class="flex justify-between items-center flex-grow">
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

        </li>
    </ul>

    {{-- <div>
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
