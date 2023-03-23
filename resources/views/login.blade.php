@extends('layout.master')
@section('title', __('Login'))

@section('modal')
    <x-common.privacy-policy />
    <x-common.service-terms />
@endsection

@section('content')
    <div class=" min-h-screen">
        <div
            class="my-12 flex  justify-center items-center gap-x-10  lg:items-stretch
        @if (Route::current()->getName() != 'login') flex-col-reverse lg:flex-row-reverse
        @else
        flex-col lg:flex-row @endif
        ">
            {{-- << LOGIN >> --}}
            <div class="w-full max-w-sm ">
                <div class="box px-5 py-7">
                    <h2>@lang('Login')</h2>
                    <form class=" text-left space-y-7" method="post"
                        action="{{ route('login', ['locale' => session('locale')]) }}">
                        @csrf

                        {{-- MOBILE NO --}}
                        <div class="flex  flex-col gap-2">
                            <div class="input-box-wrapper">
                                <input @if (Route::current()->getName() == 'login') autofocus @endif required type="text"
                                    id="login-mobile" name="loginMobile" class="input-box"
                                    style="direction: ltr">
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
                                <a class="text-xs text-grey-text1 underline"
                                    href="{{ route('home', ['locale' => session('locale')]) }}">
                                    @lang('Fotogt password?')
                                </a>
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
            </div>

            <div class="hidden bg-grey-border2 w-[1px] my-14  relative lg:block">
                <div class="absolute text-sm bg-grey-bg1 text-grey-border3"
                    style="top:50%; left: 50%;  transform: translate(-50%, -50%);">@lang('or')</div>
            </div>

            <div class="blcok bg-grey-border2 h-[1px] my-6 w-full max-w-sm  relative lg:hidden">
                <div class="absolute text-sm bg-grey-bg1 text-grey-border3 px-1"
                    style="top:50%; top: 50%;left: 50%;  transform: translate(-50%, -50%);">or</div>
            </div>

            {{-- << REGISTER >>  --}}
            <div class="w-full max-w-sm ">
                <div class="box px-5 py-7">
                    <h2>@lang('Create a new account')</h2>
                    <form class=" text-left space-y-7" method="post"
                        action="{{ route('register', ['locale' => session('locale')]) }}">
                        @csrf

                        {{-- Title --}}
                        {{-- <div class="flex  flex-col gap-2">
                            <div class="input-box-wrapper ">
                                <select class="dob-dropdown input-box ps-2 pe-2 text-grey-border3" name="title" id="tile">
                                    <option selected disabled>@lang('Title') </option>
                                    @foreach ($titles as $title)
                                        <option @if (old('title') == $title) selected @endif
                                            value="{{ $title }}">
                                            {{ $title }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div> --}}

                        {{-- Full name  --}}
                        <div class="flex  flex-col gap-2">
                            <div class="input-box-wrapper">
                                <input value="{{ old('fullName') }}" @if (Route::current()->getName() == 'register') autofocus @endif
                                    required type="text" id="fullName" name="fullName" class="input-box">
                                <label for="fullName" title="@lang('Enter full name')"></label>
                                <i class="icofont-id-card"></i>
                            </div>
                            @error('fullName')
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
                                    class="input-box" style="direction: ltr">
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
                                    class="input-box" style="direction: ltr">
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
                                    name="password" class="input-box">
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
                                    id="password_confirmation" name="password_confirmation" class="input-box">
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
                                    <input type="checkbox" id="policy" name="policy"
                                        class="input-box  w-5 h-5 p-0 rounded-sm text-main-700">
                                    <label for="policy"></label>
                                </div>


                                <label for="policy" class="text-xs">
                                    <span>@lang('Agree to')</span>
                                    <span class="underline cursor-pointer"
                                        data-open-modal='#privacy-policy'>@lang('privacy policy')</span>
                                    <span> @lang('and') </span>
                                    <span class="underline cursor-pointer"
                                        data-open-modal='#service-terms'>@lang('service terms')</span>
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
                            <button type="submit" class="btn-primary w-full">
                                @lang('Register')
                                {{-- <i class="icofont-ui-user text-xs ms-2 text-main-600"></i> --}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('script')

    {{-- ------------------ INPUT MASKS ------------------ --}}
    <script src="https://unpkg.com/imask"></script>
    <script>

        // MOBILE NUMBER LOGIN
        var loginMobileField = document.getElementById('login-mobile');
        var loginMobileOptions = {
            mask: '{966}500000000',
            lazy: true,
            placeholderChar : '_ '
        };
        var loginMobileMask = IMask(loginMobileField, loginMobileOptions);
        loginMobileField.addEventListener('focus', function() {
            loginMobileMask.updateOptions({
                lazy: false,
            });
        }, true);
        loginMobileField.addEventListener('blur', function() {
            loginMobileMask.updateOptions({
                lazy: true
            });
            // NEXT IS OPTIONAL
            if (!loginMobileMask.masked.rawInputValue) {
                loginMobileMask.value = '';
            }
        }, true);



        // DOCUMENT NUMBER LOGIN
        var documentLoginField = document.getElementById('login-nationalId');
        var documentLoginFieldOptions = {
            mask: '0000000000',
            lazy: true,
            placeholderChar : '_ '
        };
        var documentLoginMask = IMask(documentLoginField, documentLoginFieldOptions);

        documentLoginField.addEventListener('focus', function() {
            documentLoginMask.updateOptions({
                lazy: false,
            });
        }, true);
        documentLoginField.addEventListener('blur', function() {
            documentLoginMask.updateOptions({
                lazy: true
            });
            // NEXT IS OPTIONAL
            if (!documentLoginMask.masked.rawInputValue) {
                documentLoginMask.value = '';
            }
        }, true);

        // MOBILE NUMBER
        var mobileField = document.getElementById('mobile');
        var mobileOptions = {
            mask: '{966}500000000',
            lazy: true,
            placeholderChar : '_ '
        };
        var mobileMask = IMask(mobileField, mobileOptions);
        mobileField.addEventListener('focus', function() {
            mobileMask.updateOptions({
                lazy: false,
            });
        }, true);
        mobileField.addEventListener('blur', function() {
            mobileMask.updateOptions({
                lazy: true
            });
            // NEXT IS OPTIONAL
            if (!mobileMask.masked.rawInputValue) {
                mobileMask.value = '';
            }
        }, true);


        //DOB
        //     year
        var yearField = document.getElementById('year');
        var yearOptions = {
            mask: '0000',
            lazy: true,
            placeholderChar : '_ '
        };
        var yearMask = IMask(yearField, yearOptions);

        yearField.addEventListener('focus', function() {
            yearMask.updateOptions({
                lazy: false,
            });
        }, true);
        yearField.addEventListener('blur', function() {
            yearMask.updateOptions({
                lazy: true
            });
            // NEXT IS OPTIONAL
            if (!yearMask.masked.rawInputValue) {
                yearMask.value = '';
            }
        }, true);

        //     dropdown
        document.querySelectorAll('.dob-dropdown').forEach(dropdown => {
            //after revisting page on invalid validation -> dropdown is selected, thus color is dark
            if (dropdown.value != 'Day' && dropdown.value != 'Month') {
                dropdown.style.color = '#707070';
            }
            dropdown.addEventListener('change', () => {
                dropdown.style.color = '#707070';
            })
        });
    </script>


@endsection
