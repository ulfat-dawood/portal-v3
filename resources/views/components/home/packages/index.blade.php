<section id="packages" class="w-full mt-28 py-20 bg-white ">
    <div class="container">
        <!-- title  -->
        <div class="flex items-center border-b border-teal-500 mb-14">
            <h2 class="flex-none w-11/12 text-gray text-lg mr-3 py-1 px-2">
                @lang('Offers')
            </h2>
            <a href="#" class="flex-shrink-0 text-md text-gray py-1 px-2">
                @lang('All Offers')
            </a>
        </div>

        <!-- Slider -->
        <div class="packages-swiper-container relative">
            <div class="swiper doctors w-11/12 m-auto">
                <div class="swiper-wrapper">
                    @forelse ($packages as $package)
                        <div class="swiper-slide mb-2">
                            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                                <div class="bg-main-100 h-32 rounded-lg overflow-hidden relative">
                                    <figure class="absolute left-0 right-0 top-0 bottom-0 w-full">
                                        <img class="bg-main-50 object-cover w-full h-full" src="{{ $package['img'] }}"
                                            alt="">
                                    </figure>
                                </div>
                                <a href="#" class="px-8 py-4">
                                    <div class="font-bold text-xl mb-2 mr-2">{{ $package['title'] }}</div>
                                    <p class="text-gray-700 text-base mr-3"> {{ $package['description'] }} </p>
                                </a>
                                <div class="px-6 pt-4 pb-2">
                                    <span
                                        class="inline-block bg-orange-300 rounded-full px-3 py-1 text-sm font-semibold text-orange-600 mr-2 mb-2">
                                        {{ $package['price'] }} @lang('SR')</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div><span>@lang('No Packages Available')</span></div>
                    @endforelse
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
