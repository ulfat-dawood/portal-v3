<div class="box p-4 space-y-2">

    <h3 class="font-bold text-sm">@lang('Appointment confirmation')</h3>
    {{-- Radio buttons  --}}
    @if ($slot['APPT_TYPE_ID'] == 224)
        <select name="address" id="address" wire:model='location_id' class="p-1 border rounded-lg border-gray-200 w-full block">
            <option value=""> @lang('Select') </option>
            @forelse ($addresses as $address)
                <option value="{{ $address['ID'] }}">{{ $address['LABEL'] }}</option>
            @empty
                <p class="text-center">@lang('No addresses added.')</p>
            @endforelse
        </select>
        @if ($showModal)
            <livewire:account.add-address />
        @endif
        <div wire:click="toggleModal(1)" class="flex justify-start items-center self-center py-2 px-4 ms-4 gap-2 rounded-full bg-main-100 cursor-pointer hover:bg-main-200 w-fit">
            <i class="icofont-ui-add text-xs text-main-600"></i>
            <div class="text-main-600 text-sm">@lang('Add address')</div>
        </div>
        @error('location_id')
            <small class="text-red-400">@lang('Please select an address') </small>
        @enderror
    @endif
    <div class="text-sm">
        <p class="my-4 text-sm text-grey-text1">
            @lang('Select a patient name')
        </p>
        @foreach ($patients as $key => $patient)
            <div class="flex items-center me-4 mb-2">
                <input wire:model="selectedPatient" type="radio" id="patient-{{ $key }}" value="{{ $key }}" class="hidden classic-radio" />
                <label for="patient-{{ $key }}" class="flex items-center cursor-pointer">
                    <span class="w-4 h-4 inline-block me-1 rounded-sm border border-grey"></span>
                    <div class="">{{ $patient['PATIENT_NAME_1'] }}</div>
                </label>
            </div>
        @endforeach
        {{-- new patient  --}}
        <div class="flex items-center mb-4">
            <input wire:model="selectedPatient" type="radio" id="patient-new" value="new" class="hidden classic-radio" />
            <label for="patient-new" class="flex items-center cursor-pointer">
                <div class="flex flex-col">
                    <div>
                        <span class="w-4 h-4 inline-block me-1 rounded-sm border border-grey "></span>
                        @lang('New patient')
                    </div>
                    @if ($showNewPatient)
                        <div class="flex flex-col lg:gap-1 sm:gap-5 pt-4 sm:flex-row">
                            {{-- PATIENT NAME  --}}
                            <div class="flex  flex-col gap-1">
                                <div class="input-box-wrapper">
                                    <input wire:model="firstName" required type="text" id="patient-name" name="firstName" class="input-box" style="direction: ltr">
                                    <label for="patient-name" title="@lang('Patient name')"></label>
                                    <i class="icofont-ui-user"></i>
                                </div>

                            </div>
                            {{-- PATIENT Mobile  --}}
                            <div class="flex  flex-col gap-1">
                                <div class="input-box-wrapper">
                                    <input wire:model="mobile" required type="number" id="patient-mobile" name="mobile" class="input-box" style="direction: ltr">
                                    <label for="patient-mobile" title="@lang('Mobile number')"></label>
                                    <i class="icofont-mobile-phone"></i>
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </label>
        </div>
    </div>
    <div class="space-y-2">
        @if ($errors->any())
            <span class="text-secondary-300 text-xs break-words">
                <i class="icofont-warning-alt text-secondary-300"></i>
                @lang('Please complete selection')
            </span>
        @endif
        <button wire:click="pay(0)" class="btn-primary w-full">
            @lang('Pay now')
        </button>

        <button wire:click="pay(1)" class="btn-primary w-full">
            @lang('Pay on arriaval')
            <span class="text-xs text-inherit ps-2"> @lang('SR')</span>
        </button>
    </div>

    <!-- Google Maps  -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
</div>
