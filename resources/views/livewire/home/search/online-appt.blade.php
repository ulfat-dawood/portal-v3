<div>
    <form action="">
        <div class="flex flex-col pt-10 gap-5">

            {{-- CLINIC DROPDOWN   --}}
            <select name="clinic" data-placeholder="@lang('Select speciality')"
                class="search-dropdown-online-appt rounded-b-lg flex-grow bg-grey-bg2 rounded-lg py-2 px-3">
                {{-- placeholder --}}
                <option value="">@lang('Select speciality')</option>
                @foreach ($clinics as $clinic)
                    <option value="{{ $clinic['CLINIC_ID'] }}" data-display="{{ $clinic['CLINIC_NAME'] }}">
                        {{ $clinic['CLINIC_NAME'] }}

                    </option>
                @endforeach

            </select>

            <button type="submit"
                class=" self-center bg-main-600 py-2 px-5 mt-3 rounded-lg text-grey-bg2 hover:bg-main-500">
                @lang('Book an online appointment')
                <i class="icofont-search-1 text-grey-bg2 me-3"></i>
            </button>
        </div>
    </form>



    <!-- Tom Select  -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
    <script>

        //Translate the terms of Tom Select:
        var terms = {
            add: 'Search for ',
            noResult: 'No results'
        };
        var locale = document.getElementsByTagName("html")[0].getAttribute("lang");
        if (locale == 'ar') {
            terms.add = 'البحث عن';
            terms.noResult = 'لا توجد نتائج';
        }

        //Clinics
        let searchDropdownSetting = {
            sortField: {
                field: "text",
                direction: "asc",
            },
            render: {

                option: function(data, escape) {
                    return `<div class="flex justify-start gap-2 items-center">
                        <span class="nxn-${escape(data.icon)}  text-main-600 w-3"></span>
                        <span> ${escape(data.display)} </span>
                    </div>`;
                },
                no_results: function(data, escape) {
                    return `<div class="p-1">${terms.noResult}</div>`;
                },
                //displayed inside the box as:
                // item: function (data, escape) {
                //     return `<div>  ${escape(data.display)}  </div>`;
                // }
            }
        }
        document.querySelectorAll('.search-dropdown-online-appt').forEach(item => {
            new TomSelect(item, searchDropdownSetting);
        });

    </script>
</div>
