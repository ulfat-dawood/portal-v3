<form class="gap-0.5 hidden w-1/3 lg:flex" action="{{ route('home', ['locale' => session('locale')]) }}">
    <select name="ClinicId" class="search-clinic flex-grow bg-grey-bg2 rounded-s-lg" data-placeholder="@lang('Select speciality')">
        {{-- placeholder --}}
        <option value="" data-display="">@lang('Select speciality')</option>
        @foreach (cache('clinics') as $clinic)
            <option value="{{ $clinic['clinicId'] }}" data-icon="{{ str_replace(' ', '-', $clinic['clinicName']) }}"
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
    <select name="DoctorOrCenterName" class="search-keyword flex-grow bg-grey-bg2" data-placeholder="@lang('Search keyword (doctor/clinic)')">
        {{-- placeholder --}}
        <option value="">@lang('Search keyword (doctor/clinic)')</option>
        <optgroup label="{{ __('Clinics') }}">
            @foreach (cache('centers') as $center)
                <option
                    value="@if (session('locale') == 'ar') {{ $center['centerNameB'] }}@else{{ $center['centerName'] }} @endif"
                    data-icon="hospital"
                    @if (session('locale') == 'ar') data-display= "{{ $center['centerNameB'] }}"
                    @else
                    data-display="{{ $center['centerName'] }}" @endif>

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
    <button type="submit"
        class="bg-grey-bg2 px-3 text-xs text-main-600 rounded-e-lg flex-shrink-0 flex-grow-0 hover:bg-grey-border1">
        <i class="icofont-search-1"></i>
    </button>
</form>
