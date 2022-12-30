@extends('public_panel.layout.master')
@section('content')

<!-- Content Wrapper Start -->
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Contact Us</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="{{route('home.page')}}">Home </a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Us section Start -->
    <section class="contact-us-wrap ptb-100">
        <div class="container">
            <div class="row justify-content-center pb-75">
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="contact-item">
                        <span class="contact-icon">
                            <i class="flaticon-map"></i>
                        </span>
                        <div class="contact-info">
                            <h3>Visit Us Anytime</h3>
                            <p>Mbedcare Pvt Ltd, Sebastian Road, Kaloor P.O Cochin 682017 , Kerala, India
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="contact-item">
                        <span class="contact-icon">
                            <i class="flaticon-email-2"></i>
                        </span>
                        <div class="contact-info">
                            <h3>Send An Email</h3>
                            <a href="mailto:hello@teli.com">info@drtele.co</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="contact-item">
                        <span class="contact-icon">
                            <i class="flaticon-call"></i>
                        </span>
                        <div class="contact-info">
                            <h3>Call Center</h3>
                            <a href="tel:+91 79-94945555">+91 79-94945555</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-0 mx-0">
                <div class="col-xl-1 col-lg-1 align-self-start"></div>
                <div class="col-xl-10 col-lg-10 col-12">
                    <div class="contact-form">
                        <h3 class="align-center">Send Us A Message</h3>
                        <form class="form-wrap" id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Name*" id="name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" required placeholder="Email*" data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" name="phone" id="phone" required placeholder="Phone Number*" data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="msg_subject" placeholder="Subject*" id="msg_subject" required data-error="Please enter your subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group v1">
                                        <textarea name="message" id="message" placeholder="Your Messages.." cols="30" rows="10" required data-error="Please enter your message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check checkbox">
                                        <input name="gridCheck" value="I agree to the terms and privacy policy." class="form-check-input" type="checkbox" id="gridCheck" required>
                                        <label class="form-check-label" for="gridCheck">
                                            I agree to the <a class="link style1" href="{{route('termsOfService')}}">terms &amp; conditions</a> and <a class="link style1" href="{{route('privacyPolicy')}}">privacy policy</a>
                                        </label>
                                        <div class="help-block with-errors gridCheck-error"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn style1">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-1 align-self-end"></div>
            </div>
        </div>
    </section>
    <!-- Contact Us section End -->

</div>
<!-- Content wrapper end -->



@endsection