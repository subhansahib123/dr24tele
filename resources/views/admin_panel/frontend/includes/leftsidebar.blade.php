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
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('professions')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Professions</span></a>
                </li>
                
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('organization')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Organizations</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('roles')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Roles</span></a>
                </li>




                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Total Users</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a href="{{route('create.user')}}" class="slide-item"> Create User</a></li>
                        <li><a href="{{route('users.unmapped')}}" class="slide-item">Unmapped Users</a></li>
                        <li><a href="{{route('all.users')}}" class="slide-item"> All Users</a></li>

                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Total Patients</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a href="{{route('create.patients')}}" class="slide-item"> Create Patient</a></li>
                        <li><a href="{{route('map.patients')}}" class="slide-item">Map Patients</a></li>
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