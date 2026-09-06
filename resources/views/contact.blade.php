@extends('layouts.app')

@section('title', 'Contact Us - Real Estate')

@section('content')

    <!-- Banner Start -->
    <div class="list_banner">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><i class="fa fa-arrow-right"></i></li>
                <li><span>Contact Us</span></li>
            </ul>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Contact Form Section Start -->
    <div class="section3 list_bg">
        <div class="container">
            <h1 class="title" style="font-size:26px; font-weight:700; color:#333; margin-bottom:20px;">Contact Us</h1>
            
            <div class="contactus_wrap">
                <!-- Left Form -->
                <div class="contactus1_wrap">
                    <div class="contactus1_inner">
                        <div class="contact-form" style="background:#fff; padding:25px; border:1px solid #ddd; border-radius:4px;">
                            <form class="cont_form" action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="drop_msg" style="font-size:18px; font-weight:700; margin-bottom:20px; color:#333;">Drop a Message</div>

                                <div class="row" style="margin-bottom:15px;">
                                    <div class="col-md-6" style="width:48%; float:left; margin-right:4%;">
                                        <div class="input-box">
                                            <input type="text" name="first_name" placeholder="First Name" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-second" style="width:48%; float:left;">
                                        <div class="input-box">
                                            <input type="text" name="last_name" placeholder="Last Name" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom:15px; clear:both;">
                                    <div class="col-md-6" style="width:48%; float:left; margin-right:4%;">
                                        <div class="input-box">
                                            <input type="email" name="email" placeholder="Email Address" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-second" style="width:48%; float:left;">
                                        <div class="input-box">
                                            <input type="text" name="phone" placeholder="Phone" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom:20px; clear:both;">
                                    <div class="col-md-12">
                                        <div class="input-box">
                                            <textarea name="message" placeholder="Your Message..." required style="width:100%; height:120px; padding:10px; border:1px solid #ccc; border-radius:4px;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn-one" type="submit" style="background:#e65100; color:#fff; padding:12px 30px; border:none; border-radius:4px; font-weight:700; cursor:pointer;">Send Your Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Address Info -->
                <div class="contactus2_wrap">
                    <div class="contactus2_inner">
                        <div class="form_add" style="background:#fff; padding:25px; border:1px solid #ddd; border-radius:4px;">
                            <div class="form_heading" style="font-size:18px; font-weight:700; margin-bottom:15px;">Contact Information</div>
                            <i class="fa fa-address-book"></i> <span>Hyderabad, Telangana, Pin-500072</span><br><br>
                            <i class="fa fa-phone"></i> <span>+91 8309 694 254</span><br><br>
                            <i class="fa fa-envelope-o"></i> <span><a href="mailto:info@nagrealestate.com"> info@nagrealestate.com</a></span><br><br>
                            <i class="fa fa-globe"></i> <span><a href="{{ route('home') }}"> www.nagrealestate.com</a></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="height:100px;"></div>

@endsection
