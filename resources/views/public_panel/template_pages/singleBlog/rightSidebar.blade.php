@extends('public_panel.layout.master')
@section('content')

<!-- Content Wrapper Start -->
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-2">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Blog Details Right Sidebar</h2>
                <ul class="breadcrumb-menu list-style">
                                        <li><a href="{{route('home.page')}}">Home </a></li>

                    <li><a href="blog-right-sidebar.html">Blog</a></li>
                    <li>Blog Details Right Sidebar</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Details Section Start -->
    <div class="blog-details-wrap ptb-100">
        <div class="container">
            <div class="row gx-5">
                <div class="col-xl-8 col-lg-12">
                    <article>
                        <div class="post-img">
                            <img src="{{asset('public_assets/img/blog/single-blog-1.jpg')}}" alt="Image">
                        </div>
                        <ul class="post-metainfo  list-style">
                            <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                            <li><i class="ri-wechat-line"></i>No Comment</li>
                        </ul>
                        <h1>How To Recover Quickly With Online Session</h1>
                        <div class="post-para">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt labore et dolore sitor magna aliqua. Quis ipsum suspendisse ultrices <strong>gravida</strong>. Risus commodo viverra manas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>No sea takimata sanctus est Lorem <a href="index.html">Ipsum</a> dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore consect etur adicing elit.</p>
                            <blockquote class="wp-block-quote">
                                <span class="wp-quote-icon"><i class="flaticon-straight-quotes"></i></span>
                                <p>“We denounce with righteous indignation and dislike men who are soon beguide mralized by the charms of pleasure of the moment, so blinded by desire.”</p>
                            </blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt labore et dolore sitor magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra manas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <h3>Supporting Mental &amp; Physical health</h3>
                            <ol>
                                <li>Lacus sed viverra tellus in hac habitasse platea dictumst.</li>
                                <li>Gravida neque convallis a <strong>cras</strong> semper auctor neque vitae.</li>
                                <li>Lacus sed turpis tincidunt id aliquet risus feugiat in.</li>
                                <li>Risus commodo viverra manas accumsan lacus vel facilisis</li>
                            </ol>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="post-img">
                                        <img src="{{asset('public_assets/img/blog/blog-1.jpg')}}" alt="Image">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="post-img">
                                        <img src="{{asset('public_assets/img/blog/blog-2.jpg')}}" alt="Image">
                                    </div>
                                </div>
                            </div>
                            <h3>Health Products With Teli</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore dolore magna aliquyam erat, sed diam voluptua at vero amet dolor sit consect.Consectetur adipisicing elit. Laboriosam in culpa dolorem. Eos sint aut suscipit.</p>
                            <ul class="content-feature-list list-style mt-15">
                                <li><i class="ri-checkbox-circle-line"></i>
                                    Lorem ipsum dolor, sit amet.
                                </li>
                                <li><i class="ri-checkbox-circle-line"></i>
                                    Amet consectetur adipisicing elit Officia.
                                </li>
                                <li><i class="ri-checkbox-circle-line"></i>
                                    Aquaerat ipsa quis possimus.
                                </li>
                                <li><i class="ri-checkbox-circle-line"></i>
                                    Lorem aquaerat ipsa quis possimus.
                                </li>
                                <li><i class="ri-checkbox-circle-line"></i>
                                    Consectetur Amet adipisicing elit Officia.
                                </li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur <strong>adipisicing</strong> elit, sed do eiusmod tempor quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in <a href="index.html">sed</a> uia non numquam eius modi tempora incidunt ut labore dolor.</p>
                        </div>
                    </article>
                    <div class="post-meta-option">
                        <div class="row gx-0 align-items-center">
                            <div class="col-md-7 col-12">
                                <div class="post-tag">
                                    <span><i class="ri-price-tag-3-line"></i></span>
                                    <ul class="tag-list style2 list-style">
                                        <li><a href="posts-by-tag.html">Medicine</a>,</li>
                                        <li><a href="posts-by-tag.html">Clinic</a>,</li>
                                        <li><a href="posts-by-tag.html">Doctor</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5 col-12 text-md-end text-start">
                                <div class="post-share w-100">
                                    <span>Share</span>
                                    <ul class="social-profile style1 list-style">
                                        <li>
                                            <a href="https://facebook.com">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com">
                                                <i class="ri-twitter-fill"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://instagram.com">
                                                <i class="ri-instagram-line"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://linkedin.com">
                                                <i class="ri-linkedin-fill"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-author">
                        <div class="post-author-img">
                            <img src="{{asset('public_assets/img/testimonials/client-1.jpg')}}" alt="Image">
                        </div>
                        <div class="post-author-info">
                            <h4>Elon Musk</h4>
                            <p>Claritas est etiam amet sinicus, qui sequitur lorem ipsum semet coui lectorum. Lorem ipsum dolor voluptatem corporis blanditiis sadipscing elitr sed diam nonumy eirmod amet sit lorem.</p>
                            <ul class="social-profile style1 list-style">
                                <li>
                                    <a href="https://facebook.com">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com">
                                        <i class="ri-twitter-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://linkedin.com">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment-box-title mb-30">
                        <h4><span>3</span> Comments</h4>
                    </div>
                    <div class="comment-item-wrap">
                        <div class="comment-item">
                            <div class="comment-author-img">
                                <img src="{{asset('public_assets/img/testimonials/client-2.jpg')}}" alt="mage">
                            </div>
                            <div class="comment-author-wrap">
                                <div class="comment-author-info">
                                    <div class="row align-items-start">
                                        <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                            <div class="comment-author-name">
                                                <h5>Alivic Dsuza <span class="comment-date">Jun 22, 2022</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-12 text-md-end order-md-2 order-sm-3 order-3">
                                            <a href="#cmt-form" class="reply-btn">Reply</a>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-2 order-2">
                                            <div class="comment-text">
                                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                                    sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                                    magna aliquyam erat.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-item reply">
                            <div class="comment-author-img">
                                <img src="{{asset('public_assets/img/testimonials/client-6.jpg')}}" alt="mage">
                            </div>
                            <div class="comment-author-wrap">
                                <div class="comment-author-info">
                                    <div class="row align-items-start">
                                        <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                            <div class="comment-author-name">
                                                <h5>Everly Leah <span class="comment-date">Jun 23, 2022</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-12 text-md-end order-md-2 order-sm-3 order-3">
                                            <a href="#cmt-form" class="reply-btn">Reply</a>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-2 order-2">
                                            <div class="comment-text">
                                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                                    sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                                    magna aliquyam erat.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-item">
                            <div class="comment-author-img">
                                <img src="{{asset('public_assets/img/testimonials/client-4.jpg')}}" alt="mage">
                            </div>
                            <div class="comment-author-wrap">
                                <div class="comment-author-info">
                                    <div class="row align-items-start">
                                        <div class="col-md-9 col-sm-12 col-12 order-md-1 order-sm-1 order-1">
                                            <div class="comment-author-name">
                                                <h5>Michel Jackson <span class="comment-date">Jun 15, 2022</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-12 text-md-end order-md-2 order-sm-3 order-3">
                                            <a href="#cmt-form" class="reply-btn">Reply</a>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12 order-md-3 order-sm-2 order-2">
                                            <div class="comment-text">
                                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                                    sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                                    magna aliquyam erat.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cmt-form">
                        <div class="comment-box-title mb-25">
                            <h4>Leave A Comment</h4>
                            <p>Your email address will not be published. Required fields are marked.</p>
                        </div>
                        <form action="#" class="comment-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" required placeholder="Name*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" required placeholder="Email Address*">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="url" name="website" id="website" placeholder="Website">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="messages" id="messages" cols="30" rows="10" placeholder="Please Enter Your Comment Here"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="form-check checkbox">
                                        <input class="form-check-input" type="checkbox" id="test_2">
                                        <label class="form-check-label" for="test_2">
                                            Save my info for the next time I commnet.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn style1">Post A Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
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
                                        <img src="{{asset('public_assets/img/blog/post-thumb-1.jpg')}}" alt="Image">
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
                                        <img src="{{asset('public_assets/img/blog/post-thumb-2.jpg')}}" alt="Image">
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
                                        <img src="{{asset('public_assets/img/blog/post-thumb-3.jpg')}}" alt="Image">
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
                            <h4>Categories</h4>
                            <div class="category-box">
                                <ul class="list-style">
                                    <li>
                                        <a href="service-one.html">
                                            Orthopedic Solutions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="service-one.html">
                                            Cardiology Solutions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="service-one.html">
                                            Dental Services
                                        </a>
                                    </li>
                                    <li>
                                        <a href="service-one.html">
                                            Eye Care Services
                                        </a>
                                    </li>
                                    <li>
                                        <a href="service-one.html">
                                            Gastrology Services
                                        </a>
                                    </li>
                                    <li>
                                        <a href="service-one.html">
                                            Neurology Services
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget tags">
                            <h4>Popular Tags </h4>
                            <div class="tag-list">
                                <ul class="list-style">
                                    <li><a href="posts-by-tag.html">Health</a></li>
                                    <li><a href="posts-by-tag.html">Medicine</a></li>
                                    <li><a href="posts-by-tag.html">Dental</a></li>
                                    <li><a href="posts-by-tag.html">Acne</a></li>
                                    <li><a href="posts-by-tag.html">Doctor</a></li>
                                    <li><a href="posts-by-tag.html">Eye Care</a></li>
                                    <li><a href="posts-by-tag.html">Patient</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details Section End -->

</div>
<!-- Content wrapper end -->


@endsection