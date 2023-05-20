@extends('layout.master')
@section('title', __('Login'))

@section('modal')
    <x-common.privacy-policy />
    <x-common.service-terms />
@endsection
@section('content')
    <div class=" min-h-screen">
        <div class="my-12 flex  justify-center items-center gap-x-10  lg:items-stretch
        @if (Route::current()->getName() != 'login') flex-col-reverse lg:flex-row-reverse
        @else flex-col lg:flex-row @endif ">
            <livewire:login />
            <div class="hidden bg-grey-border2 w-[1px] my-14  relative lg:block">
                <div class="absolute text-sm bg-grey-bg1 text-grey-border3" style="top:50%; left: 50%;  transform: translate(-50%, -50%);">@lang('or')</div>
            </div>
            <div class="blcok bg-grey-border2 h-[1px] my-6 w-full max-w-sm  relative lg:hidden">
                <div class="absolute text-sm bg-grey-bg1 text-grey-border3 px-1" style="top:50%; top: 50%;left: 50%;  transform: translate(-50%, -50%);">or</div>
            </div>
            <livewire:registration />
        </div>
    </div>
@endsection
@section('script')
    {{-- ------------------ INPUT MASKS ------------------ --}}
    <script src="https://unpkg.com/imask"></script>
    <script>
        // MOBILE NUMBER LOGIN
        var loginMobileField = document.getElementById('login-mobile');
        var loginregistrationMobileOptions = {
            mask: '{9665}00000000',
            lazy: true,
            placeholderChar: '_ '
        };
        var loginMobileMask = IMask(loginMobileField, loginregistrationMobileOptions);
        loginMobileField.addEventListener('focus', function() {
            loginMobileMask.updateOptions({
                lazy: false,
            });
        }, true);


        // MOBILE NUMBER REGISTRATION
        var registrationMobileField = document.getElementById('registation-mobile');
        var registrationMobileOptions = {
            mask: '{966}500000000',
            lazy: true,
            placeholderChar: '_ '
        };
        var mobileMask = IMask(registrationMobileField, registrationMobileOptions);
        registrationMobileField.addEventListener('focus', function() {
            mobileMask.updateOptions({
                lazy: false,
            });
        }, true);




    </script>

@endsection
