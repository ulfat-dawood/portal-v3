<section id="banner" class="">
    <div class="banner-wrapper" style="background-image: url({{ asset('assets/images/banner.jpg') }})">
        <div class="m-auto flex  flex-col-reverse  pb-10  w-12/12  lg:flex-row lg:w-11/12 2xl:w-10/12">

            {{-- START SECTION  --}}
            <div class=" w-1/3 flex items-center justify-end">
                <div class="">
                    <h2>
                        <div class="text-2xl text-center lg:text-start">@lang('Find your doctor')</div>
                        <div class="text-4xl mt-2 text-center lg:text-start">
                            @lang('And')
                            <span class="text-main-600">@lang('book')</span>
                            @lang('an appointment now')
                        </div>
                    </h2>
                </div>
            </div>

            {{-- END SECTION  --}}
            <div class=" w-2/3 flex items-center justify-center">
                {{-- translucent background  --}}
                <div class=" bg-[#ffffffa9] p-10 rounded-b-lg">

                    {{-- {{dd(['cities'=> $cities, 'clinics'=>$clinics])}} --}}

                    <livewire:home.search.index :cities="$cities" :clinics="$clinics">

                </div>

            </div>
        </div>
    </div>
</section>
