<div class="flex justify-center items-center gap-1 w-full">



    {{--  FIRST PAGE  --}}
    @if ($pageNumber == 1)
        {{-- diabled link  --}}
        <div class="px-4 py-2 border border-grey-border2 rounded-md cursor-not-allowed" >
            @lang('first')
        </div>
    @else
        <a href="{{ Request::fullUrlWithQuery(['PageNumber' => 1]) }}" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md">
            @lang('first')
        </a>
    @endif





    {{--  PREVIOUS PAGE  --}}
    @if ($pageNumber == 1)
        {{-- diabled link  --}}
        <div class="px-4 py-2 border border-grey-border2 rounded-md cursor-not-allowed" >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </div>
    @else
        {{-- enabled link --}}
        <a href="{{ Request::fullUrlWithQuery(['PageNumber' => $pageNumber - 1]) }}" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-main-300 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    @endif



    {{--  NEXT PAGE  --}}

    @if ($totalPages == $pageNumber)
        {{-- diabled link  --}}
        <div class="px-4 py-2 border border-grey-border2 rounded-md cursor-not-allowed" >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
        </div>
    @else
            {{-- enabled link --}}
            <a href="{{ Request::fullUrlWithQuery(['PageNumber' => $pageNumber + 1]) }}" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-main-300 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
            </a>
    @endif


    {{-- LAST PAGE  --}}
    @if ($totalPages == $pageNumber)

        {{-- diabled link  --}}
        <div class="px-4 py-2 border border-grey-border2 rounded-md cursor-not-allowed" >
            @lang('last')
        </div>
    @else
        {{-- enabled link  --}}
        <a href="{{ Request::fullUrlWithQuery(['PageNumber' => $totalPages]) }}"
                class="px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-main-300 hover:text-white" >
            @lang('last')
        </a>
    @endif



</div>
