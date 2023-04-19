<div class="fixed z-10 overflow-y-auto top-0 w-full left-0 " id="modal">
    <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 opacity-75" />
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="flex gap-5 flex-col bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                {{-- <p class="text-red-600 text-center">{{ $msg }}</p> --}}
                {{-- OTP  --}}
                <div class="flex  flex-col gap-2">
                    <div class="input-box-wrapper">
                        <input required type="otp" id="otp"
                            wire:model.lazy="otp"  name="otp"
                            class="input-box">
                        <label for="otp" title="@lang('Enter otp')"></label>
                        <i class="icofont-unlock"></i>
                    </div>
                    @error('otp')
                        <span class="text-secondary-300 text-xs break-words"><i
                                class="icofont-warning-alt text-secondary-300"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class=" flex justify-between">
                    <button class="btn-primary" type="submit">
                        @lang('Add address')
                    </button>
                    <button class="btn-secondary" wire:click="$emitUp('toggleModal', 0)">
                        @lang('Cancel')
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>
