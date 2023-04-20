<section id="packages" class="w-full py-20 bg-grey-bg2">
    <div class="container">
        <!-- title  -->
        <div class="container items-center mb-14 px-11 inline-flex">
            <h2 class=" mr-8 w-11/12 text-gray-text1 text-lg">
                @lang('Packages')
            </h2>
            <a href="{{ route('getPackages', ['locale' => session('locale')]) }}"
                class="text-sm text-gray-text1 flex-shrink-0">
                @lang('All packages')
            </a>
        </div>

        <!-- Slider -->
        <div class="packages-swiper-container relative">
            <div class="swiper packages w-11/12 mx-auto">
                <div class="swiper-wrapper">
                    @if (isset($packages))
                        @foreach ($packages as $key => $package)
                            @if ($key > 5)
                            @break
                        @endif
                        <div class="swiper-slide">
                            <a href="{{ route('getPackage', ['locale' => session('locale'), 'packageId' => $package['PKG_ID']]) }}">

                                <div class="rounded-lg overflow-hidden shadow mx-2 mb-2 mt-2 py-2 relative bg-cover" style="background-image: url(http://portal.test/assets/images/packages.png);" >
                                    {{-- <div class="bg-main-100 h-32 rounded-lg overflow-hidden relative">
                                        <figure class="absolute">
                                            <img class="h-32 w-full ps-10 pr-4 ms-8" src="https://www.backgroundsy.com/file/preview/red-sticker-template.jpg"/>
                                        </figure>
                                        <h3 class="relative inline-block bg-secondary-300 rounded-full px-4 ms-8 mt-2 text-md text-white" class="isTrue:line-through">@lang('Before') {{ $package['PKG_PRICE'] }} @lang('SR')</h3>                                        @if ($package['PKG_PRICE'] != null)
                                            <h3 class="relative inline-block bg-secondary-300 rounded-full px-4 ms-8 mt-2 text-md text-white">@lang('After') {{ $package['PKG_PRICE'] }} @lang('SR')</h3>
                                        @endif
                                    </div> --}}

                                    <h1 class="text-md font-bold text-white px-4 my-2">{{ $package['PKG_NAME'] }}
                                    </h1>

                                    <p class="px-3 mx-2 mb-2 text-white text-sm">{{ $package['PKG_DESC'] }}</p>

                                    <div class="py-4 mx-5 px-2">
                                        <h3 class="text-secondary-400 text-xs">
                                            {{ $package['HOSPITAL_NAME'] }}</h3>
                                        <i class="icofont-location-pin text-xs text-secondary-400"></i>
                                        <h3 class="inline-block text-secondary-400 text-xs">
                                            {{ $package['CITY_NAME'] }}</h3>
                                    </div>

                                    <div class="text-left mx-6 my-4">
                                        @if ($package['PKG_PRICE'] != $package['SRVC_PRICE'])
                                            <h2 class="pl-1 inline-block text-sm text-white line-through">
                                                {{ $package['PKG_PRICE'] }}
                                            </h2>
                                            <h2 class="px-3 py-1 inline-block bg-white rounded-3xl text-sm font-bold text-main-700">
                                                {{ $package['SRVC_PRICE'] }}
                                                @lang('SR')</h2>
                                        @else
                                            <h2 class="px-3 py-1 inline-block bg-white rounded-3xl text-sm font-bold text-main-700">
                                                {{ $package['PKG_PRICE'] }}
                                                @lang('SR')</h2>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div><span>@lang('No Packages Available')</span></div>
                @endif
            </div>
        </div>
        <!-- navigation buttons -->
        <div class="swiper-button-prev packages !hidden md:!flex"></div>
        <div class="swiper-button-next packages !hidden md:!flex"></div>
        <!-- pagination -->
        <div class="swiper-pagination packages"></div>
    </div>
</section>
