<div class="container xl:px-[9vw]">

    <div class="flex gap-10 my-5 items-stretch h-[75vh] lg:my-10 lg:h-auto">
        <!-- MF - MENU  -->
        <div class="basis-4/12 box hidden lg:block">
            <!-- patient name  -->
            <div class="flex items-center gap-5 bg-grey-bg1 rounded-lg py-3 px-5 m-3">
                <div
                    class="h-8 w-8 flex-shrink-0 bg-grey-border2 ring-4 ring-grey-border1 rounded-full flex justify-center items-center ">
                    <i class="icofont-user-alt-7 text-grey-border1"></i>
                </div>
                <div class="text-grey-text1 text-sm">
                    @if (session('locale') == 'ar')
                        ملف
                        {{ ucwords(strtolower(session('user')['patientName1b'])) }}
                        الطبي
                    @else
                        {{ ucwords(strtolower(session('user')['patientName1'])) }}'s <br> e-Medical File
                    @endif
                </div>
            </div>
            <h1 class="m-5 text-ls text-red-600">{{ $test }}</h1>
            <!-- menu items  -->
            <ul class="flex flex-col gap-8 pt-5 pb-10 pe-3">
                @foreach ($tabs as $key => $tab)
                    <li>
                        <div wire:click='selectTab({{ $selectedTab == $key ? 0 : $key }})'
                            class=" flex gap-5 justify-start mf-tab
                            @if ($selectedTab == $key) active @endif">
                            <i class="icofont-{{ $tab['icon'] }}"></i>
                            <span class="text-xs font-normal ">{{ $tab['title'] }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>

        <!-- MF - CONTENT  -->
        <div class="basis-full box flex flex-col p-1.5 sm:3 md:p-5 lg:p-10 rounded-none sm:rounded-lg">
            <!-- TITLE  -->
            <h2 class="mb-5 text-sm flex-shrink-0 flex-grow-0  text-center md:text-start ">
                {{ $tabs[$selectedTab]['title'] }}</h2>

            <!-- CONTENT  -->
            <div class="flex-grow relative">
                <!-- FIXED CONTETN WRAPPER  -->
                <div id="MF-FILE-CONTENT" class=" absolute left-0 right-0 top-0 bottom-0 overflow-y-auto">
                    @switch($selectedTab)
                        @case(1)
                            <livewire:patient.medical-file.coming-appointments :patintDocument="session('user')['documentNumber']">
                            @break

                            @case(2)
                                <livewire:patient.medical-file.past-visits :patintDocument="session('user')['documentNumber']">
                                @break

                                @case(3)
                                    <livewire:patient.medical-file.sick-leaves :patintDocument="session('user')['documentNumber']">
                                    @break

                                    @case(4)
                                        <livewire:patient.medical-file.prescriptions :patintDocument="session('user')['documentNumber']">
                                        @break

                                        @case(5)
                                            <livewire:patient.medical-file.raiology :patintDocument="session('user')['documentNumber']">
                                            @break

                                            @case(6)
                                                <livewire:patient.medical-file.labs :patintDocument="session('user')['documentNumber']">
                                                @break

                                                @case(7)
                                                    <livewire:patient.medical-file.medical-reports :patintDocument="session('user')['documentNumber']">
                                                    @break

                                                    @default
                                                        <livewire:patient.medical-file.coming-appointments :patintDocument="session('user')['documentNumber']">
                                                    @endswitch

                </div>
            </div>
        </div>

    </div>

</div>
