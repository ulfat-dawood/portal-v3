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
            <livewire:login/>

            <div class="hidden bg-grey-border2 w-[1px] my-14  relative lg:block">
                <div class="absolute text-sm bg-grey-bg1 text-grey-border3"
                    style="top:50%; left: 50%;  transform: translate(-50%, -50%);">@lang('or')</div>
            </div>

            <div class="blcok bg-grey-border2 h-[1px] my-6 w-full max-w-sm  relative lg:hidden">
                <div class="absolute text-sm bg-grey-bg1 text-grey-border3 px-1"
                    style="top:50%; top: 50%;left: 50%;  transform: translate(-50%, -50%);">or</div>
            </div>

            <livewire:registration/>

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
            mask: '{9665}00000000',
            lazy: true,
            placeholderChar : '_ '
        };
        var loginMobileMask = IMask(loginMobileField, loginMobileOptions);
        loginMobileField.addEventListener('focus', function() {
            loginMobileMask.updateOptions({
                lazy: false,
            });
        }, true);
        // loginMobileField.addEventListener('blur', function() {
        //     loginMobileMask.updateOptions({
        //         lazy: true
        //     });
        //     NEXT IS OPTIONAL
        //     if (!loginMobileMask.masked.rawInputValue) {
        //         loginMobileMask.value = '';
        //     }
        // }, true);



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
