<section id="navbar" class="sticky top-0 z-20 box rounded-none flex h-16 justify-between items-center md:px-10">

    <!-- LOGO  -->
    <x-master.navbar.logo />

    {{-- <p>session({{ session('locale') }}) app({{ app()->getLocale() }})</p> --}}

    <!-- SEARCH BAR -->
    @if (Route::current()->getName() != 'home' && Route::current()->getName() != 'doctors')
        {{-- <x-master.navbar.search /> --}}
    @endif

    <!-- CTA -->
    <div id="cta" class="flex gap-5 items-center">

        @if (App\Models\Account::isLoggedin())
            <!--If is logged in, then display: MF + USER + HOME -->
            <div class="hidden gap-5 items-center lg:flex">



                <div id="user-btn-wrapper" class="relative group">
                    <div class="user-profile relative text-grey-text1 bg-grey-bg2 rounded-full  p-3.5 hover:bg-grey-border1 group-hover:bg-grey-border1 select-none cursor-pointer">
                        <i class="icofont-ui-user text-xs absolute" style='top:50%; left: 50%;  transform: translate(-50%, -50%);'></i>
                    </div>

                    <div id="user-options-dropdown" class="absolute bottom-[-290px] left-[50%] translate-x-[-50%] hidden w-52 group-hover:block ">
                        <ul class="bg-white border border-grey-border1 p-3 space-y-2 rounded-lg mt-5 ">
                            <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                <a class="py-3 px-3 text-sm items-center justify-center flex gap-2" href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 1]) }}">
                                    <i class="icofont-ui-calendar"></i>
                                    <div class=""> @lang('Upcoming Appointments')</div>
                                </a>
                            </li>
                            <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                <a class="py-3 px-3 text-sm items-center justify-center flex gap-2" href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 2]) }}">
                                    <i class="icofont-history"></i>
                                    <div class=""> @lang('Past visits')</div>
                                </a>
                            </li>
                            <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                <a class="py-3 px-3 text-sm items-center justify-center flex gap-2" href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 3]) }}">
                                    <i class="icofont-location-pin"></i>
                                    <div class=""> @lang('Manage Addresses')</div>
                                </a>
                            </li>
                            <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                <a class="py-3 px-3 text-sm items-center justify-center flex gap-2" href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 4]) }}">
                                    <i class="icofont-info-square"></i>
                                    <div class=""> @lang('Account info')</div>
                                </a>
                            </li>
                            <li class="text-grey-text1 text-sm  rounded-lg hover:bg-grey-bg1">
                                <a href="{{ route('logout', ['locale' => session('locale')]) }}" class="py-3 px-5 whitespace-nowrap flex gap-2 justify-center">
                                    <i class="icofont-logout text-grey-text1"></i>
                                    <div class="">@lang('Logout')</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if (Route::current()->getName() != 'home')
                    <div class=" text-grey-text1 bg-grey-bg2 rounded-full hover:bg-grey-border1 relative cursor-pointer">
                        <a href="{{ route('home', ['locale' => session('locale')]) }}" class="block p-3.5">
                            <i class="icofont-ui-home text-xs absolute" style='top:50%; left: 50%;  transform: translate(-50%, -50%);'></i>
                        </a>
                    </div>
                @endif

            </div>
        @else
            <!--If NOT logged in, then display:
            MF + login + register -->
            <div class="hidden gap-5 items-center lg:flex">
                {{-- LOGIN/REGISTER  --}}
                @if (Route::current()->getName() != 'login' || Route::current()->getName() != 'register')
                    <div class=" text-sm ">
                        <a href="{{ route('login', ['locale' => session('locale')]) }}" class="block p-1 hover:underline">
                            @lang('Login')
                        </a>
                    </div>

                    <div class=" text-sm text-white bg-secondary-300 rounded-full hover:bg-secondary-400">
                        <a href="{{ route('register', ['locale' => session('locale')]) }}" class="block py-1 px-3 font-semibold tracking-wide">
                            @lang('Register')
                        </a>
                    </div>
                @endif

                @if (Route::current()->getName() != 'home')
                    <div class=" text-grey-text1 bg-grey-bg2 rounded-full hover:bg-grey-border1 relative cursor-pointer">
                        <a href="{{ route('home', ['locale' => session('locale')]) }}" class="block p-3.5">
                            <i class="icofont-ui-home text-xs absolute" style='top:50%; left: 50%;  transform: translate(-50%, -50%);'></i>
                        </a>
                    </div>
                @endif

            </div>

        @endif
        <div id="open-sidebar" class="user-profile text-grey-text1  rounded-full  py-2 px-3 hover:bg-grey-bg2 cursor-pointer">
            <i class="icofont-navigation-menu"></i>
        </div>
    </div>
</section>
