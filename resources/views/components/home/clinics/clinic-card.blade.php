<div class="swiper-slide box  rounded-full hover:bg-main-50 cursor-pointer group !w-fit px-6">
    <a href="{{ route('home', ['locale' => session('locale'), 'ClinicId' => $clinic['clinicId']]) }}" class="pt-3 pb-2 flex gap-3 justify-center">
        <span class="nxn-{{ str_replace(' ', '-', $clinic['clinicName']) }}  text-main-600 text-lg"></span>
        <span class="group-hover:text-main-600">

            @if (session('locale') == 'ar')
                {{ $clinic['clinicNameB'] }}
            @else
                {{ $clinic['clinicName'] }}
            @endif

        </span>
    </a>
</div>
