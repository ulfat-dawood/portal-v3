<div id="slots" class="box p-5 rounded-none sm:rounded-lg ">
    <div class="font-normal mb-5">@lang('Select a day')</div>

    <div class="bg-grey-bg2 w-full rounded-lg p-3">
        <div class="parners-swiper-container relative" wire:ignore>
            <div class="swiper available-days w-11/12 m-auto">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper ">
                    @forelse ($days as $day)
                        <div class="swiper-slide !w-28  relative">
                            <input class="w-0 h-0 opacity-0 absolute" wire:model="selectedDay" type="radio"
                                id="{{ explode('T', $day['date'])[0] }}" name="day"
                                value="{{ explode('T', $day['date'])[0] }}">

                            <label for="{{ explode('T', $day['date'])[0] }}"
                                class="group bg-white p-1.5 rounded-xl !w-28 block cursor-pointer">
                                <div class="rounded-xl overflow-hidden">
                                    <div
                                        class="day-name bg-main-100 text-xs font-medium px-3 py-1 text-center text-main-600 group-hover:bg-main-200">
                                        {{ $day['day'] }}
                                    </div>
                                    <div
                                        class="day-date bg-white text-xs font-medium px-3 py-1 text-center group-hover:bg-main-100 group-hover:text-main-600">
                                        {{ explode('T', $day['date'])[0] }}
                                    </div>
                                </div>
                            </label>
                        </div>
                    @empty
                        <div class="text-grey-text1 text-sm w-full text-center">
                            @lang('No available appointments')
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- navigation buttons -->
            <div class="swiper-button-prev days !hidden md:!flex"></div>
            <div class="swiper-button-next days !hidden md:!flex"></div>
            <!-- pagination -->
            <div class="swiper-pagination days "></div>
        </div>

    </div>

    <div class="slots w-10/12 my-10 mx-auto justify-between">
        <div wire:loading>
            <h1 class="text-3xl text-main-600">LOADING SLOTS..</h1>
        </div>

        @if ($selectedDay)
            <div wire:loading.remove>
                <div class="mb-4 text-grey-text1  text-start">
                    @lang('Morning appointments')
                </div>
                <div class="flex flex-wrap gap-x-6 gap-y-4">
                    @forelse ($slots['am'] as $slot)
                        <div wire:click="getSlot({{ $slot['CLIN_APPT_SLOT_ID'] }})"
                            class="w-24 text-center rounded-lg bg-grey-bg1 px-4 py-2 text-xs font-medium hover:bg-grey-bg2 cursor-pointer">
                            {{  $slot['slot_time'] }} @lang('am')
                        </div>
                    @empty
                        @lang('No appointments available in the morning')
                    @endforelse
                </div>
                <div class="my-4 mt-8 text-grey-text1  text-start">
                    @lang('Evening appointments')
                </div>
                <div class="flex flex-wrap gap-x-6 gap-y-4">
                    @forelse ($slots['pm'] as $slot)
                        <div wire:click="getSlot({{ $slot['CLIN_APPT_SLOT_ID'] }})"
                            class="w-24 text-center rounded-lg bg-grey-bg1 px-4 py-2 text-xs font-medium hover:bg-grey-bg2 cursor-pointer">
                            {{ $slot['slot_time']}} @lang('pm')
                        </div>
                    @empty
                        @lang('No appointments available in the evening')
                    @endforelse
                </div>
                {{ $msg }}
            </div>

        @endif

    </div>

</div>
@push('scripts')
    <script>
        var swiper = new Swiper(".available-days", {

            slidesPerView: 'auto',
            spaceBetween: 30,

            // Optional parameters
            direction: 'horizontal',
            // loop: true,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endpush
