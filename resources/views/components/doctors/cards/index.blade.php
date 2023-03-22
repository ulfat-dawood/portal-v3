<div class="flex-grow">

    <!-- [filter-btn] for mobile -->
    {{-- <div class="flex justify-between mb-2 lg:justify-end mx-2 sm:mx-auto">

        <!-- filter  -->
        <div data-open-modal="#search"
            class="box px-1 cursor-pointer hover:bg-grey-bg1 lg:hidden">
            <i class="icofont-filter text-xs text-grey-border3"></i>
            <span class="text-xs text-grey-border3">@lang('Filters')</span>
        </div>
    </div> --}}


    <!-- cards  -->
    <div class="flex flex-col gap-10 mb-10">
        @forelse ($doctors as $doctor )
            <x-doctors.cards.card :doctor="$doctor"/>
        @empty
            <p class="text-center">
                @lang('No matching search results please use a different search keyword.')
            </p>
        @endforelse
    </div>


    @if(count($doctors) != 0)
        <!-- Pagination  -->
        <x-doctors.cards.pagination totalPages="{{$totalPages}}" pageNumber="{{$pageNumber}}"/>
    @endif


</div>
