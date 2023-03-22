<!-- FLTERS  -->
<div class="hidden box w-60 flex-shrink-0 lg:block">
    <form action="{{ route('home', ['locale' => session('locale')]) }}">

        <!-- filters -->
        <ul class="">
            <!-- Search keyword  -->
            <li class="py-3 px-5 space-y-2">
                <div>
                    <i class="text-grey-text1 text-xs icofont-flash"></i>
                    <span class="text-grey-text1 text-xs">@lang('Search keyword')</span>
                </div>

                <select name="DoctorOrCenterName"
                    class=" search-keyword
                    p-1 bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1
                    border-none text-sm transition-all  w-full"
                    data-placeholder="@lang('Search keyword (doctor/clinic)')">

                    {{-- placeholder --}}
                    <option value="">@lang('Search keyword (doctor/clinic)')</option>

                    <optgroup label="{{ __('Clinics') }}">
                        @foreach (cache('centers') as $center)
                            <option {{-- @if (old('DoctorOrCenterName') == $day) selected @endif --}}
                                value="@if (session('locale') == 'ar') {{ $center['centerNameB'] }}@else{{ $center['centerName'] }} @endif"
                                data-icon="hospital"
                                @if (session('locale') == 'ar') data-display= "{{ $center['centerNameB'] }}"
                                @else data-display="{{ $center['centerName'] }}" @endif>

                                @if (session('locale') == 'ar')
                                    {{ $center['centerNameB'] }}
                                @else
                                    {{ $center['centerName'] }}
                                @endif

                            </option>
                        @endforeach
                        >
                    </optgroup>
                    <optgroup label="{{ __('Doctors') }}">
                        @foreach (cache('doctors') as $doctor)
                            <option
                                value="@if (session('locale') == 'ar') {{ $doctor['doctorName1b'] }}@else{{ $doctor['doctorName1'] }} @endif"
                                data-icon="doctor"
                                @if (session('locale') == 'ar') data-display="{{ $doctor['doctorName1b'] . ' ' . $doctor['doctorName2b'] . ' ' . $doctor['doctorName3b'] . ' ' . $doctor['doctorNameFamilyb'] }}"
                            @else
                            data-display="{{ $doctor['doctorName1'] . ' ' . $doctor['doctorName2'] . ' ' . $doctor['doctorName3'] . ' ' . $doctor['doctorNameFamily'] }}" @endif>
                                @if (session('locale') == 'ar')
                                    {{ $doctor['doctorName1b'] .
                                        ' ' .
                                        $doctor['doctorName2b'] .
                                        ' ' .
                                        $doctor['doctorName3b'] .
                                        ' ' .
                                        $doctor['doctorNameFamilyb'] }}
                                @else
                                    {{ $doctor['doctorName1'] .
                                        ' ' .
                                        $doctor['doctorName2'] .
                                        ' ' .
                                        $doctor['doctorName3'] .
                                        ' ' .
                                        $doctor['doctorNameFamily'] }}
                                @endif

                            </option>
                        @endforeach
                        >
                    </optgroup>
                </select>

            </li>

            <!-- Speciality  -->
            <li class="py-3 px-5 space-y-2">
                <div>
                    <i class="text-grey-text1 text-xs icofont-stethoscope"></i>
                    <span class="text-grey-text1 text-xs">@lang('Speciality')</span>
                </div>

                <select name="ClinicId"
                    class="search-clinic
                    p-1 bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1
                    border-none text-sm transition-all  w-full"
                    data-placeholder="@lang('Select speciality')">

                    {{-- placeholder --}}
                    <option value="" data-display="">@lang('Select speciality')</option>

                    @foreach (cache('clinics') as $clinic)
                        <option @if (old('ClinicId') == $clinic['clinicId']) selected @endif value="{{ $clinic['clinicId'] }}"
                            data-icon="{{ str_replace(' ', '-', $clinic['clinicName']) }}"
                            @if (session('locale') == 'ar') data-display="{{ $clinic['clinicNameB'] }}"
                        @else
                            data-display="{{ $clinic['clinicName'] }}" @endif>
                            @if (session('locale') == 'ar')
                                {{ $clinic['clinicNameB'] }}
                            @else
                                {{ $clinic['clinicName'] }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </li>



            <!-- city  -->
            <li class="py-3 px-5 space-y-2">
                <div>
                    <i class="text-grey-text1 text-xs icofont-location-pin"></i>
                    <span class="text-grey-text1 text-xs">@lang('City')</span>
                </div>

                <select name="CityId"
                    class="search-basic
                    p-1 bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1
                    border-none text-sm transition-all  w-full"
                    data-placeholder="@lang('Select city')">

                    {{-- placeholder --}}
                    <option value="" data-display="">@lang('Select city')</option>

                    @foreach (cache('cities') as $city)
                        <option value="{{ $city['cityId'] }}"
                            @if (session('locale') == 'ar') data-display="{{ $city['cityNameB'] }}"
                        @else
                            data-display="{{ $city['cityName'] }}" @endif>
                            @if (session('locale') == 'ar')
                                {{ $city['cityNameB'] }}
                            @else
                                {{ $city['cityName'] }}
                            @endif
                        </option>
                    @endforeach
                </select>

            </li>

            <!-- gender  -->
            <li class="py-3 px-5 space-y-2">
                <div>
                    <i class="text-grey-text1 text-xs icofont-male"></i>
                    <span class="text-grey-text1 text-xs">@lang('Gender')</span>
                </div>

                <select name="Gender"
                    class="search-basic
                    p-1 bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1
                    border-none text-sm transition-all  w-full"
                    data-placeholder="@lang('Select preference')">

                    {{-- placeholder --}}
                    <option value="" data-display="">@lang('Select preference')</option>
                    <option value="F" data-display="">@lang('Female')</option>
                    <option value="M" data-display="">@lang('Male')</option>



                </select>

            </li>


        </ul>

        <!-- submit button  -->
        <div class="p-5 space-y-3">
            <button type="submit" class="p-2 text-xs bg-main-600 w-full rounded-lg hover:bg-main-700">
                <i class="text-main-50 text-xs icofont-search-1"></i>
                <span class="text-main-50 text-xs">@lang('Find doctors')</span>
            </button>

        </div>

    </form>
</div>
