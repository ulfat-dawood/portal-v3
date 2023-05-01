<div class="fixed z-10 overflow-y-auto top-0 w-full left-0 " id="modal">
    <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 opacity-75" />
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="flex gap-5 flex-col bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                <p class="text-second text-center">{{ $msg }}</p>

                {{-- LABEL  --}}
                <div class="">
                    <p class="mb-5 text-start text-sm">@lang('Please provide a label for the address, e.g. home, work, office')</p>
                    <div class="flex  flex-col gap-2">
                        <div class="input-box-wrapper">
                            <input required type="label" id="label" wire:model.lazy="label" name="label"
                                class="input-box">
                            <label for="label" title="@lang('Address label')"></label>
                            <i class="icofont-ui-home"></i>
                        </div>

                    </div>
                </div>



                {{-- ADDRESS DESCRIPTION  --}}
                <div class="">
                    <p class="mb-5 text-start text-sm">@lang('Please provide a description of the address')</p>
                    <div class="flex  flex-col gap-2">
                        <div class="input-box-wrapper">
                            <textarea required type="address" id="address" wire:model.lazy="address" name="address" class="input-box">
                            </textarea>
                            <label for="address" title="@lang('Address description')"></label>
                            <i class="icofont-location-arrow"></i>
                        </div>

                    </div>
                </div>


                {{-- LAT/LONG FIELDS  --}}
                <input type="hidden" name="latitude" id="address-latitude" wire:model='latitude'>
                <input type="hidden" name="longitude" id="address-longitude" wire:model='longitude'>

                {{-- LAT/LONG MAP  --}}
                <div class="">
                    <p class="mb-5 text-start text-sm">
                        @lang('Please select the location on the map')
                        <span class="mx-3">
                            @if ($mapStatus == 1)
                                <span class=" text-xs text-secondary-400 font-bold">@lang('Location updating')</span>
                            @elseif($mapStatus == 2)
                                    <i class="icofont-check text-main-600"></i>
                                    <span class="text-xs text-main-600 font-bold">@lang('Location selected')</span>
                            @endif
                        </span>
                    </p>
                    <div class="" wire:ignore>
                        <div style="height: 200px;" id="map">

                        </div>
                    </div>
                </div>

                @if($errors->any())
                    <span class="text-secondary-300 text-xs break-words bg-secondary-100 text-center rounded-lg p-2 font-bold">
                        <i class="icofont-warning-alt text-secondary-300"></i>
                        @lang('Please fill all fields')
                    </span>
                @endif

                {{-- BUTTON --}}
                <div class=" flex justify-between">
                    <button class="btn-primary" wire:click="submit">
                        @lang('Add the address')
                    </button>
                    <button class="btn-secondary" wire:click="$emitUp('toggleModal', 0)">
                        @lang('Cancel')
                    </button>
                </div>

            </div>

        </div>
    </div>


    {{-- Find the GOOGLE MAPS CDN at: \resources\views\layouts\app.blade.php --}}
    <script>
            var latitudeInput = document.querySelector('#address-latitude');
            var longitudeInput = document.querySelector('#address-longitude');

            if (!navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        var latlng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        console.log(latlng);
                    },
                    () => {
                        console.log("Error: The Geolocation service failed.");
                    }
                );
            } else {
                var latlng = new google.maps.LatLng(21.5762, 39.1505);
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function(a) {
                // console.log(a);
                latitudeInput.value = a.latLng.lat();
                longitudeInput.value = a.latLng.lng();
                var address = a.latLng.lat() + ', ' + a.latLng.lng();
                console.log(address);
                // this.Livewire.emit('getLatitudeForInput', a.latLng.lat());
                @this.set('latitude', a.latLng.lat());
                @this.set('longitude', a.latLng.lng());
                @this.set('mapStatus', 2);

            });
            google.maps.event.addListener(marker, 'dragstart', function(a) {
                var mapStatus = "{{ __('Location updating') }}";
                @this.set('mapStatus', 1);
            });

    </script>
</div>
