@include('doctor_panel.frontend.includes.head')


<!-- PAGE -->
<div class="page">
    <div class="page-main">
        @include('doctor_panel.frontend.includes.header')

        @include('doctor_panel.frontend.includes.leftsidebar')

        @yield('content')
    </div>

    @include('doctor_panel.frontend.includes.rightsidebar')

    @include('doctor_panel.frontend.includes.countryselector')

    @include('doctor_panel.frontend.includes.footer')

</div>

@include('doctor_panel.frontend.includes.foot')
