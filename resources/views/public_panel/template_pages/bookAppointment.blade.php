@extends('public_panel.layout.master')
@section('content')


<!-- Content Wrapper Start -->
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Book Appointment</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="index.html">Home </a></li>
                    <li>Appointment</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Appointment section Start -->
    <section class="appointment-form-wrap ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <form action="#" class="book-appointment-form">
                        <div class="content-title">
                            <h4>Your Information</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-20">
                            <div class="col-xl-2 col-md-3 col-sm-3 col-12">
                                <h5 class="mb-0">Gender</h5>
                            </div>
                            <div class="col-xl-10 col-md-9 col-sm-9 col-12">
                                <div class="radio-btn">
                                    <div class="form-group">
                                        <input type="radio" id="test1" name="radio-group" checked>
                                        <label for="test1">Male</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="test2" name="radio-group">
                                        <label for="test2">Female</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="test3" name="radio-group">
                                        <label for="test3">Custom</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="select_hospital" id="select_hospital">
                                        <option value="0" data-display="Select Hospital">Select Hospital</option>
                                        <option value="1">St Josef Hospital, Florida</option>
                                        <option value="2">Malinda Foundation Hospital</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="select_service" id="select_service">
                                        <option value="0" data-display="Select Service">Select Service</option>
                                        <option value="1">Orthopedic</option>
                                        <option value="2">Neurology</option>
                                        <option value="3">Dentristy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="select_time" id="select_time">
                                        <option value="0" data-display="Select Doctor">Select Time</option>
                                        <option value="1">10:00 AM</option>
                                        <option value="2">11:00 AM</option>
                                        <option value="3">12:00 PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="select_doctor" id="select_doctor">
                                        <option value="0" data-display="Select Doctor">Select Doctor</option>
                                        <option value="1">Dr. Novlel Josef</option>
                                        <option value="2">Dr. Fredrick Henry</option>
                                        <option value="3">Dr. Steave Mark</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="item_desc" id="item_desc" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn style1 d-block w-100">Book Appointment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Appointment section End -->

</div>
<!-- Content wrapper end -->


@endsection