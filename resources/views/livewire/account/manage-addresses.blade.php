<div>
    @include('layout.flash-messages')

    <div>
        @if ($showModal)
            <div>
                <livewire:account.add-address>
            </div>
        @endif
    </div>

    <div class="flex flex-col gap-4">
        <div class="flex justify-center">
            <div wire:click="toggleModal(1)" class="flex justify-start items-center self-center py-2 px-4 ms-4 gap-2 rounded-full bg-main-100 cursor-pointer hover:bg-main-200 w-fit">
                <i class="icofont-ui-add text-xs text-main-600"></i>
                <div class="text-main-600 text-sm">@lang('Add address')</div>
            </div>
        </div>
        @forelse ($addresses as $address)

            <div class="flex flex-grow bg-grey-bg2 rounded-lg p-2 mx-5 gap-2 flex-col  md:flex-row">

                <div class="flex-grow bg-white rounded-lg d p-1 flex gap-2">


                    <div>
                        <div class="font-normal text-sm">
                            @lang('Label') :  {{$address['LABEL']}}
                        </div>
                        <div class="font-normal text-sm">
                            @lang('Building type') :  {{$address['BUILDING_TYPE']}}
                        </div>
                        <div class="font-normal text-sm">
                            @lang('Address') :  {{$address['ADDRESS']}}
                        </div>
                    </div>
                </div>
                <!-- appt details  -->
                <div class="flex flex-row gap-2  py-1 md:flex-col md:py-0 justify-start">

                    <div wire:click="delete({{ $address['ID'] }})"
                        class="border border-white  border-4 text-center bg-secondary-100 rounded-lg text-secondary-400 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-secondary-200">
                        <i class="icofont-ui-remove text-secondary-400 text-xs"></i>
                        @lang('Remove')
                    </div>

                    <a target="_blank"
                        href="https://www.google.com/maps/search/?api=1&query={{ $address['LATITUDE'] }},{{ $address['LONGITUDE'] }}"
                        class=" block border border-white  border-4 text-center bg-main-100 rounded-lg text-main-600 text-xs font-normal px-2 py-1 cursor-pointer hover:bg-main-200">
                        <i class="icofont-location-pin text-main-600 text-xs"></i>
                        @lang('Map')
                    </a>

                </div>
            </div>

        @empty
            <p class="text-center">@lang('No addresses added.')</p>
        @endforelse
    </div>

    <!-- Google Maps  -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
</div>
