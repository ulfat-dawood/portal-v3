    <!-- SIDEBAR (start)-->
    <div id="sidebar" {{-- class="translate-x-full transition-all z-50 fixed flex flex-col inset-y-0 -right-0 h-screen bg-main-600"> --}}
        class=" transition-all z-50 fixed flex flex-col inset-y-0 h-screen bg-main-600">
        <div id="sidebar-overlay" class=" hidden absolute bg-black opacity-30 bottom-0 top-0 w-screen z-10"></div>
        <div id="close-sidebar"
            class=" text-grey-bg1 text-3xl self-end m-5 cursor-pointer w-fit rounded-full px-2.5 transition-all hover:bg-main-500">
            &times; </div>
        <div class="flex flex-col flex-grow  overflow-y-auto">
            <div class="flex-grow space-y-10 mx-5 md:space-y-20">
                <ul class="space-y-3">

                    <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                        <a href="@if (session('locale') == 'en') {{ route('home', ['locale' => 'ar']) }} @else {{ route('home', ['locale' => 'en']) }} @endif"
                            class="flex items-center justify-start gap-3 py-2 px-3 ">
                            <i class="icofont-globe text-grey-bg1"></i>
                            <div class="text-grey-bg1"
                                @if (session('locale') == 'en') style="font-family: 'Tajawal', sans-serif;'">العربية
                                @else
                                    > English @endif
                                </div>
                        </a>
                    </li>

                    @if (App\Models\Account::isLoggedin())
                        <li>
                            <div class="text-white">@lang('Profile')</div>
                        </li>
                        <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                            <a href="{{ route('account', ['tabNo' => '1', 'locale' => session('locale')]) }}"
                                class="flex items-center justify-start gap-3 py-2 px-3 ">
                                <i class="icofont-ui-calendar text-grey-bg1"></i>
                                <div class="text-grey-bg1">@lang('Upcoming Appointments')</div>
                            </a>
                        </li>
                        <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                            <a href="{{ route('account', ['tabNo' => '2', 'locale' => session('locale')]) }}"
                                class="flex items-center justify-start gap-3 py-2 px-3 ">
                                <i class="icofont-history text-grey-bg1"></i>
                                <div class="text-grey-bg1">@lang('Past Visits')</div>
                            </a>
                        </li>
                        <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                            <a href="{{ route('account', ['tabNo' => '3', 'locale' => session('locale')]) }}"
                                class="flex items-center justify-start gap-3 py-2 px-3 ">
                                <i class="icofont-location-pin text-grey-bg1"></i>
                                <div class="text-grey-bg1">@lang('Manage Addresses')</div>
                            </a>
                        </li>
                        <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                            <a href="{{ route('account', ['tabNo' => '4', 'locale' => session('locale')]) }}"
                                class="flex items-center justify-start gap-3 py-2 px-3 ">
                                <i class="icofont-info-square text-grey-bg1"></i>
                                <div class="text-grey-bg1">@lang('Account info')</div>
                            </a>
                        </li>
                        <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                            <a href="{{ route('logout', ['locale' => session('locale')]) }}"
                                class="flex items-center justify-start gap-3 py-2 px-3 ">
                                <i class="icofont-logout text-grey-bg1"></i>
                                <div class="text-grey-bg1">@lang('Logout')</div>
                            </a>
                        </li>
                    @else
                        <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                            <a href="{{route('login', ['locale'=> session('locale')])}}"
                                class="flex items-center justify-start gap-3 py-2 px-3 ">
                                <i class="icofont-login text-grey-bg1"></i>
                                <div class="text-grey-bg1">@lang('Login')</div>
                            </a>
                        </li>
                        <li class=" bg-main-500 rounded w-64 cursor-pointer hover:bg-main-400">
                            <a href="{{route('register', ['locale'=> session('locale')])}}"
                                class="flex items-center justify-start gap-3 py-2 px-3 ">
                                <i class="icofont-ui-user text-grey-bg1"></i>
                                <div class="text-grey-bg1">@lang('Register')</div>
                            </a>
                        </li>

                    @endif

                </ul>

            </div>
            <ul class="flex justify-center gap-4 mt-10 p-3 bg-main-500">
                <li><i class="icofont-linkedin text-grey-bg1"></i></li>
                <li><i class="icofont-instagram text-grey-bg1"></i></li>
                <li><i class="icofont-facebook text-grey-bg1"></i></li>
            </ul>
        </div>
    </div>
    <!-- SIDEBAR (end)-->
