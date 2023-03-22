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
                    <li class="text-grey-bg1 bg-main-500 rounded py-2 w-64 px-3 cursor-pointer hover:bg-main-400"><span
                            class="arrow text-grey-bg1"> &lt; </span> @lang('Clinics') </li>
                    <li class="text-grey-bg1 bg-main-500 rounded py-2 w-64 px-3 cursor-pointer hover:bg-main-400">
                        @lang('Contact us')</li>
                    <li class="text-grey-bg1 bg-main-500 rounded py-2 w-64 px-3 cursor-pointer hover:bg-main-400">@lang('FAQ')
                    </li>
                    <li class="text-grey-bg1 bg-main-500 rounded py-2 w-64 px-3 cursor-pointer hover:bg-main-400">@lang('About')
                        @lang('Athir')</li>
                </ul>
                <ul class="space-y-3">
                    {{-- <li class="text-xs text-grey-bg1">@lang('Site settings'):</li> --}}
                    <li class="text-grey-bg1">
                        <a
                            href="@if (session('locale') == 'en') {{ route('home', ['locale' => 'ar']) }} @else {{ route('home', ['locale' => 'en']) }} @endif">
                            <i class="icofont-globe text-grey-bg1"></i>
                            @if (session('locale') == 'en')
                                العربية
                            @else
                                English
                            @endif
                        </a>
                    </li>
                    {{-- <li class="text-grey-bg1"> <i class="icofont-location-pin text-grey-bg1"></i> @lang('Jeddah') <span
                            class="decoration-1 text-xs text-grey-bg1">(@lang('change'))</span> </li> --}}

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
