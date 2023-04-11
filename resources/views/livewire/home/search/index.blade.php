<div>
    <div class="">
        <div class="">

            {{-- TABS  --}}
            <div class="flex ">

                <div wire:click='selectTab(1)'
                    class="hover:cursor-pointer py-5 px-3 sm:px-10 flex items-center justify-center border border-t-0 border-l-0 border-r-0
                    @if ($selectedTab == 1) border-b-main-600  @endif">
                    <div class="text-center @if ($selectedTab == 1) text-main-600 @else text-grey-border3 @endif">@lang('At the clinic')</div>
                </div>
                <div wire:click='selectTab(2)'
                    class="hover:cursor-pointer py-5 px-3 sm:px-10 flex items-center justify-center border border-t-0 border-l-0 border-r-0
                    @if ($selectedTab == 2) border-b-main-600 @else text-grey-border3 @endif">
                    <div class="text-center @if ($selectedTab == 2) text-main-600 @else text-grey-border3 @endif">@lang('Home visit')</div>

                </div>
                <div wire:click='selectTab(3)'
                    class="hover:cursor-pointer py-5 px-3 sm:px-10 flex items-center justify-center border border-t-0 border-l-0 border-r-0
                    @if ($selectedTab == 3) border-b-main-600  @endif">
                    <div class="text-center @if ($selectedTab == 3) text-main-600 @else text-grey-border3 @endif">@lang('Online appointment')</div>

                </div>
            </div>

            {{-- TABS CONTENT  --}}
            <div class="tabs-content">
                @switch($selectedTab)
                    @case(1)
                        <livewire:home.search.clinic-appt  :cities="$cities" :clinics="$clinics">
                        @break

                    @case(2)
                        <livewire:home.search.home-visit-appt  :cities="$cities" :clinics="$clinics">
                        @break

                    @case(3)
                        <livewire:home.search.online-appt  :cities="$cities" :clinics="$clinics">
                        @break

                    @default
                        <livewire:home.search.clinic-appt  :cities="$cities" :clinics="$clinics">
                @endswitch
            </div>

        </div>
    </div>
</div>
