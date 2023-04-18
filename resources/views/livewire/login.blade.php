<div class="w-full max-w-sm ">
    <div class="box px-5 py-7">
        <h2>@lang('Login')</h2>
        <form class=" text-left space-y-7" method="post" action="{{ route('login', ['locale' => session('locale')]) }}">
            @csrf

            {{-- MOBILE NO --}}
            <div class="flex  flex-col gap-2">
                <div class="input-box-wrapper">
                    <input @if (Route::current()->getName() == 'login') autofocus @endif required type="text" id="login-mobile"
                        name="loginMobile" class="input-box" style="direction: ltr">
                    <label for="login-mobile" title="@lang('Mobile number')"></label>
                    <i class="icofont-mobile-phone"></i>
                </div>
                @error('loginMobile')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            {{-- PASSWORD --}}
            <div class="flex  flex-col gap-2">
                <div class="input-box-wrapper">
                    <input required type="password" id="login-password" name="loginPassword" class="input-box">
                    <label for="login-password" title="@lang('Enter password')"></label>
                    <i class="icofont-unlock"></i>
                </div>
                @error('loginPassword')
                    <span class="text-secondary-300 text-xs break-words"><i
                            class="icofont-warning-alt text-secondary-300"></i>
                        {{ $message }}
                    </span>
                @enderror
                <div class=" text-start">
                    <div class="text-xs text-grey-text1 underline cursor-pointer" data-open-modal='#forgot-pass'
                        wire:click='showModal(1)'>
                        @lang('Fotogt password?')
                    </div>
                </div>
            </div>


            <div>
                <button type="submit" class="btn-primary w-full uppercase">
                    @lang('Login')
                    {{-- <i class="icofont-login text-xs text-main-600"></i> --}}
                </button>
            </div>
        </form>
    </div>




    <div class="modal-box @if ($showModal) active @endif" id="forgot-pass">
        <header class="modal-header">
            <div class="title">@lang('نسيان كلمة المرور')</div>
            <div class="close-modal" data-close-modal='#forgot-pass'> <i class="icofont-close"></i> </div>
        </header>

        <div class="modal-content">
            @if ($msg)
                <p class="text-secondary-300 text-center break-words">
                    <i class="icofont-warning-alt text-secondary-300"></i>
                    {{ $msg }}
                </p>
            @endif

            <div class="flex flex-col gap-5 w-full max-w-lg m-auto my-10">
                @if ($isPasswordReset)
                    <div class="flex flex-col justify-center items-center gap-4">

                        <svg fill="#4E9996" height="100px" width="100px" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 52 52" xml:space="preserve">
                            <g>
                                <path
                                    d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26  S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z" />
                                <path
                                    d="M38.252,15.336l-15.369,17.29l-9.259-7.407c-0.43-0.345-1.061-0.274-1.405,0.156c-0.345,0.432-0.275,1.061,0.156,1.406 l10,8C22.559,34.928,22.78,35,23,35c0.276,0,0.551-0.114,0.748-0.336l16-18c0.367-0.412,0.33-1.045-0.083-1.411 C39.251,14.885,38.62,14.922,38.252,15.336z" />
                            </g>
                        </svg>

                        <div class="text-2xl text-main-600">@lang('Password reset successfully')</div>

                    </div>
                @elseif ($isOtpSent)
                    <p>@lang('Please complete the fields to reset your password')</p>

                    {{-- OTP --}}
                    <div class="flex  flex-col gap-2">
                        <div class="input-box-wrapper">
                            <input @if (Route::current()->getName() == 'login') autofocus @endif required type="text"
                                id="otp" wire:model="otp" class="input-box" style="direction: ltr">
                            <label for="otp" title="@lang('OTP')"></label>
                            <i class="icofont-ui-messaging"></i>
                        </div>
                        @error('otp')
                            <span class="text-secondary-300 text-xs break-words"><i
                                    class="icofont-warning-alt text-secondary-300"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- NEW-PASSWORD --}}
                    <div class="flex  flex-col gap-2">
                        <div class="input-box-wrapper">
                            <input @if (Route::current()->getName() == 'login') autofocus @endif required type="password"
                                id="newPassword" wire:model="newPassword" class="input-box" style="direction: ltr">
                            <label for="newPassword" title="@lang('New password')"></label>
                            <i class="icofont-unlock"></i>
                        </div>
                        @error('newPassword')
                            <span class="text-secondary-300 text-xs break-words"><i
                                    class="icofont-warning-alt text-secondary-300"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- password_confirmation  --}}
                    <div class="flex  flex-col gap-2">
                        <div class="input-box-wrapper">
                            <input value="{{ old('newPassword_confirmation') }}" required type="password"
                                wire:model="newPassword_confirmation" id="newPassword_confirmation"
                                name="newPassword_confirmation" class="input-box">
                            <label for="newPassword_confirmation" title="@lang('Reenter the password')"></label>
                            <i class="icofont-unlock"></i>
                        </div>
                        @error('newPassword_confirmation')
                            <span class="text-secondary-300 text-xs break-words"><i
                                    class="icofont-warning-alt text-secondary-300"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="btn-primary" wire:click="resetPassword">
                        @lang('Reset Password')
                    </div>
                @else
                    <p>@lang('Please enter the mobile number registered in your account')</p>

                    {{-- MOBILE NO --}}
                    <div class="flex  flex-col gap-2">
                        <div class="input-box-wrapper">
                            <input @if (Route::current()->getName() == 'login') autofocus @endif required type="text"
                                id="mobile" wire:model="mobile" class="input-box" style="direction: ltr">
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

                    <div class="btn-primary" wire:click="sendOtp">
                        @lang('send verification OTP')
                    </div>
                @endif


            </div>

        </div>
    </div>
</div>
