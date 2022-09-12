@include('admin_panel.frontend.includes.head')


<!-- PAGE -->
<div class="page">
    <div class="page-main">
        @include('admin_panel.frontend.includes.header')

        @include('admin_panel.frontend.includes.leftsidebar')

        @yield('content')
    </div>

    @include('admin_panel.frontend.includes.rightsidebar')

    @include('admin_panel.frontend.includes.countryselector')

    @include('admin_panel.frontend.includes.footer')

</div>

@include('admin_panel.frontend.includes.foot')
