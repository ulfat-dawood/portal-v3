<div class="modal-box" id="search">
    <header class="modal-header">
        <div class="title">Search portal</div>
        <div class="close-modal" data-close-modal='#search'> <i class="icofont-close"></i> </div>
    </header>

    <div class="modal-content">

        <form class="flex w-full flex-col gap-0.5 mt-10 md:flex-row h-12 " action="{{ route('home' ,['locale' => session('locale')]) }}">
            @csrf
            <select name="ClinicId"
                class="rounded-t-lg search-select flex-grow bg-grey-bg2 sm:rounded-t-none sm:rounded-s-lg "
                placeholder="Select clinic" autocomplete="off">

                {{-- placeholder --}}
                <option value="">Select clinic</option>

                @foreach ($clinics() as $clinic)
                    <option value="{{ $clinic['clinicId'] }}">{{ $clinic['clinicName'] }}</option>
                @endforeach
            </select>

            <select name="DoctorOrCenterName"
                class="rounded-b-lg search-select flex-grow bg-grey-bg2 sm:rounded-b-none"
                placeholder="Type dctor/hospital name" autocomplete="off">

                {{-- placeholder --}}
                <option value="">Type dctor/hospital name</option>

                <optgroup label="Centers">
                    @foreach ($centers() as $center)
                        <option value="{{ $center['centerId'] }}">{{ $center['centerName'] }}</option>
                    @endforeach
                    >
                </optgroup>
                <optgroup label="Doctors">
                    @foreach ($doctors() as $doctor)
                        <option value="{{ $doctor['doctorId'] }}">
                            {{ $doctor['doctorName1'] .
                                ' ' .
                                $doctor['doctorName2'] .
                                ' ' .
                                $doctor['doctorName3'] .
                                ' ' .
                                $doctor['doctorNameFamily'] }}
                        </option>
                    @endforeach
                    >
                </optgroup>
            </select>

            <button type="submit"
                class="text-xs flex-shrink-0 flex-grow-1 bg-main-600 px-3 py-3 mt-3 rounded-lg text-grey-bg2 md:mt-0 md:py-0 md:rounded-e-lg  md:rounded-s-none over:bg-main-500">
                <i class="icofont-search-1 text-grey-bg2"></i>
                Find doctor
            </button>
        </form>

        <div>
            <!-- title  -->
            <div class="font-normal p-5 pb-0">
                Filters
            </div>

            <!-- filters -->
            <ul class="divide-y-[0.5px] divide-grey-border1">
                <li class="py-3 px-5 space-y-2">
                    <div>
                        <i class="text-grey-text1 text-xs icofont-location-pin"></i>
                        <span class="text-grey-text1 text-xs">City</span>
                    </div>
                    <input placeholder="Jeddah" type="text"
                        class="w-full px-3 py-1 text-xs bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1">
                </li>

                <li class="py-3 px-5 space-y-2">
                    <div>
                        <i class="text-grey-text1 text-xs icofont-doctor"></i>
                        <span class="text-grey-text1 text-xs">Title</span>
                    </div>
                    <input placeholder="Jeddah" type="text"
                        class="w-full px-3 py-1 text-xs bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1">
                </li>

                <li class="py-3 px-5 space-y-2">
                    <div>
                        <i class="text-grey-text1 text-xs icofont-ui-calendar"></i>
                        <span class="text-grey-text1 text-xs">Appointment type</span>
                    </div>
                    <input placeholder="Online" type="text"
                        class="w-full px-3 py-1 text-xs bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1">
                </li>

                <li class="py-3 px-5 space-y-2">
                    <div>
                        <i class="text-grey-text1 text-xs icofont-safety"></i>
                        <span class="text-grey-text1 text-xs">Insurance</span>
                    </div>
                    <input placeholder="Bupa" type="text"
                        class="w-full px-3 py-1 text-xs bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1">
                </li>

                <li class="py-3 px-5 space-y-2">
                    <div>
                        <i class="text-grey-text1 text-xs icofont-male"></i>
                        <span class="text-grey-text1 text-xs">Gender</span>
                    </div>
                    <input placeholder="Male" type="text"
                        class="w-full px-3 py-1 text-xs bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1">
                </li>

                <li class="py-3 px-5 space-y-2">
                    <div>
                        <i class="text-grey-text1 text-xs icofont-bill"></i>
                        <span class="text-grey-text1 text-xs">Price range</span>
                    </div>
                    <input placeholder="No preference" type="text"
                        class="w-full px-3 py-1 text-xs bg-grey-bg2 hover:bg-grey-border1 rounded-lg focus:ring-2 focus:outline-none focus:ring-grey-border1">
                </li>


            </ul>

            <!-- submit button  -->
            <div class="p-5 space-y-3">
                <button type="submit" class="py-1 text-xs bg-main-600 w-full rounded-lg hover:bg-main-700">
                    <i class="text-main-50 text-xs icofont-verification-check"></i>
                    <span class="text-main-50 text-xs">Apply filters</span>
                </button>

                <button type="submit"
                    class="py-1 text-xs bg-secondary-100 w-full rounded-lg hover:bg-secondary-200 cursor-pointer">
                    <i class="text-secondary-300 text-xs icofont-ui-remove"></i>
                    <span class="text-secondary-300 text-xs font-normal">Clear filters</span>
                </button>
            </div>

        </div>

    </div>
</div>
