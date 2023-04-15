<!-- PROFILE  -->
<div class="modal-box" id="profile">
    <header class="modal-header">
            @lang('Account')

        <div class="close-modal" data-close-modal='#profile'> <i class="icofont-close"></i> </div>
    </header>

    <div class="modal-content">

        @if(App\Models\Account::isLoggedin())
            <ul class="bg-white  p-3 space-y-2 rounded-lg mt-5 ">

                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-4 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 1]) }}">
                        <i class="icofont-ui-calendar"></i>
                        <div class=""> @lang('Upcoming Appointments')</div>
                    </a>
                </li>
                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-4 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 1]) }}">
                        <i class="icofont-history"></i>
                        <div class=""> @lang('Past visits')</div>
                    </a>
                </li>
                <li class=" bg-grey-bg1 rounded-lg hover:bg-grey-bg2">
                    <a href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 3]) }}"
                        class="py-3 px-5 flex items-center justify-center gap-5">
                        <div
                            class="h-8 w-8 flex-shrink-0 bg-grey-border2 ring-4 ring-grey-border1 rounded-full flex justify-center items-center ">
                            <i class="icofont-user-alt-7 text-grey-border1"></i>
                        </div>
                        <div class="text-grey-text1 text-sm whitespace-nowrap">
                            @if (session('locale') == 'ar')
                                ملف
                                {{ session('user')['name'] }}
                            @else
                                {{ ucwords(strtolower(session('user')['name'])) }}'s Profile
                            @endif
                        </div>
                    </a>
                </li>
                <li class="text-grey-text1 text-sm  rounded-lg hover:bg-grey-bg1">
                    <a href="{{ route('logout', ['locale' => session('locale')]) }}"
                        class="py-3 px-5 block whitespace-nowrap text-center"> @lang('Logout') <i
                            class="icofont-logout text-grey-text1"></i></a>
                </li>
            </ul>
        @else
            <ul class="bg-white  p-3 space-y-2 rounded-lg mt-5 ">

                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-4 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('login', ['locale' => session('locale')]) }}">
                        <i class="icofont-login"></i>
                        <div class=""> @lang('Login')</div>
                    </a>
                </li>

                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                    <a class="py-4 px-5 text-sm justify-center flex gap-2"
                        href="{{ route('register', ['locale' => session('locale')]) }}">
                        <i class="icofont-ui-user"></i>
                        <div class=""> @lang('Register')</div>
                    </a>
                </li>

            </ul>
        @endif

    </div>
</div>
