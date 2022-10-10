@include('hospital_panel.frontend.includes.head')


<!-- PAGE -->
<div class="page">
    <div class="page-main">
        @include('hospital_panel.frontend.includes.header')

        @include('hospital_panel.frontend.includes.leftsidebar')

        @yield('content')
    </div>

    @include('hospital_panel.frontend.includes.rightsidebar')

    @include('hospital_panel.frontend.includes.countryselector')

    @include('hospital_panel.frontend.includes.footer')

</div>

@include('hospital_panel.frontend.includes.foot')
