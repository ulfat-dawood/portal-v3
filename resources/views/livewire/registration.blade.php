<div class="w-full max-w-sm ">
    <div class="box px-5 py-7">
        <h2>@lang('Create a new account')</h2>
        <div class="this-was-a-form text-left space-y-7">
            <div></div>
            {{-- Name  --}}
            <div class="flex  flex-col gap-2">
                <div class="input-box-wrapper">
                    <input value="{{ old('name') }}" @if (Route::current()->getName() == 'register') autofocus @endif
                        wire:model.lazy="name" required type="text" id="name" name="name" class="input-box">
                    <label for="name" title="@lang('Enter your name')"></label>
                    <i class="icofont-id-card"></i>
                </div>
                @error('name')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- mobile number  --}}
            <div class="flex  flex-col gap-2">
                <div class="input-box-wrapper">
                    <input value="{{ old('mobile') }}" required type="text" id="mobile" name="mobile"
                        wire:model.lazy="mobile" class="input-box" style="direction: ltr">
                    <label for="mobile" title="@lang('Mobile number')"></label>
                    <i class="icofont-mobile-phone"></i>
                </div>
                @error('mobile')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>


            {{-- email  --}}
            <div class="flex  flex-col gap-2">
                <div class="input-box-wrapper">
                    <input value="{{ old('email') }}" required type="text" id="email" name="email"
                        wire:model.lazy="email" class="input-box" style="direction: ltr">
                    <label for="email" title="@lang('Email')"></label>
                    <i class="icofont-ui-email text-xs"></i>
                </div>
                @error('email')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>


            {{-- Password  --}}
            <div class="flex  flex-col gap-2">
                <div class="input-box-wrapper">
                    <input value="{{ old('password') }}" required type="password" id="password"
                        wire:model.lazy="password" wire:model.lazy="password" name="password" class="input-box">
                    <label for="password" title="@lang('Enter password')"></label>
                    <i class="icofont-unlock"></i>
                </div>
                @error('password')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>


            {{-- password_confirmation  --}}
            <div class="flex  flex-col gap-2">
                <div class="input-box-wrapper">
                    <input value="{{ old('password_confirmation') }}" required type="password"
                        wire:model.lazy="password_confirmation" id="password_confirmation" name="password_confirmation"
                        class="input-box">
                    <label for="password_confirmation" title="@lang('Reenter the password')"></label>
                    <i class="icofont-unlock"></i>
                </div>
                @error('password_confirmation')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Accept policy  --}}
            <div class="text-right">
                <div class="flex justify-start gap-2 items-center">
                    <div class="input-box-wrapper">
                        <input type="checkbox" id="policy" name="policy" wire:model.lazy="policy"
                            class="input-box  w-5 h-5 p-0 rounded-sm text-main-700">
                        <label for="policy"></label>
                    </div>


                    <label for="policy" class="text-xs">
                        <span>@lang('Agree to')</span>
                        <span class="underline cursor-pointer"
                            data-open-modal='#privacy-policy'>@lang('privacy policy')</span>
                        <span> @lang('and') </span>
                        <span class="underline cursor-pointer" data-open-modal='#service-terms'>@lang('service terms')</span>
                    </label>
                </div>
                @error('policy')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <div>
                <button class="btn-primary w-full" wire:click='requestOtp'>
                    @lang('Register')
                </button>
            </div>
        </div>
    </div>

    @if ($isOtpSent)
        <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 " id="modal">
            <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-900 opacity-75" />
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="flex gap-5 flex-col bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <p class="text-red-600 text-center">{{ $msg }}</p>
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
                        <div>
                            <button class="btn-primary w-full" wire:click='submitOtp'>
                                @lang('Confirm OTP')
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
