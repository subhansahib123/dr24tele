<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="index.html">
                <!-- <img src="{{asset('assets/images/brand/toolprime-sidebar-rplace.png')}}" class="header-brand-img light-logo" alt="logo"> -->
                <!-- <img src="{{asset('assets/images/brand/toolprime-sidebar.png')}}" class="header-brand-img light-logo1" alt="logo"> -->
                <h3>Dr24Tele</h3>
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    {{-- <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('admin-home-page')}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a> --}}
                </li>

                {{-- <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('admin-profile-page')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Profile</span></a>
                </li> --}}
                <li class="slide">
                    {{-- <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('permissions.index')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Permissions</span></a> --}}
                </li>
                <li class="slide">
                    {{-- <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('roles.index')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Roles</span></a> --}}
                </li>
                <li class="slide">
                    {{-- <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('users.index')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Users</span></a> --}}
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('roles')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Roles</span></a> 
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Tools</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        {{-- <li><a class="slide-item" href="{{route('categories.index')}}">Categories</a></li>
                        <li><a href="{{route('tools.index')}}" class="slide-item"> Tools</a></li> --}}
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Images</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        {{-- <li><a class="slide-item" href="{{route('image_categories.index')}}">Categories</a></li>
                        <li><a href="{{route('images.index')}}" class="slide-item"> Images</a></li> --}}
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Blogs</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        {{-- <li><a class="slide-item" href="{{route('blog_categories.index')}}">Categories</a></li>
                        <li><a href="{{route('blogs.index')}}" class="slide-item"> Blogs</a></li> --}}
                    </ul>
                </li>

                <li class="sub-category">
                    <h3>General Information</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">General</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        {{-- <li class="side-menu-label1"><a href="javascript:void(0)">General</a></li>
                        <li><a href="{{route('pages.index')}}" class="slide-item {{ (request()->is('pages')) ? 'active' : '' }}">Pages</a></li>
                        <li><a href="{{route('faqs.index')}}" class="slide-item {{ (request()->is('faqs')) ? 'active' : '' }}">FAQs</a></li>
                        <li><a href="{{route('testimonials.index')}}" class="slide-item {{ (request()->is('testimonials')) ? 'active' : '' }}">Testimonials</a></li>
                        <li><a href="{{route('advertise.index')}}" class="slide-item {{ (request()->is('advertise')) ? 'active' : '' }}">Advertise</a></li>
                        <li><a href="{{route('contact.index')}}" class="slide-item {{ (request()->is('contact')) ? 'active' : '' }}">Contact</a></li>
                        <li><a href="{{route('setting.index')}}" class="slide-item {{ (request()->is('setting')) ? 'active' : '' }}">Setting</a></li> --}}
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Configuration Settings</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        {{-- <li><a class="slide-item" href="{{route('captcha.index')}}">Google Captcha</a></li>
                        <li><a href="{{route('google.index')}}" class="slide-item"> Google Login</a></li>

                        <li><a class="slide-item" href="{{route('facebook.index')}}">Facebook Login</a></li>
                        <li><a href="{{route('linkedin.index')}}" class="slide-item"> Linkedin Login</a></li>
                        <li><a class="slide-item" href="{{route('stripe.index')}}">Stripe Login</a></li> --}}
                    </ul>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
