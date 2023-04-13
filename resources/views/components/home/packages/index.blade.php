<section id="packages" class="w-full py-20 bg-grey-bg2">
    <div class="container">
        <!-- title  -->
        <div class="flex items-center mb-14 mx-14 pr-4">
            <h2 class="flex-none w-11/12 text-gray-text1 text-lg">
                @lang('Packages')
            </h2>
            <button data-open-modal="#Allpackages" class="flex-shrink-0 text-md text-gray-text1">
                @lang('All packages')
            </button>
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
                            <a
                                href="{{ route('getPackages', ['locale' => session('locale'), 'packageId' => $key]) }}">

                                <div
                                    class="rounded overflow-hidden shadow mx-2 mb-2 mt-2 py-2 relative text-center bg-white">
                                    {{-- <div class="bg-main-100 h-32 rounded-lg overflow-hidden relative">
                                        <figure class="absolute">
                                            <img class="h-32 w-full ps-10 pr-4 ms-8" src="https://www.backgroundsy.com/file/preview/red-sticker-template.jpg"/>
                                        </figure>
                                        <h3 class="relative inline-block bg-secondary-300 rounded-full px-4 ms-8 mt-2 text-md text-white" class="isTrue:line-through">@lang('Before') {{ $package['PKG_PRICE'] }} @lang('SR')</h3>                                        @if ($package['PKG_PRICE'] != null)
                                            <h3 class="relative inline-block bg-secondary-300 rounded-full px-4 ms-8 mt-2 text-md text-white">@lang('After') {{ $package['PKG_PRICE'] }} @lang('SR')</h3>
                                        @endif
                                    </div> --}}

                                    <h1 class="text-md font-bold px-3 my-2">{{ $package['PKG_NAME'] }}</h1>

                                    <p class="px-3 mx-2 text-gray-700 text-sm">{{ $package['PKG_DESC'] }}</p>

                                    <p class="px-3 mx-2 text-gray-800 text-xs">{{ $package['HOSPITAL_NAME'] }},
                                        {{ $package['CITY_NAME'] }}</p>

                                    <div
                                        class="px-6 pb-2 text-center inline-block bg-main-500 rounded-full py-1 my-2 mb-2">
                                        @if ($package['PKG_PRICE'] != $package['SRVC_PRICE'])
                                            <h2 class="text-xs text-gray line-through">{{ $package['PKG_PRICE'] }}
                                            </h2>
                                            <h2 class="text-sm text-white">{{ $package['SRVC_PRICE'] }}
                                                @lang('SR')</h2>
                                        @else
                                            <h2 class="text-sm text-white">{{ $package['PKG_PRICE'] }}</h2>
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

    <div class="modal-box" id="Allpackages">
        <header class="modal-header">
            <div class="text-md">@lang('All packages')</div>
            <div class="close-modal" data-close-modal='#Allpackages'> <i class="icofont-close"></i> </div>
        </header>
        <div class="modal-content">
            <div class="container">
                <div class="card w-10/12 mx-auto flex flex-col flex-wrap justify-center">
                    @if (isset($packages))
                        @foreach ($packages as $key => $package)
                            <a class="hover:bg-gray-100" href="{{ route('getPackages', ['locale' => session('locale'), 'packageId' => $key]) }}">

                                <div class="flex-grow p-1 grid grid-cols-2 divide-x-2 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                                    <div class="flex felx-row rounded overflow-hidden shadow-lg mx-1 mb-1 mt-1 py-2 relative bg-white">

                                        <div>
                                            <h1 class="text-md font-bold px-3 my-2">{{ $package['PKG_NAME'] }}</h1>
                                            <h6 class="flex px-3 mx-2 p-3 text-gray-700 text-sm">{{ $package['PKG_DESC'] }}</h6>
                                            <i class="icofont-location-pin text-xs px-4 mx-2 text-gray-700"> {{ $package['HOSPITAL_NAME'] }}, {{ $package['CITY_NAME'] }}</i>
                                            <h6 class="flex  text-sm"></h6>
                                        </div>

                                        <div class="flex-shrink-0 absolute left-0 top-0 w-24 h-11 m-1 bg-main-500 rounded-xl text-center items-center">
                                            @if ($package['PKG_PRICE'] != $package['SRVC_PRICE'])
                                                <h2 class="text-sm text-gray line-through">{{ $package['PKG_PRICE'] }} @lang('SR')</h2>
                                                <h2 class="text-sm text-white">{{ $package['SRVC_PRICE'] }} @lang('SR')</h2>
                                            @else
                                                <h2 class="text-sm text-white">{{ $package['PKG_PRICE'] }}</h2>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="text-center"><span>@lang('No Packages Available')</span></div>
                    @endif
                </div>
            </div>
        </div>
</section>
