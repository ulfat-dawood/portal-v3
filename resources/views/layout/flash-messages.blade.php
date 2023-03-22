@if ($message = Session::get('success'))
    <div id="my-toast" onl class="success">
        <div class="close-btn" onclick="closeToast(this)"><i class="icofont-ui-close"></i></div>
        <div class="toast-msg">{!! $message !!}</div>
        <div class="toast-icon"><i class="icofont-check-circled"></i></div>
    </div>
    <script>
        const toastMsg = document.querySelector('#my-toast');
        setTimeout(() => {
            toastMsg.classList.add('slideDown');
        }, 7000)
        setTimeout(() => {
            toastMsg.classList.add('hide');
        }, 7500)
    </script>
@endif

@if ($message = Session::get('error'))
    <div id="my-toast" onl class="danger">
        <div class="close-btn" onclick="closeToast(this)"><i class="icofont-ui-close"></i></div>
        <div class="toast-msg">{!! $message !!}</div>
        <div class="toast-icon"><i class="icofont-warning-alt"></i></div>
    </div>
    <script>
        const toastMsg = document.querySelector('#my-toast');
        setTimeout(() => {
            toastMsg.classList.add('slideDown');
        }, 7000)
        setTimeout(() => {
            toastMsg.classList.add('hide');
        }, 7500)
    </script>
@endif

@if ($message = Session::get('warning'))
    <div id="my-toast" onl class="warning">
        <div class="close-btn" onclick="closeToast(this)"><i class="icofont-ui-close"></i></div>
        <div class="toast-msg">{!! $message !!}</div>
        <div class="toast-icon"><i class="icofont-warning-alt"></i></div>
    </div>
    <script>
        const toastMsg = document.querySelector('#my-toast');
        setTimeout(() => {
            toastMsg.classList.add('slideDown');
        }, 7000)
        setTimeout(() => {
            toastMsg.classList.add('hide');
        }, 7500)
    </script>
@endif

@if ($message = Session::get('info'))
    <div id="my-toast" onl class="info">
        <div class="close-btn" onclick="closeToast(this)"><i class="icofont-ui-close"></i></div>
        <div class="toast-msg">{!! $message !!}</div>
        <div class="toast-icon"><i class="icofont-info-circle"></i></div>
    </div>
    <script>
        const toastMsg = document.querySelector('#my-toast');
        setTimeout(() => {
            toastMsg.classList.add('slideDown');
        }, 7000)
        setTimeout(() => {
            toastMsg.classList.add('hide');
        }, 7500)
    </script>
@endif


@error('DoctorOrCenterName')
    <div id="my-toast" onl class="warning">
        <div class="close-btn" onclick="closeToast(this)"><i class="icofont-ui-close"></i></div>
        <div class="toast-msg">@lang('Either search keyword or the speciality must be provided')</div>
        <div class="toast-icon"><i class="icofont-warning-alt"></i></div>
    </div>
    <script>
        const toastMsg = document.querySelector('#my-toast');
        setTimeout(() => {
            toastMsg.classList.add('slideDown');
        }, 7000)
        setTimeout(() => {
            toastMsg.classList.add('hide');
        }, 7500)
    </script>
@enderror
@error('ClinicId')
    <div id="my-toast" onl class="warning">
        <div class="close-btn" onclick="closeToast(this)"><i class="icofont-ui-close"></i></div>
        <div class="toast-msg">@lang('Either search keyword or the speciality must be provided')</div>
        <div class="toast-icon"><i class="icofont-warning-alt"></i></div>
    </div>
    <script>
        const toastMsg = document.querySelector('#my-toast');
        setTimeout(() => {
            toastMsg.classList.add('slideDown');
        }, 7000)
        setTimeout(() => {
            toastMsg.classList.add('hide');
        }, 7500)
    </script>
@enderror
