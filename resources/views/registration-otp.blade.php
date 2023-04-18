    @extends('layout.master')
@section('title', __('Login'))



@section('content')
    <div class=" min-h-screen">
        <div
            class="my-12 flex  justify-center items-center gap-x-10  lg:items-stretch">

            <div class="w-full max-w-sm ">
                <div class="box px-5 py-7">
                    <h2>@lang('Enter OTP to complete registration')</h2>
                    <form class=" text-left space-y-7" method="post" action="{{ route('register',[ 'locale' => session('locale')]) }}">

                        @csrf

                        {{-- OTP Field --}}
                        <div class="flex  flex-col gap-2">

                            <div class="input-box-wrapper">
                                <input autofocus required type="text"
                                    id="otp" name="registrationOtp" class="input-box">
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

                        {{-- Hidden Fields --}}
                        @foreach ($data as $key => $dataItem)
                            <input type="hidden" name="{{$key}}" value="{{$dataItem}}">
                        @endforeach

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


