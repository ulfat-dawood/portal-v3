@extends('layout.master')
@section('title', __('Address'))

@section('script')
    <script async type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
@endsection
@section('content')

    <div class="container xl:px-[9vw] mt-16">

        <div class="container">
            <div class="flex items-start gap-10 flex-col lg:flex-row">
                <div class="flex-grow flex flex-col gap-5 min-h-0 min-w-0">
                    <div class="box p-4 space-y-2">

                        <h3 class="font-bold text-sm">@lang('Address Details')</h3>

                        <div class="flex gap-4 flex-col md:flex-row">

                            <div class="flex-grow flex gap-2 rounded-lg bg-grey-bg2 p-2">
                                <div class="space-y-2 flex-grow">
                                    <div class="text-sm ps-2">
                                    </div>
                                    <div class="bg-white rounded-md p-2 text-sm w-full flex-wrap">
                                        <input name="lat" id="lat" />
                                        <input name="lng" id="lng" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box p-4">
                        {{-- MAP --}}
                        <div class="form-group">
                            <input type="text" id="address-input" name="address_address" class="form-control map">
                            <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                            <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                        </div>
                        <div id="map" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
