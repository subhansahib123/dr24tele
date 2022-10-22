@include('patient_panel.frontend.includes.head')


<!-- PAGE -->
<div class="page">
    <div class="page-main">
        @include('patient_panel.frontend.includes.header')

        @include('patient_panel.frontend.includes.leftsidebar')

        @yield('content')
    </div>

    @include('patient_panel.frontend.includes.rightsidebar')

    @include('patient_panel.frontend.includes.countryselector')

    @include('patient_panel.frontend.includes.footer')

</div>

@include('patient_panel.frontend.includes.foot')
