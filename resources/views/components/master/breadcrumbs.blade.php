<!-- BREAD CRUMBS  -->
<nav class="bread-crumbs p-4">
    <ul class=" flex gap-2">
        <li>
            <a href="{{ route('home') }}" class="text-xs text-grey-text1">@lang('HOME')</a>
        </li>
        <li>
            <span class=" text-xs text-grey-text1">/</span>
            <a href="" class="text-xs font-normal">{{$current}}</a>
        </li>
    </ul>
</nav>
