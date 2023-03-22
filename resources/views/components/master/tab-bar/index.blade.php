    <!-- TAB BAR (start) -->
    <section id="tabbar" class="z-50 fixed left-[10px] right-[10px] bottom-[5px] bg-main-700 rounded-lg lg:hidden">
        <nav class="flex justify-around p-3">

            <a href="{{route('home' , ['locale' => session('locale')])}}" class="
            @if (Route::current()->getName() == 'home') bg-main-600 @endif
            flex flex-col items-center px-2 rounded-lg hover:bg-main-600">
               <div><i class="icofont-ui-home text-main-200 text-lg"></i></div>
               <div class="text-main-200 text-xs">@lang('HOME')</div>
            </a>


            <div data-open-modal='#medical-file'
            class="
            @if (Route::current()->getName() == 'medical-file') bg-main-600 @endif
            flex flex-col items-center px-2 rounded-lg hover:bg-main-600">
               <div><i class="icofont-ui-folder text-main-200 text-lg"></i></div>
               <div class="text-main-200 text-xs">@lang('MEDICAL FILE')</div>
            </div>

            <div data-open-modal='#search'
            class="
            @if (Route::current()->getName() == 'doctors') bg-main-600 @endif
            flex flex-col items-center px-2 rounded-lg hover:bg-main-600">
               <div><i class="icofont-search-1 text-main-200 text-lg"></i></div>
               <div class="text-main-200 text-xs">@lang('SEARCH')</div>
            </div>

            <div data-open-modal='#profile'
            class="
            @if (Route::current()->getName() == 'profile') bg-main-600 @endif
            flex flex-col items-center px-2 rounded-lg hover:bg-main-600">
               <div><i class="icofont-ui-user text-main-200 text-lg"></i></div>
               <div class="text-main-200 text-xs">@lang('PROFILE')</div>
            </div>


        </nav>
    </section>
    <!-- TAB BAR (end) -->
