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

                @if (Route::current()->getName() != 'medical-file')
                    <div id="medical-file-btn-wrapper" class="relative group">
                        <div id="medical-file-btn">
                            <div
                                class="bg-secondary-100 text-secondary-300 py-1 px-8 rounded-full font-light cursor-pointer hover:bg-secondary-200 group-hover:bg-secondary-200
                                    select-none text-sm">
                                @lang('Medical file')
                                <i class="icofont-arrow-right inline text-secondary-300 group-hover:hidden"></i>
                                <i class="icofont-arrow-down  hidden text-secondary-300 group-hover:inline"></i>
                            </div>
                            <!-- divide-y divide-grey-border1 -->
                            <div id="medical-file-dowpdown"
                                class="absolute w-60  bottom-[-250px] left-[50%] translate-x-[-50%]  hidden group-hover:block">
                                <ul
                                    class="flex flex-col gap-2 bg-white border border-grey-border1 rounded-lg  overflow-hidden mt-5 p-3">

                                    <li
                                        class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                        <a class="py-2 px-5 text-sm text-center block"
                                            href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 3]) }}">
                                            @lang('Sick leaves')
                                        </a>
                                    </li>
                                    <li
                                        class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                        <a class="py-2 px-5 text-sm text-center block"
                                            href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 4]) }}">
                                            @lang('Prescriptions')
                                        </a>
                                    </li>
                                    <li
                                        class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                        <a class="py-2 px-5 text-sm text-center block"
                                            href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 5]) }}">
                                            @lang('Radiology')
                                        </a>
                                    </li>
                                    <li
                                        class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                        <a class="py-2 px-5 text-sm text-center block"
                                            href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 6]) }}">
                                            @lang('Lab tests')
                                        </a>
                                    </li>
                                    <li
                                        class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                        <a class="py-2 px-5 text-sm text-center block"
                                            href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 7]) }}">
                                            @lang('Medical reports')
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                @endif

                <div id="user-btn-wrapper" class="relative group">
                    <div
                        class="user-profile relative text-grey-text1 bg-grey-bg2 rounded-full  p-3.5 hover:bg-grey-border1 group-hover:bg-grey-border1 select-none cursor-pointer">
                        <i class="icofont-ui-user text-xs absolute"
                            style='top:50%; left: 50%;  transform: translate(-50%, -50%);'></i>
                    </div>

                    <div id="user-options-dropdown"
                        class="absolute bottom-[-233px] left-[50%] translate-x-[-50%] hidden  group-hover:block ">
                        <ul class="bg-white border border-grey-border1 p-3 space-y-2 rounded-lg mt-5 ">
                            <li class=" bg-grey-bg1 rounded-lg hover:bg-grey-bg2">
                                <a href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 3]) }}"
                                    class="py-3 px-5 flex items-center gap-5">
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
                            <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                <a class="py-2 px-5 text-sm text-center block"
                                    href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 1]) }}">
                                    @lang('Upcoming Appointments')
                                </a>
                            </li>
                            <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                <a class="py-2 px-5 text-sm text-center block"
                                    href="{{ route('account', ['locale' => session('locale'), 'tabNo' => 2]) }}">
                                    @lang('Past visits')
                                </a>
                            </li>
                            <li class="text-grey-text1 text-sm  rounded-lg hover:bg-grey-bg1">
                                <a href="{{ route('logout', ['locale' => session('locale')]) }}"
                                    class="py-3 px-5 block whitespace-nowrap"> @lang('Logout') <i
                                        class="icofont-logout text-grey-text1"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if (Route::current()->getName() != 'home')
                    <div
                        class=" text-grey-text1 bg-grey-bg2 rounded-full hover:bg-grey-border1 relative cursor-pointer">
                        <a href="{{ route('home', ['locale' => session('locale')]) }}" class="block p-3.5">
                            <i class="icofont-ui-home text-xs absolute"
                                style='top:50%; left: 50%;  transform: translate(-50%, -50%);'></i>
                        </a>
                    </div>
                @endif

            </div>
        @else
            <!--If NOT logged in, then display:
            MF + login + register -->
            <div class="hidden gap-5 items-center lg:flex">
                <div id="medical-file-btn-wrapper" class="relative group">
                    <div id="medical-file-btn">
                        <div class=" text-grey-text1 rounded-full font-light cursor-default">
                            <span
                                class="group-hover:underline cursor-pointer select-none text-sm">@lang('Medical file')</span>
                            <i class="icofont-arrow-right text-sm inline  group-hover:hidden"></i>
                            <i class="icofont-arrow-down text-sm  hidden  group-hover:inline"></i>
                        </div>
                        <!-- divide-y divide-grey-border1 -->
                        <div id="medical-file-dowpdown"
                            class="absolute w-60  bottom-[-250px] left-[50%] translate-x-[-50%]  hidden group-hover:block">
                            <ul
                                class="flex flex-col gap-2 bg-white border border-grey-border1 rounded-lg  overflow-hidden mt-5 p-3">

                                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                    <a class="py-2 px-5 text-sm text-center block"
                                        href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 3]) }}">
                                        @lang('Sick leaves')
                                    </a>
                                </li>
                                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                    <a class="py-2 px-5 text-sm text-center block"
                                        href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 4]) }}">
                                        @lang('Prescriptions')
                                    </a>
                                </li>
                                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                    <a class="py-2 px-5 text-sm text-center block"
                                        href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 5]) }}">
                                        @lang('Radiology')
                                    </a>
                                </li>
                                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                    <a class="py-2 px-5 text-sm text-center block"
                                        href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 6]) }}">
                                        @lang('Lab tests')
                                    </a>
                                </li>
                                <li class=" text-grey-text1 bg-grey-bg1 rounded-lg hover:bg-grey-bg2 cursor-pointer">
                                    <a class="py-2 px-5 text-sm text-center block"
                                        href="{{ route('home', ['locale' => session('locale'), 'tabNo' => 7]) }}">
                                        @lang('Medical reports')
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                {{-- LOGIN/REGISTER  --}}
                @if (Route::current()->getName() != 'login' || Route::current()->getName() != 'register')
                    <div class=" text-sm ">
                        <a href="{{ route('login', ['locale' => session('locale')]) }}"
                            class="block p-1 hover:underline">
                            @lang('Login')
                        </a>
                    </div>

                    <div class=" text-sm text-white bg-secondary-300 rounded-full hover:bg-secondary-400">
                        <a href="{{ route('register', ['locale' => session('locale')]) }}"
                            class="block py-1 px-3 font-semibold tracking-wide">
                            @lang('Register')
                        </a>
                    </div>
                @endif

                @if (Route::current()->getName() != 'home')
                    <div
                        class=" text-grey-text1 bg-grey-bg2 rounded-full hover:bg-grey-border1 relative cursor-pointer">
                        <a href="{{ route('home', ['locale' => session('locale')]) }}" class="block p-3.5">
                            <i class="icofont-ui-home text-xs absolute"
                                style='top:50%; left: 50%;  transform: translate(-50%, -50%);'></i>
                        </a>
                    </div>
                @endif

            </div>

        @endif
        <div id="open-sidebar"
            class="user-profile text-grey-text1  rounded-full  py-2 px-3 hover:bg-grey-bg2 cursor-pointer">
            <i class="icofont-navigation-menu"></i>
        </div>
    </div>
</section>
