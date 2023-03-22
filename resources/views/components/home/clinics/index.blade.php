    <!-- CLINICS (start) -->
    <section id="clinics" class="mt-28">
        <div class="container">

            <!-- title  -->
            <h2 class="text-grey-text1 text-lg text-center mb-8">@lang('Find doctors by speciality')</h2>

            <!-- Slider -->
            <div class="parners-swiper-container relative">
                <div class="swiper clinics w-11/12 m-auto pb-1">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($clinics as $clinic)
                            <x-home.clinics.clinic-card :clinic="$clinic"/>
                        @endforeach
                    </div>
                </div>
                <!-- navigation buttons -->
                <div class="swiper-button-prev clinics !hidden md:!flex"></div>
                <div class="swiper-button-next clinics !hidden md:!flex"></div>
                <!-- pagination -->
                <div class="swiper-pagination clinics "></div>
            </div>
        </div>
    </section>
    <!-- CLINICS (end) -->
