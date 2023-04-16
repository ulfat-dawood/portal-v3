<!-- PROFILE  -->
<div class="modal-box" id="profile">
    <header class="modal-header">
        @lang('Account')

        <div class="close-modal" data-close-modal='#profile'> <i class="icofont-close"></i> </div>
    </header>

    <div class="modal-content">

        @if (App\Models\Account::isLoggedin())
            <ul class="bg-white  p-3 space-y-2 rounded-lg ">

                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-5 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 1]) }}">
                        <i class="icofont-ui-calendar"></i>
                        <div class=""> @lang('Upcoming Appointments')</div>
                    </a>
                </li>
                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-5 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 1]) }}">
                        <i class="icofont-history"></i>
                        <div class=""> @lang('Past visits')</div>
                    </a>
                </li>
                <li class=" bg-grey-bg1 rounded-lg hover:bg-grey-bg2">
                    <a href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 3]) }}"
                        class="py-3 px-5 flex items-center justify-center gap-5">
                        <div>
                            <i class="icofont-info-square"></i>
                        </div>
                        <div class="text-grey-text1 text-sm whitespace-nowrap">
                            @lang('Account info')
                        </div>
                    </a>
                </li>
                {{-- <li class="text-grey-text1 text-sm  rounded-lg hover:bg-grey-bg1">
                    <a href="{{ route('logout', ['locale' => session('locale')]) }}"
                        class="py-3 px-5 block whitespace-nowrap text-center">
                        <i class="icofont-logout text-secondary-400"></i>
                        <div class="text-secondary-400">@lang('Logout')</div>
                    </a>
                </li> --}}
            </ul>
        @else
            <ul class="bg-white  p-3 space-y-2 rounded-lg ">

                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-5 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('login', ['locale' => session('locale')]) }}">
                        <i class="icofont-login"></i>
                        <div class=""> @lang('Login')</div>
                    </a>
                </li>

                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-5 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('register', ['locale' => session('locale')]) }}">
                        <i class="icofont-ui-user"></i>
                        <div class=""> @lang('Register')</div>
                    </a>
                </li>

            </ul>
        @endif

    </div>
</div>
