<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>@yield('title', 'Real Estate')</title>
    <meta name="description" content="@yield('meta_description', 'Real Estate Portal')">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <meta name="turbo-visit-control" content="reload">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" media="all" href="{{ asset('assets/frontend/css/filter_multi_select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl_carosal.css') }}">
    <link rel="stylesheet" media="all" href="{{ asset('assets/frontend/css/style.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/frontend/css/jquery.lbt-lightbox.min.css') }}" />

    @stack('styles')
</head>
<body>

    <!-- Header Start -->
    <div class="header">
        <!-- Top Sub Header -->
        <div class="sub_header">
            <div class="container">
                <div class="sub_header_left">
                    Call Us On: <i class="fa fa-phone"></i> +91-8767 260 270 <span>|</span> +91-8309 694 254
                </div>
                <div class="location">
                    Hyderabad <i class="fa fa-angle-down"></i>
                    <div class="loc_inner">
                        <a href="{{ url('/hyderabad/properties-in-hyderabad') }}">Hyderabad</a>
                        <a href="{{ url('/banglore/properties-in-banglore') }}">Bangalore</a>
                        <a href="{{ url('/vijayawada/properties-in-vijayawada') }}">Vijayawada</a>
                    </div>
                </div>
                <div class="sub_header_right">
                    <span class="info_mail">Email us: <a href="mailto:info@nagrealestate.com">info@nagrealestate.com</a></span>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" style="color:#ffc107; margin-left:15px; font-weight:bold;"><i class="fa fa-dashboard"></i> Admin Panel</a>
                    @else
                        <a href="{{ route('admin.login') }}" style="color:#fff; margin-left:15px;"><i class="fa fa-lock"></i> Admin Login</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Main Header Navigation -->
        <div class="main_header">
            <div class="container">
                <a class="brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/backend/images/1716061331.png') }}" alt="RealEstate Logo" style="max-height:45px;" onerror="this.src='{{ asset('assets/frontend/images/1.png') }}'; this.style.maxHeight='35px';" />
                </a>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="{{ route('home') }}">Home</a>
                    <a class="nav-item nav-link" href="{{ route('properties.index') }}">Buy Property</a>
                    <a class="nav-item nav-link" href="{{ route('properties.index') }}">Properties</a>
                    <a class="nav-item nav-link" href="{{ route('contact') }}">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    @if(session('success'))
        <div class="container" style="margin-top:20px;">
            <div style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    @yield('content')

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer_inn col-md-2">
                    <h4>Company</h4>
                    <div class="small-title-bar">
                        <div class="small-bar1"></div>
                        <div class="small-bar2"></div>
                    </div>
                    <ul class="footer_menus">
                        <li><a href="{{ route('home') }}"><i class="fa fa-angle-double-right"></i> About Us</a></li>
                        <li><a href="{{ route('properties.index') }}"><i class="fa fa-angle-double-right"></i> Buy Property</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer_inn col-md-2">
                    <h4>Offerings</h4>
                    <div class="small-title-bar">
                        <div class="small-bar1"></div>
                        <div class="small-bar2"></div>
                    </div>
                    <ul class="footer_menus">
                        <li><a href="{{ route('properties.index') }}"><i class="fa fa-angle-double-right"></i> Apartments</a></li>
                        <li><a href="{{ route('properties.index') }}"><i class="fa fa-angle-double-right"></i> Villas</a></li>
                        <li><a href="{{ route('properties.index') }}"><i class="fa fa-angle-double-right"></i> Independent Houses</a></li>
                    </ul>
                </div>
                <div class="footer_inn col-md-2">
                    <h4>Top Markets</h4>
                    <div class="small-title-bar">
                        <div class="small-bar1"></div>
                        <div class="small-bar2"></div>
                    </div>
                    <ul class="footer_menus">
                        <li><a href="{{ url('/hyderabad/properties-in-hyderabad') }}"><i class="fa fa-angle-double-right"></i> Hyderabad</a></li>
                        <li><a href="{{ url('/banglore/properties-in-banglore') }}"><i class="fa fa-angle-double-right"></i> Bangalore</a></li>
                        <li><a href="{{ url('/vijayawada/properties-in-vijayawada') }}"><i class="fa fa-angle-double-right"></i> Vijayawada</a></li>
                    </ul>
                </div>
                <div class="footer_inn col-md-2">
                    <h4>Support</h4>
                    <div class="small-title-bar">
                        <div class="small-bar1"></div>
                        <div class="small-bar2"></div>
                    </div>
                    <ul class="footer_menus">
                        <li><a href="{{ route('contact') }}"><i class="fa fa-angle-double-right"></i> Customer Support</a></li>
                        <li><a href="{{ route('admin.login') }}"><i class="fa fa-angle-double-right"></i> Admin Login</a></li>
                    </ul>
                </div>

                <div class="col-md-12">
                    <div class="footer_line"></div>
                </div>

                <div class="col-md-12">
                    <div class="footer_address">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="footer_col1 first-foo"><span><i class="fa fa-phone"></i></span></div>
                                <div class="footer_col2"><span>Phone</span>IND: +91-8309694254</div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer_col1"><span><i class="fa fa-envelope"></i></span></div>
                                <div class="footer_col2"><span>Email</span><span><a href="mailto:info@nagrealestate.com">info@nagrealestate.com</a></span></div>
                            </div>
                            <div class="col-md-4">
                                <div class="footer_col1"><span><i class="fa fa-location-arrow"></i></span></div>
                                <div class="footer_col2"><span>Address</span>Hyderabad, Telangana, India</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">&copy; {{ date('Y') }} <span>Real Estate Portal</span>. All Rights Reserved</div>
                    <ul class="social_media navbar-nav">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/owl_carosal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/filter-multi-select-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.lbt-lightbox.min.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $(".location").click(function() {
            $(".loc_inner").toggle();
        });
        $(".bhk_item").click(function() {
            $(this).toggleClass("active");
        });
    });
    </script>
    @stack('scripts')
</body>
</html>
