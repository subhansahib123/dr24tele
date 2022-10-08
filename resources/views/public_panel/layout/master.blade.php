@include('public_panel.frontend.includes.head')

<!-- Page Wrapper End -->
<div class="page-wrapper">

    @include('public_panel.frontend.includes.header')

    @yield('content')

    @include('public_panel.frontend.includes.footer')
</div>
<!-- Page Wrapper End -->
@include('public_panel.frontend.includes.foot')