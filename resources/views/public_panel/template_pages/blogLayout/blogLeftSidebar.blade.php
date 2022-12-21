@extends('public_panel.layout.master')
@section('content')


<!-- Content Wrapper Start -->
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-3">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>News &amp; Articles</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="#">Home </a></li>
                    <li>News &amp; Articles</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog  Section Start -->
    <div class="blog-wrap ptb-100">
        <div class="container">
            <div class="row gx-5">
                <div class="col-xl-4 col-lg-12 order-xl-1 order-lg-2 order-md-2 order-2">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <div class="search-box">
                                <div class="form-group">
                                    <input type="search" placeholder="Search">
                                    <button type="submit">
                                        <i class="flaticon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget popular-post">
                            <h4>Popular Posts</h4>
                            <div class="popular-post-widget">
                                <div class="pp-post-item">
                                    <a href="blog-details-right-sidebar.html" class="pp-post-img">
                                        <img src="{{asset('public_assets/img/webImages/image03.jpg')}}" alt="Image">
                                    </a>
                                    <div class="pp-post-info">
                                        <span>29 Jun, 2022</span>
                                        <h6>
                                            <a href="blog-details-no-sidebar.html">
                                                3 Tips For Child Health During This Pandemic
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="pp-post-item">
                                    <a href="blog-details-right-sidebar.html" class="pp-post-img">
                                        <img src="{{asset('public_assets/img/webImages/image01.jpg')}}" alt="Image">
                                    </a>
                                    <div class="pp-post-info">
                                        <span>22 Jun, 2022</span>
                                        <h6>
                                            <a href="blog-details-no-sidebar.html">
                                                Importance Of Regular Eye Checkup For Adult
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="pp-post-item">
                                    <a href="blog-details-right-sidebar.html" class="pp-post-img">
                                        <img src="{{asset('public_assets/img/webImages/image06.jpg')}}" alt="Image">
                                    </a>
                                    <div class="pp-post-info">
                                        <span>17 May, 2022</span>
                                        <h6>
                                            <a href="blog-details-no-sidebar.html">
                                                From Mediable Origin To Modern Treatment Era
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget categories">
                            <h4>Department Specialization</h4>
                            <div class="category-box">
                                <ul class="list-style">
                                    @foreach($departmentSpecializations as $departmentSpecialization)
                                    <li>
                                        <a class="text-capitalize" href="{{route('home.allDepartments',$departmentSpecialization->id)}}">
                                            {{$departmentSpecialization->name}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget tags">
                            <h4>Doctor Specialization </h4>
                            <div class="tag-list">
                                <ul class="list-style">
                                    @foreach($doctorSpecializations as $doctorSpecialization)
                                    <li><a class="text-capitalize" href="{{route('home.allDoctors',$doctorSpecialization->id)}}">{{$doctorSpecialization->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 order-xl-2 order-lg-1 order-md-1 order-1">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="blog-card style2">
                                <div class="blog-img">
                                    <img src="{{asset('public_assets/img/webImages/image07.jpg')}}" alt="Image">
                                    <a href="posts-by-date.html" class="blog-date"><span>22</span> Jun</a>
                                </div>
                                <div class="blog-info">
                                    <ul class="blog-metainfo  list-style">
                                        <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                        <li><i class="ri-wechat-line"></i>No Comment</li>
                                    </ul>
                                    <h3><a href="blog-details-right-sidebar.html">Telehealth Services Are Ready To Help Your Family </a></h3>
                                    <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                                    <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="blog-card style2">
                                <div class="blog-img">
                                    <img src="{{asset('public_assets/img/webImages/image08.jpg')}}" alt="Image">
                                    <a href="posts-by-date.html" class="blog-date"><span>17</span>Jun</a>
                                </div>
                                <div class="blog-info">
                                    <ul class="blog-metainfo  list-style">
                                        <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                        <li><i class="ri-wechat-line"></i>No Comment</li>
                                    </ul>
                                    <h3><a href="blog-details-right-sidebar.html">10 Tips To Lead A Healthy And Happy Life</a></h3>
                                    <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                                    <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="blog-card style2">
                                <div class="blog-img">
                                    <img src="{{asset('public_assets/img/webImages/image09.jpg')}}" alt="Image">
                                    <a href="posts-by-date.html" class="blog-date"><span>12</span>May</a>
                                </div>
                                <div class="blog-info">
                                    <ul class="blog-metainfo  list-style">
                                        <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                        <li><i class="ri-wechat-line"></i>No Comment</li>
                                    </ul>
                                    <h3><a href="blog-details-right-sidebar.html">How Does Science Help In Dental Surgery Research </a></h3>
                                    <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                                    <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="blog-card style2">
                                <div class="blog-img">
                                    <img src="{{asset('public_assets/img/webImages/image10.jpg')}}" alt="Image">
                                    <a href="posts-by-date.html" class="blog-date"><span>07</span> May</a>
                                </div>
                                <div class="blog-info">
                                    <ul class="blog-metainfo  list-style">
                                        <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                        <li><i class="ri-wechat-line"></i>No Comment</li>
                                    </ul>
                                    <h3><a href="blog-details-right-sidebar.html">How To Recover Health Faster With Online Session</a></h3>
                                    <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                                    <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="page-nav list-style">
                        <li><a href="blog-right-sidebar.html"><i class="ri-arrow-left-s-line"></i></a></li>
                        <li><a class="active" href="blog-right-sidebar.html">1</a></li>
                        <li><a href="blog-right-sidebar.html">2</a></li>
                        <li><a href="blog-right-sidebar.html">3</a></li>
                        <li><a href="blog-right-sidebar.html"><i class="ri-arrow-right-s-line"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Section End -->

</div>
<!-- Content wrapper end -->



@endsection