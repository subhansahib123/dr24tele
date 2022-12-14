<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header my-2">
            <a class="header-brand1 " href="{{ route('hospital.dashboard') }}">
                <img src="{{ asset('assets/images/logo.png') }}" class="header-brand-img light-logo" alt="logo">
                <img src="{{ asset('assets/images/logo.png') }}" class="header-brand-img light-logo1" alt="logo">
                <!-- <h3>DrTele</h3> -->
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>


                {{-- <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('organization')}}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Organizations</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('updateHospital')}}"><i class="side-menu__icon zmdi zmdi-hospital"></i><span class="side-menu__label">Hospital</span></a>
                </li> --}}
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('updateHospital') }}"><i
                            class="side-menu__icon zmdi zmdi-hospital"></i><span class="side-menu__label">Update
                            Hospital</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fa fa-id-card-o"></i><span class="side-menu__label">
                             Specializations</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a href="{{ route('createDepartment.specialization') }}" class="slide-item"> Create </a></li>
                        <li><a href="{{ route('showDepartment.specialization') }}" class="slide-item">list</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-aperture"></i><span
                            class="side-menu__label">Departments</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a class="side-menu__item has-link" data-bs-toggle="slide"
                                href="{{ route('createHospital.department') }}"></i><span
                                    class="side-menu__label">Create</span></a></li>
                        <li><a class="side-menu__item has-link" data-bs-toggle="slide"
                                href="{{ route('hospitalDepartments.list') }}"></i><span
                                    class="side-menu__label">List</span></a></li>
                    </ul>
                </li>

                <!-- <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href=""><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label"></span></a>
                </li> -->




                
                
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Managements</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a href="{{ route('createHospital.user') }}" class="slide-item"> Create</a></li>
                        <!-- <li><a href="{{ route('mapHospital.user') }}" class="slide-item">list</a></li> -->
                        <li><a href="{{ route('allHospital.users') }}" class="slide-item"> List</a></li>

                    </ul>
                </li>
                
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fa fa-ticket"></i><span
                            class="side-menu__label">Coupon</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a href="{{ route('hospital.coupon.create') }}" class="slide-item"> Create</a></li>
                        <li><a href="{{ route('hospital.coupon.index') }}" class="slide-item">List</a></li>
                        <li><a href="{{ route('hospital.coupon.assign') }}" class="slide-item">Send Coupon to Patients</a></li>
                    </ul>
                </li>

                <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fa fa-calendar"></i><span
                            class="side-menu__label">Schedules</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a href="{{ route('create.schedule') }}" class="slide-item"> Create</a></li>
                        <li><a href="{{ route('list.schedules') }}" class="slide-item">List</a></li>
                    </ul>

                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fa fa-wheelchair"></i><span
                            class="side-menu__label">Patients</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu nav-tree">
                        <li><a href="{{ route('createHospital.patients') }}" class="slide-item"> Create</a></li>
                        <li><a href="{{ route('hospitalAll.patients') }}" class="slide-item"> List</a></li>

                    </ul>
                </li>
            </ul>
            
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
