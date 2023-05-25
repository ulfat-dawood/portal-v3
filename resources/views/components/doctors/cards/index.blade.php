<div class="flex-grow">

    <!-- cards  -->
    <div class="flex flex-col gap-10 mb-10">
        @forelse ($doctors as $doctor)
            <x-doctors.cards.card :doctor="$doctor"  apptType="{{$apptType}}" />
        @empty
            <p class="text-center">
                @lang('No matching search results please use a different search keyword.')
            </p>
        @endforelse
    </div>

    <!-- Pagination  -->
    {{-- @if (count($doctors) != 0)
        <x-doctors.cards.pagination totalPages="{{ $totalPages }}" pageNumber="{{ $pageNumber }}" />
    @endif --}}

</div>
