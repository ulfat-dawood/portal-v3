<div class="flex justify-center">
    <div class="box max-w-xl w-full mt-10 overflow-hidden">
        <div class="bg-main-600 text-white text-xs text-center py-2 font-semibold">@lang('USER PROFILE')</div>

        <form action="" class="p-4 space-y-4 md:p-7 md:space-y-7">

            {{-- Name  --}}
            <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                <div class="w-40 shrink-0 grow-0 text-xs">@lang('Name')</div>

                <div class="input-box-wrapper w-full">
                    <div class="input-box">
                        {{ session('user')['name'] }}
                    </div>
                    <i class="text-sm icofont-ui-user"></i>
                </div>

            </div>


            {{-- Mobile Number  --}}
            <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                <div class="w-40 shrink-0 grow-0 text-xs">@lang('Mobile No.')</div>

                <div class="input-box-wrapper w-full">
                    <div class="input-box">{{ session('user')['phone'] }}</div>
                    <i class="text-sm icofont-mobile-phone"></i>
                </div>

            </div>


            {{-- Email  --}}
            <div class="flex justify-start items-start flex-col md:flex-row md:items-center">

                <div class="w-40 shrink-0 grow-0 text-xs">@lang('Email')</div>

                <div class="input-box-wrapper w-full">
                    <div class="input-box">{{ session('user')['email'] }}</div>
                    <i class="text-sm icofont-ui-email"></i>
                </div>

            </div>


        </form>
    </div>
</div>
