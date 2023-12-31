<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if (session('locale') == 'en') dir="ltr"
@else
dir="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--------------------------- Libraries (start)  --------------------------------->
    <!-- tom select  -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">
    <!-- Swiper JS  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!--------------------------- Libraries (end)  --------------------------------->

    <!-- Vite  -->
    @vite(['resources/css/style.scss'])
    @vite(['resources/css/app.css'])

    <!-- Template  -->
    <title>@yield('title') - {{ __('Athir Care') }}</title>
    @yield('style')
    @yield('head-script')

    <!-- Livewire  -->
    <livewire:styles />

</head>

<body class="bg-grey-bg1 overflow-scroll">
    @include('layout.flash-messages')

    <x-master.tab-bar />
    <x-master.tab-bar.medical-file />
    {{-- <x-master.tab-bar.search /> --}}
    <x-master.tab-bar.account />
    <x-master.tab-bar.dependents />
    @yield('modal')

    <x-master.navbar />
    <x-master.navbar.sidebar />

    <x-master.body-content>
        @yield('content')
    </x-master.body-content>

    <x-master.footer />


    <!-- Livewire  -->
    <livewire:scripts />


    <!--------------------------- Libraries (start)  --------------------------------->
    <!-- Tom Select  -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
    <!-- Swiper JS  -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!--------------------------- Libraries (end)  --------------------------------->
    
    <!-- Template  -->
    @yield('script')

    <!-- Vite  -->
    @vite(['resources/js/app.js'])


    <!-- Close Toast Msg  -->
    <script>
        const closeToast = (element) => {
            console.log(element.parentElement);
            element.parentElement.classList.add('slideDown');
            setTimeout(() => {
                element.parentElement.classList.add('hide');
            }, 5500)
        }
    </script>


</body>

</html>
