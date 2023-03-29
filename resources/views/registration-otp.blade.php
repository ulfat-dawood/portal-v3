    @extends('layout.master')
@section('title', __('Login'))



@section('content')
    <div class=" min-h-screen">
        <div
            class="my-12 flex  justify-center items-center gap-x-10  lg:items-stretch">

            <div class="w-full max-w-sm ">
                <div class="box px-5 py-7">
                    <h2>@lang('Enter OTP to complete registration')</h2>
                    <form class=" text-left space-y-7" method="post" action="{{ route('registration-otp',[ 'locale' => session('locale')]) }}">

                        @csrf

                        <div class="flex  flex-col gap-2">

                            {{-- OTP Field --}}
                            <div class="input-box-wrapper">
                                <input autofocus required type="text"
                                    id="registartionOtp" name="registrationOtp" class="input-box">
                                <label for="registartionOtp" title="@lang('OTP')"></label>
                                <i class="icofont-ui-messaging"></i>
                            </div>
                            @error('loginNationalId')
                                <span class="text-secondary-300 text-xs break-words"><i
                                        class="icofont-warning-alt text-secondary-300"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="flex  flex-col gap-2">

                            {{-- Mobile Field --}}
                            <div class="input-box-wrapper">
                                <input autofocus required type="text"
                                    id="mobile" name="mobile" class="input-box">
                                <label for="mobile" title="@lang('Mobile No.')"></label>
                                <i class="icofont-mobile-phone"></i>
                            </div>
                            @error('otp')
                                <span class="text-secondary-300 text-xs break-words"><i
                                        class="icofont-warning-alt text-secondary-300"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn-primary w-full">
                                @lang('Confirm')
                            </button>
                        </div>

                    </form>
                </div>
            </div>




        </div>
    </div>


@endsection


