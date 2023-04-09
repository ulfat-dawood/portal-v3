<section id="packages" class="w-full py-20 bg-grey-bg2">
    <div class="container">
        <!-- title  -->
        <div class="flex items-center border-b border-teal-500 mb-14">
            <h2 class="flex-none w-11/12 text-gray text-lg mr-3 py-1 px-2">
                @lang('Packages')
            </h2>
            <a href="#" class="flex-shrink-0 text-md text-gray py-1 px-2">
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
                            <a href="#">
                                <div class="rounded overflow-hidden shadow mx-2 mb-2 mt-2 relative">
                                    {{-- <div class="bg-main-100 h-32 rounded-lg overflow-hidden relative">
                                        <figure class="absolute bg-white">
                                            <img class="h-32 w-full ps-10 pr-4 ms-8" src="https://www.backgroundsy.com/file/preview/red-sticker-template.jpg"/>
                                        </figure>
                                        <h3 class=" relative inline-block bg-secondary-300 rounded-full px-4 ms-8 mt-2 text-md text-white hidden" class="if-true:line-through">@lang('Before') {{ $package['PKG_PRICE'] }} @lang('SR')</h3>
                                        @if ($package['PKG_PRICE'] != null)
                                            <h3 class="relative inline-block bg-secondary-300 rounded-full px-4 ms-8 mt-2 text-md text-white">@lang('After') {{ $package['PKG_PRICE'] }} @lang('SR')</h3>
                                        @endif
                                    </div> --}}

                                    <h1 class="text-md font-bold px-3 my-2">{{ $package['PKG_NAME'] }}</h1>

                                    <p class="px-3 mx-2 text-gray-700 text-sm">{{ Str::substr($package['PKG_DESC'], 0, 45) }} ...</p>

                                    <div class="px-6 pt-4 pb-2 text-center">
                                        <h2 class="inline-block bg-main-500 rounded-full px-5 py-1 text-sm text-white my-2 mb-2">{{ $package['PKG_PRICE'] }} @lang('SR')</h2>
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
</div>
</section>
