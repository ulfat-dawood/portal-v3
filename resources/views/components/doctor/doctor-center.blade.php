<div class="box hover:bg-grey-bg1 rounded-none sm:rounded-lg ">
    <a href="#">
        <div class="flex divide-grey-border1">
            <div class="p-5">
                <figure class=" h-10">
                    @if (file_exists(public_path('storage/Logo/' . $doctorInfo['logo'])))
                        <img class="w-full h-full object-contain" src="{{ asset('storage/Logo/' . $doctorInfo['logo']) }}"
                            alt="">
                    @else
                        <img class="w-full h-full object-contain" src="{{ asset('assets/images/athir_logo.png') }}"
                            alt="">
                    @endif
                    {{-- <img src="https://mafaselclinic.com/wp-content/uploads/2021/06/Mafasel-Logo-Full-Color.png" alt="" class="h-full w-full object-contain"> --}}
                </figure>
            </div>
            <div class="p-5 space-y-1">
                <div class="text-sm font-normal">
                    @if (session('locale') == 'ar')
                     {{ $doctorInfo['centerNameB']}}
                    @else
                     {{ $doctorInfo['centerName']}}
                    @endif
                </div>
                <div class="underline text-xs text-grey-border3">
                    <i class="icofont-location-pin text-grey-border3"></i>
                    @if (session('locale') == 'ar')
                        {{ $doctorInfo['addressB']}}
                   @else
                        {{ $doctorInfo['address']}}
                   @endif
                </div>
            </div>
        </div>
    </a>
</div>
