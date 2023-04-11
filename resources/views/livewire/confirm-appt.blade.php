<div class="box p-4 space-y-2">

    <h3 class="font-bold text-sm">@lang('Appointment confirmation')</h3>

    {{-- Radio buttons  --}}
    <div class="text-sm">
        <p class="my-4 text-sm text-grey-text1">
            @lang('Select a patient name')
        </p>
        @foreach ($patients as $key => $patient)
            <div class="flex items-center me-4 mb-2">
                <input wire:model="selectedPatient" type="radio"
                id="patient-{{$key}}" value="{{$key}}" class="hidden classic-radio" />
                <label for="patient-{{$key}}" class="flex items-center cursor-pointer">
                    <span class="w-4 h-4 inline-block me-1 rounded-sm border border-grey"></span>
                    <div class="">{{$patient['PATIENT_NAME_1']}}</div>
                </label>
            </div>
        @endforeach
        {{-- new patient  --}}
        <div class="flex items-center me-4 mb-4">
            <input wire:model="selectedPatient" type="radio"
            id="patient-new" value="new" class="hidden classic-radio" />
            <label for="patient-new" class="flex items-center cursor-pointer">
                <div class="flex flex-col">
                    <div>
                        <span class="w-4 h-4 inline-block me-1 rounded-sm border border-grey "></span>
                        @lang('New patient')
                    </div>
                    @if($showNewPatient)
                        <div class="flex flex-col gap-5 pt-4 sm:flex-row">
                            {{-- PATIENT NAME  --}}
                            <div class="flex  flex-col gap-2">
                                <div class="input-box-wrapper">
                                    <input wire:model="firstName" required type="text"
                                        id="patient-name" name="firstName" class="input-box"
                                        style="direction: ltr">
                                    <label for="patient-name" title="@lang('Patient name')"></label>
                                    <i class="icofont-ui-user"></i>
                                </div>
                                @error('firstName')
                                    <span class="text-secondary-300 text-xs break-words"><i
                                            class="icofont-warning-alt text-secondary-300"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>


                            {{-- PATIENT Mobile  --}}
                            <div class="flex  flex-col gap-2">
                                <div class="input-box-wrapper">
                                    <input wire:model="mobile" required type="number"
                                        id="patient-mobile" name="mobile" class="input-box"
                                        style="direction: ltr">
                                    <label for="patient-mobile" title="@lang('Mobile number')"></label>
                                    <i class="icofont-mobile-phone"></i>
                                </div>
                                @error('mobile')
                                    <span class="text-secondary-300 text-xs break-words"><i
                                            class="icofont-warning-alt text-secondary-300"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>
            </label>
        </div>



    </div>

    <div class="space-y-2">
        <button wire.click="payNow" class="btn-primary w-full">
            @lang('Pay now')
        </button>

        <button wire.click="payLater" class="btn-primary w-full">
            @lang('Pay on arriaval')
            <span class="text-xs text-inherit ps-2"> @lang('SR')</span>
        </button>
    </div>
</div>
