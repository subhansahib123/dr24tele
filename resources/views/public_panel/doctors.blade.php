 @extends('public_panel.layout.master')
 @section('content')
     <section class="team-wrap ptb-100 bg-chathamas">
         <div class="container">
             <div class="row">
                 <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 aos-init aos-animate"
                     data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                     <div class="section-title style2 text-center mb-40">
                         <span>Our Doctors</span>
                         <h2>Meet Our Expert &amp; Experienced  Doctors</h2>
                     </div>
                 </div>
             </div>
             <div class="team-slider-one owl-carousel owl-loaded owl-drag">






                 <div class="owl-stage-outer owl-height" style="height: 468.344px;">
                     <div class="owl-stage"
                         style="transform: translate3d(-660px, 0px, 0px); transition: all 2.6s ease 0s; width: 4624px;">
                         @foreach ($doctors as $doctor )


                         <div class="owl-item cloned" style="width: 305.25px; margin-right: 25px;">
                             <div class="team-card style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200"
                                 data-aos-delay="400">
                                 <img src="{{asset('public_assets/img/team/team-3.jpg')}}"  alt="Image">
                                 <div class="team-info">
                                     <a href="{{route('load.appointment',$doctor->id)}}" class="team-mail"><i
                                             class="ri-mail-send-line"></i></a>
                                     <h3>Dr. {{$doctor->user->username}}</h3>
                                     <span>Neurosurgery Efficient</span>
                                     <ul class="social-profile style2 list-style">
                                         <li>
                                             <a target="_blank" href="https://facebook.com">
                                                 <i class="ri-facebook-fill"></i>
                                             </a>
                                         </li>
                                         <li>
                                             <a target="_blank" href="https://twitter.com">
                                                 <i class="ri-twitter-fill"></i>
                                             </a>
                                         </li>
                                         <li>
                                             <a target="_blank" href="https://instagram.com">
                                                 <i class="ri-instagram-line"></i>
                                             </a>
                                         </li>
                                         <li>
                                             <a target="_blank" href="https://linkedin.com">
                                                 <i class="ri-linkedin-fill"></i>
                                             </a>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                          @endforeach

                     </div>
                 </div>
                 <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                             aria-label="Previous">‹</span></button><button type="button" role="presentation"
                         class="owl-next"><span aria-label="Next">›</span></button></div>
                 <div class="owl-dots"><button role="button" class="owl-dot"><span></span></button><button
                         role="button" class="owl-dot active"><span></span></button></div>
             </div>
         </div>
     </section>



     <section class="blog-wrap pt-100 pb-75">
         <div class="container">
             <div class="row">
                 <div class="col-xl-6 offset-xl-3  col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                     <div class="section-title style1 text-center mb-40">
                         <span>Our Blog</span>
                         <h2>Our Latest &amp; Most Popular Tips &amp; Tricks For You</h2>
                     </div>
                 </div>
             </div>
             <div class="row justify-content-center">
                 <div class="col-xl-4 col-lg-6 col-md-6 aos-init aos-animate" data-aos="fade-left"
                     data-aos-duration="1200" data-aos-delay="200">
                     <div class="blog-card style2">
                         <div class="blog-img">
                             <img src="{{asset('public_assets/img/blog/blog-5.jpg')}}" alt="Image">
                             <a href="#" class="blog-date"><span>22</span> Jun</a>
                         </div>
                         <div class="blog-info">
                             <ul class="blog-metainfo  list-style">
                                 <li><i class="ri-user-unfollow-line"></i><a href="#">Admin</a></li>
                                 <li><i class="ri-wechat-line"></i>No Comment</li>
                             </ul>
                             <h3><a href="#">Telehealth Services Are Ready To Help Your
                                     Family </a></h3>
                             <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                             <a href="#" class="link style2">Read More<i
                                     class="flaticon-right-arrow"></i></a>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-4 col-lg-6 col-md-6 aos-init aos-animate" data-aos="fade-left"
                     data-aos-duration="1200" data-aos-delay="300">
                     <div class="blog-card style2">
                         <div class="blog-img">
                             <img src="{{asset('public_assets/img/blog/blog-6.jpg')}}" alt="Image">
                             <a href="#" class="blog-date"><span>17</span>Jun</a>
                         </div>
                         <div class="blog-info">
                             <ul class="blog-metainfo  list-style">
                                 <li><i class="ri-user-unfollow-line"></i><a href="#">Admin</a></li>
                                 <li><i class="ri-wechat-line"></i>No Comment</li>
                             </ul>
                             <h3><a href="#">10 Tips To Lead A Healthy And Happy Life</a>
                             </h3>
                             <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                             <a href="#" class="link style2">Read More<i
                                     class="flaticon-right-arrow"></i></a>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-4 col-lg-6 col-md-6 aos-init aos-animate" data-aos="fade-left"
                     data-aos-duration="1200" data-aos-delay="400">
                     <div class="blog-card style2">
                         <div class="blog-img">
                             <img src="{{asset('public_assets/img/blog/blog-4.jpg')}}" alt="Image">
                             <a href="#" class="blog-date"><span>25</span> May</a>
                         </div>
                         <div class="blog-info">
                             <ul class="blog-metainfo  list-style">
                                 <li><i class="ri-user-unfollow-line"></i><a href="#">Admin</a></li>
                                 <li><i class="ri-wechat-line"></i>No Comment</li>
                             </ul>
                             <h3><a href="#">The Day I'd Spent At Square Medical Center</a>
                             </h3>
                             <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                             <a href="#" class="link style2">Read More<i
                                     class="flaticon-right-arrow"></i></a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 @endsection
