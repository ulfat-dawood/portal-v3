<div class="flex flex-col justify-center items-center h-full gap-5">

    <div class="text-sm bg-secondary-100 p-2  rounded-lg flex flex-col gap-2 items-start">

        <div class="flex flex-row gap-2 items-center">
            <i class="icofont-warning-alt text-secondary-400 text-sm"></i>
            <div class="text-secondary-400 font-bold ">
                @lang('The content cannot be displayed')
            </div>
        </div>

        <div class="rounded-lg bg-white p-3 text-xs text-grey-text1">
            @lang('Your account is not verified by Yaqeen'),
            @lang('Please verify your account to accesst medical file data').
        </div>

    </div>

    <a href="{{url('ar/new-wathig')}}" class=" flex items-center gap-2 btn-primary">
        <i class="icofont-ui-messaging text-main-600"></i>
        اضغط هنا للتوثيق
    </a>
{{--
    <form action="{{route('wathigSendOtp', ['locale'=> session('locale')])}}" method="post">
        @csrf
        <input type="hidden" id="userId" name="userId" value="{{session('user')['patientId']}}">
        <button type="submit" class=" flex items-center gap-2 btn-primary">
            <i class="icofont-ui-messaging text-main-600"></i>
            @lang('send verification OTP')
        </button>

    </form> --}}

</div>
