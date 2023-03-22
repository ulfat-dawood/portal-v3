<!-- MEDICAL FILE  -->
<div class="modal-box" id="medical-file">
    <header class="modal-header">
        <div class="title">@lang('Medical file')</div>
        <div class="close-modal" data-close-modal='#medical-file'> <i class="icofont-close"></i> </div>
    </header>

    <div class="modal-content">

        <ul class="flex flex-col gap-3 bg-white ">
            <li class=" text-grey-text1 bg-grey-bg2 rounded-lg hover:bg-grey-border1 cursor-pointer">
                <a class="py-3 px-5 text-sm text-center block" href="{{route('home' , ['locale' => session('locale'),'tabNo'=> 1])}}">
                    @lang('Coming appointments')
                </a>
            </li>
            <li class=" text-grey-text1 bg-grey-bg2 rounded-lg hover:bg-grey-border1 cursor-pointer">
                <a class="py-3 px-5 text-sm text-center block" href="{{route('home' , ['locale' => session('locale'),'tabNo'=> 2])}}">
                    @lang('Past visits')
                </a>
            </li>
            <li class=" text-grey-text1 bg-grey-bg2 rounded-lg hover:bg-grey-border1 cursor-pointer">
                <a class="py-3 px-5 text-sm text-center block" href="{{route('home' , ['locale' => session('locale'),'tabNo'=> 3])}}">
                    @lang('Sick leaves')
                </a>
            </li>
            <li class=" text-grey-text1 bg-grey-bg2 rounded-lg hover:bg-grey-border1 cursor-pointer">
                <a class="py-3 px-5 text-sm text-center block" href="{{route('home' , ['locale' => session('locale'),'tabNo'=> 4])}}">
                    @lang('Prescriptions')
                </a>
            </li>
            <li class=" text-grey-text1 bg-grey-bg2 rounded-lg hover:bg-grey-border1 cursor-pointer">
                <a class="py-3 px-5 text-sm text-center block" href="{{route('home' , ['locale' => session('locale'),'tabNo'=> 5])}}">
                    @lang('Radiology')
                </a>
            </li>
            <li class=" text-grey-text1 bg-grey-bg2 rounded-lg hover:bg-grey-border1 cursor-pointer">
                <a class="py-3 px-5 text-sm text-center block" href="{{route('home' , ['locale' => session('locale'), 'tabNo'=> 6])}}">
                    @lang('Lab tests')
                </a>
            </li>
            <li class=" text-grey-text1 bg-grey-bg2 rounded-lg hover:bg-grey-border1 cursor-pointer">
                <a class="py-3 px-5 text-sm text-center block" href="{{route('home' , ['locale' => session('locale'), 'tabNo'=> 7])}}">
                    @lang('Medical reports')
                </a>
            </li>
        </ul>


    </div>
</div>
