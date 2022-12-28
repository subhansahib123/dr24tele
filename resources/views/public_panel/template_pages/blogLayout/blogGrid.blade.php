@extends('public_panel.layout.master')
@section('content')

<!-- Content Wrapper Start -->
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-4">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Blog No Sidebar</h2>
                <ul class="breadcrumb-menu list-style">
                                        <li><a href="{{route('home.page')}}">Home </a></li>

                    <li>Blog No Sidebar</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog  Section Start -->
    <div class="blog-wrap ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-5.jpg')}}" alt="Image">
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
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-6.jpg')}}" alt="Image">
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
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-4.jpg')}}" alt="Image">
                            <a href="posts-by-date.html" class="blog-date"><span>25</span> May</a>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-metainfo  list-style">
                                <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                <li><i class="ri-wechat-line"></i>No Comment</li>
                            </ul>
                            <h3><a href="blog-details-right-sidebar.html">The Day I'd Spent At Square Medical Center</a></h3>
                            <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                            <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-5.jpg')}}" alt="Image">
                            <a href="posts-by-date.html" class="blog-date"><span>22</span> May</a>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-metainfo  list-style">
                                <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                <li><i class="ri-wechat-line"></i>No Comment</li>
                            </ul>
                            <h3><a href="blog-details-right-sidebar.html">Financial Audit & Planning For Treatment Has Started</a></h3>
                            <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                            <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-6.jpg')}}" alt="Image">
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
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-4.jpg')}}" alt="Image">
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
    <!-- Blog Section End -->

</div>
<!-- Content wrapper end -->


@endsection