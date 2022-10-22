@extends('patient_panel.layout.master')

@section('content')

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Profile</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row" id="user-profile">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="wideget-user mb-2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="panel profile-cover">
                                                <div class="profile-cover__action bg-img"></div>
                                                <div class="profile-cover__img">
                                                    <div class="profile-img-1">
                                                        <img src="../assets/images/users/21.jpg" alt="img">
                                                    </div>
                                                    <div class="profile-img-content text-dark text-start">
                                                        <div class="text-dark">
                                                            <h3 class="h3 mb-2">Percy Kewshun</h3>
                                                            <h5 class="text-muted">Web Developer</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-profile">
                                                    <button class="btn btn-primary mt-1 mb-1"> <i class="fa fa-rss"></i> <span>Follow</span></button>
                                                    <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Message</span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="px-0 px-sm-4">
                                                <div class="social social-profile-buttons mt-5 float-end">
                                                    <div class="mt-3">
                                                        <a class="social-icon text-primary" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                                        <a class="social-icon text-primary" href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                                        <a class="social-icon text-primary" href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>
                                                        <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa fa-rss"></i></a>
                                                        <a class="social-icon text-primary" href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                        <a class="social-icon text-primary" href="https://myaccount.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="main-profile-contact-list">
                                        <div class="me-5">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-secondary bradius me-3 mt-1">
                                                    <i class="fe fe-edit fs-20 text-white"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Posts</span>
                                                    <div class="fw-semibold fs-25">
                                                        328
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-danger bradius text-white me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fe fe-users fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Followers</span>
                                                    <div class="fw-semibold fs-25">
                                                        937k
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-0 mt-5 mt-md-0">
                                            <div class="media">
                                                <div class="media-icon bg-primary text-white bradius me-3 mt-1">
                                                    <span class="mt-3">
                                                        <i class="fe fe-cast fs-20"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <span class="text-muted">Following</span>
                                                    <div class="fw-semibold fs-25">
                                                        2,876
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">About</div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <h5>Biography<i class="fe fe-edit-3 text-primary mx-2"></i></h5>
                                        <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.
                                            <a href="javascript:void(0)">Read more</a>
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fe fe-briefcase fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>San Francisco, CA </strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fe fe-map-pin fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>Francisco, USA</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fe fe-phone fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>+125 254 3562 </strong>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 mt-3">
                                        <div class="me-4 text-center text-primary">
                                            <span><i class="fe fe-mail fs-20"></i></span>
                                        </div>
                                        <div>
                                            <strong>georgeme@abc.com </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Skills</div>
                                </div>
                                <div class="card-body">
                                    <div class="tags">
                                        <a href="javascript:void(0)" class="tag">Laravel</a>
                                        <a href="javascript:void(0)" class="tag">Angular</a>
                                        <a href="javascript:void(0)" class="tag">HTML</a>
                                        <a href="javascript:void(0)" class="tag">Vuejs</a>
                                        <a href="javascript:void(0)" class="tag">Codiegniter</a>
                                        <a href="javascript:void(0)" class="tag">JavaScript</a>
                                        <a href="javascript:void(0)" class="tag">Bootstrap</a>
                                        <a href="javascript:void(0)" class="tag">PHP</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Work & Education</div>
                                </div>
                                <div class="card-body">
                                    <div class="main-profile-contact-list">
                                        <div class="me-5">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-primary  mb-3 mb-sm-0 me-3 mt-1">
                                                    <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                        <path fill="#fff" d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3M18.82 9L12 12.72L5.18 9L12 5.28L18.82 9M17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" />
                                                    </svg>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="font-weight-semibold mb-1">Web Designer at <a href="javascript:void(0)" class="btn-link">Spruko</a></h6>
                                                    <span>2018 - present</span>
                                                    <p>Past Work: Spruko, Inc.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me-5 mt-5 mt-md-0">
                                            <div class="media mb-4 d-flex">
                                                <div class="media-icon bg-success text-white mb-3 mb-sm-0 me-3 mt-1">
                                                    <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M20,6C20.58,6 21.05,6.2 21.42,6.59C21.8,7 22,7.45 22,8V19C22,19.55 21.8,20 21.42,20.41C21.05,20.8 20.58,21 20,21H4C3.42,21 2.95,20.8 2.58,20.41C2.2,20 2,19.55 2,19V8C2,7.45 2.2,7 2.58,6.59C2.95,6.2 3.42,6 4,6H8V4C8,3.42 8.2,2.95 8.58,2.58C8.95,2.2 9.42,2 10,2H14C14.58,2 15.05,2.2 15.42,2.58C15.8,2.95 16,3.42 16,4V6H20M4,8V19H20V8H4M14,6V4H10V6H14M12,9A2.25,2.25 0 0,1 14.25,11.25C14.25,12.5 13.24,13.5 12,13.5A2.25,2.25 0 0,1 9.75,11.25C9.75,10 10.76,9 12,9M16.5,18H7.5V16.88C7.5,15.63 9.5,14.63 12,14.63C14.5,14.63 16.5,15.63 16.5,16.88V18Z" />
                                                    </svg>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="font-weight-semibold mb-1">Studied at <a href="javascript:void(0)" class="btn-link">University</a></h6>
                                                    <span>2004-2008</span>
                                                    <p>Graduation: Bachelor of Science in Computer Science</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <form class="profile-edit">
                                        <textarea class="form-control" placeholder="What's in your mind right now" rows="7"></textarea>
                                        <div class="profile-share border-top-0">
                                            <div class="mt-2">
                                                <a href="javascript:void(0)" class="me-2" title="Audio" data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i class="fe fe-mic"></i></span></a>
                                                <a href="javascript:void(0)" class="me-2" title="Video" data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i class="fe fe-video"></i></span></a>
                                                <a href="javascript:void(0)" class="me-2" title="Image" data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-muted"><i class="fe fe-image"></i></span></a>
                                            </div>
                                            <button class="btn btn-sm btn-success ms-auto"><i class="fa fa-share ms-1"></i> Share</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card border p-0 shadow-none">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="media mt-0">
                                            <div class="media-user me-2">
                                                <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                <small class="text-muted">just now</small>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="dropdown show">
                                                <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                    <span class=""><i class="fe fe-more-vertical"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                        <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer user-pro-2">
                                    <div class="media mt-0">
                                        <div class="media-user me-2">
                                            <div class="avatar-list avatar-list-stacked">
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                                <span class="avatar brround text-primary">+28</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="d-flex mt-1">
                                                <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border p-0 shadow-none">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="media mt-0">
                                            <div class="media-user me-2">
                                                <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                <small class="text-muted">Sep 26 2019, 10:14am</small>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="dropdown show">
                                                <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                    <span class=""><i class="fe fe-more-vertical"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="d-flex">
                                            <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/22.jpg" alt="img" class="br-5"></a>
                                            <a href="gallery.html" class="w-30 m-2"><img src="../assets/images//media/24.jpg" alt="img" class="br-5"></a>
                                        </div>
                                        <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                        <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer user-pro-2">
                                    <div class="media mt-0">
                                        <div class="media-user me-2">
                                            <div class="avatar-list avatar-list-stacked">
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                                <span class="avatar brround text-primary">+28</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="d-flex mt-1">
                                                <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border p-0 shadow-none">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="media mt-0">
                                            <div class="media-user me-2">
                                                <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="../assets/images/users/16.jpg"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                <small class="text-muted">Sep 24 2019, 09:14am</small>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="dropdown show">
                                                <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                    <span class=""><i class="fe fe-more-vertical"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="d-flex">
                                            <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/26.jpg" alt="img" class="br-5"></a>
                                            <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/23.jpg" alt="img" class="br-5"></a>
                                            <a href="gallery.html" class="w-30 m-2"><img src="../assets/images/media/21.jpg" alt="img" class="br-5"></a>
                                        </div>
                                        <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                        <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer user-pro-2">
                                    <div class="media mt-0">
                                        <div class="media-user me-2">
                                            <div class="avatar-list avatar-list-stacked">
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/12.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/9.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/2.jpg)"></span>
                                                <span class="avatar brround" style="background-image: url(../assets/images/users/4.jpg)"></span>
                                                <span class="avatar brround text-primary">+28</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="d-flex mt-1">
                                                <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Followers</div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <div class="media overflow-visible">
                                            <img class="avatar brround avatar-md me-3" src="../assets/images/users/18.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle mt-2">
                                                <a href="javascript:void(0)" class=" fw-semibold text-dark">John Paige</a>
                                                <p class="text-muted mb-0">johan@gmail.com</p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-2">
                                                <button class="btn btn-sm btn-primary" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="media overflow-visible mt-sm-5">
                                            <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                            <div class="media-body valign-middle mt-2">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">Lillian Quinn</a>
                                                <p class="text-muted mb-0">lilliangore</p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                <button class="btn btn-sm btn-secondary" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="media overflow-visible mt-sm-5">
                                            <img class="avatar brround avatar-md me-3" src="../assets/images/users/2.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle mt-2">
                                                <a href="javascript:void(0)" class="text-dark fw-semibold">Harry Fisher</a>
                                                <p class="text-muted mb-0">harryuqt</p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                <button class="btn btn-sm btn-danger" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="media overflow-visible mt-sm-5">
                                            <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                            <div class="media-body valign-middle mt-2">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                <p class="text-muted mb-0">harris@gmail.com</p>
                                            </div>
                                            <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                <button class="btn btn-sm btn-success" type="button">Follow</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Our Latest News</div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <div class="media media-xs overflow-visible">
                                            <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/12.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">John Paige</a>
                                                <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                            </div>
                                        </div>
                                        <div class="media media-xs overflow-visible mt-5">
                                            <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/2.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">Peter Hill</a>
                                                <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                            </div>
                                        </div>
                                        <div class="media media-xs overflow-visible mt-5">
                                            <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/9.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                            </div>
                                        </div>
                                        <div class="media media-xs overflow-visible mt-5">
                                            <img class="avatar bradius avatar-xl me-3" src="../assets/images/users/4.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">Harry Fisher</a>
                                                <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Friends</div>
                                </div>
                                <div class="card-body">
                                    <div class="user-pro-1">
                                        <div class="media media-xs overflow-visible">
                                            <img class="avatar brround avatar-md me-3" src="../assets/images/users/18.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle">
                                                <a href="javascript:void(0)" class=" fw-semibold text-dark">John Paige</a>
                                                <p class="text-muted mb-0">Web Designer</p>
                                            </div>
                                            <div class="">
                                                <div class="social social-profile-buttons float-end">
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media media-xs overflow-visible mt-5">
                                            <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                            <div class="media-body valign-middle mt-0">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">Lillian Quinn</a>
                                                <p class="text-muted mb-0">Web Designer</p>
                                            </div>
                                            <div class="">
                                                <div class="social social-profile-buttons float-end">
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media media-xs overflow-visible mt-5">
                                            <img class="avatar brround avatar-md me-3" src="../assets/images/users/2.jpg" alt="avatar-img">
                                            <div class="media-body valign-middle mt-0">
                                                <a href="javascript:void(0)" class="text-dark fw-semibold">Harry Fisher</a>
                                                <p class="text-muted mb-0">Web Designer</p>
                                            </div>
                                            <div class="">
                                                <div class="social social-profile-buttons float-end">
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media media-xs overflow-visible mt-5">
                                            <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                            <div class="media-body valign-middle mt-0">
                                                <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                <p class="text-muted mb-0">Web Designer</p>
                                            </div>
                                            <div class="">
                                                <div class="social social-profile-buttons float-end">
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                    <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL-END -->
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
<!--app-content closed-->
@endsection
