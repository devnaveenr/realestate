@extends('layouts.app')

@section('title', 'Real Estate - Find Your Dream Home')

@section('content')

    <!-- Banner Start -->
    <div class="banner_wrap">
        <div class="container">
            <div class="banner_wrap_inner">
                <div class="home_search_wrap">
                    <div class="home_search_inner1">
                        <select name="city" id="city" class="home_sea_city city">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->city_slug }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        <select name="location" id="location" class="home_sea_loca">
                            <option value="">Select Location</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->location_slug }}">{{ $loc->location_name }}</option>
                            @endforeach
                        </select>
                        <button type="button" onclick="constructUrlAndRedirect()">Search</button>
                    </div>
                    <div id="errorDiv"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Projects Details Start -->
    <div class="properties_wrap">
        <div class="container">
            <div class="pr_inner_wrap">
                <div class="pr_inner_section">
                    <a href="{{ route('properties.index') }}">
                        <div class="pr_inner_img">
                            <img src="{{ asset('assets/frontend/images/1.png') }}" alt="Buy House">
                        </div>
                        <h3>Buy House</h3>
                        <p>Browse verified residential apartments, gated villas, and commercial real estate.</p>
                    </a>
                </div>
                <div class="pr_inner_section">
                    <a href="{{ route('properties.index') }}">
                        <div class="pr_inner_img">
                            <img src="{{ asset('assets/frontend/images/3.png') }}" alt="Construction">
                        </div>
                        <h3>Construction</h3>
                        <p>Top grade construction quality, transparent pricing, and timely execution.</p>
                    </a>
                </div>
                <div class="pr_inner_section">
                    <a href="{{ route('properties.index') }}">
                        <div class="pr_inner_img">
                            <img src="{{ asset('assets/frontend/images/4.png') }}" alt="Interior Design">
                        </div>
                        <h3>Interior Design</h3>
                        <p>Custom interior design and architectural execution tailored to your lifestyle.</p>
                    </a>
                </div>
                <div class="pr_inner_section">
                    <a href="{{ route('properties.index') }}">
                        <div class="pr_inner_img">
                            <img src="{{ asset('assets/frontend/images/1.png') }}" alt="Loans">
                        </div>
                        <h3>All Type of Loans</h3>
                        <p>Fast approval home loans from partner banks with competitive interest rates.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Projects Details End -->

    <!-- Section1 Details Start -->
    <div class="section1">
        <div class="container">
            <h2 class="center">Properties <span>For Sale</span><strong>Best developers to explore</strong></h2>

            <div class="section1_wrap1">
                <div class="section_inner1">
                    <div class="banners_items">
                        @forelse($slides as $slide)
                            <a href="{{ route('properties.index') }}" class="banner_item">
                                <img src="{{ asset($slide->slide_image) }}" alt="Slider Banner" />
                            </a>
                        @empty
                            <a href="{{ route('properties.index') }}" class="banner_item">
                                <img src="{{ asset('assets/frontend/images/project1.jpg') }}" alt="Project Banner" />
                            </a>
                        @endforelse
                    </div>
                </div>
                <div class="section_inner2">
                    <a href="{{ route('properties.index') }}">
                        <img src="{{ asset('assets/frontend/images/project3.jpg') }}" alt="Featured Project" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Section1 Details End -->

    <!-- Section2 Details Start -->
    <div class="section1 bgcolor">
        <div class="container">
            <h2 class="center">Featured <span>Properties</span><strong>Handpicked luxury properties for you</strong></h2>
            
            <div style="display:flex; flex-wrap:wrap; gap:20px;">
                @foreach($featuredProperties as $property)
                    <div class="section50 left top_sec" style="width:48%; float:none; margin-bottom:20px;">
                        <a href="{{ route('properties.slug', $property->property_slug ?: $property->id) }}" class="sec_det_wrap" style="display:block;">
                            @if($property->images->first())
                                <img src="{{ asset($property->images->first()->property_image) }}" alt="{{ $property->property_title }}" style="height:220px; object-fit:cover; width:100%;" />
                            @else
                                <img src="{{ asset('assets/frontend/images/bg.jpg') }}" alt="Property" style="height:220px; object-fit:cover; width:100%;" />
                            @endif
                            <div class="sec_pro_det">
                                <div class="sec_det_name">{{ $property->property_title }} <span>By Verified Owner/Agent</span></div>
                                <div class="sec_det_price">₹ {{ number_format($property->price) }} <span>price</span></div>
                                <div class="sec_det1">{{ $property->bhkRelation->bhk_type ?? '' }} {{ trim($property->typeRelation->property_type ?? '') }}<span>{{ $property->locationRelation->location_name ?? '' }}, {{ $property->cityRelation->city_name ?? '' }}</span></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Section2 Details End -->

    <!-- Why Choose Us Start -->
    <div class="section3">
        <div class="container">
            <h2 class="center">Why Choose <span>Us</span><strong>Best real estate portal to explore</strong></h2>
            <div class="why_choose_sec">
                <div class="why_choose_sec1 why_margin">
                    <div class="why_choose_secinner">
                        <img src="{{ asset('assets/frontend/images/icon-4.svg') }}" alt="Icon">
                        <h4>Professional Service</h4>
                        <p>Dedicated real estate advisory with end-to-end support for property buyers and investors.</p>
                    </div>
                </div>
                <div class="why_choose_sec1 why_margin">
                    <div class="why_choose_secinner">
                        <img src="{{ asset('assets/frontend/images/icon-4.svg') }}" alt="Icon">
                        <h4>Flexible Pricing Models</h4>
                        <p>Transparent pricing, direct owner negotiations, and no hidden commission fees.</p>
                    </div>
                </div>
                <div class="why_choose_sec1">
                    <div class="why_choose_secinner">
                        <img src="{{ asset('assets/frontend/images/icon-4.svg') }}" alt="Icon">
                        <h4>Safe Money Transaction</h4>
                        <p>Verified legal documentation and secure escrow transactions for complete peace of mind.</p>
                    </div>
                </div>
                <div class="why_choose_sec1 why_margin">
                    <div class="why_choose_secinner">
                        <img src="{{ asset('assets/frontend/images/icon-4.svg') }}" alt="Icon">
                        <h4>Quality Assurance</h4>
                        <p>Rigorous physical verification of all listed residential and commercial projects.</p>
                    </div>
                </div>
                <div class="why_choose_sec1 why_margin">
                    <div class="why_choose_secinner">
                        <img src="{{ asset('assets/frontend/images/icon-4.svg') }}" alt="Icon">
                        <h4>100% Transparency</h4>
                        <p>Clear land title checks, accurate area measurements, and honest property specs.</p>
                    </div>
                </div>
                <div class="why_choose_sec1">
                    <div class="why_choose_secinner">
                        <img src="{{ asset('assets/frontend/images/icon-4.svg') }}" alt="Icon">
                        <h4>On Time Delivery</h4>
                        <p>Track construction progress and possession timelines for under-construction projects.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us End -->

    <!-- How it works Start -->
    <div class="section3">
        <div class="container">
            <h2 class="center">How It <span>Works</span><strong>Simple 6-step property buying journey</strong></h2>
            <ul class="how_work">
                <li class="first-child"><span>1</span><strong>Raise a Request</strong></li>
                <li><span>2</span><strong>Meet our Expert</strong></li>
                <li><span>3</span><strong>Book With Us</strong></li>
                <li><span>4</span><strong>Cost Estimation</strong></li>
                <li><span>5</span><strong>Work Execution</strong></li>
                <li class="last-child"><span>6</span><strong>Satisfied Delivery</strong></li>
            </ul>
        </div>
    </div>
    <!-- How it works end -->

    <!-- Customer Reviews Start -->
    <div class="section3 bgcolor">
        <div class="container">
            <h2 class="center">Customer <span>Reviews</span><strong>What our happy buyers say</strong></h2>
            <div class="customers_review">
                <div class="cus_rev_inner">
                    <div class="customer_items">
                        <div class="customer_item">
                            <p>Found my dream 3 BHK flat in Miyapur through this platform! Smooth paperwork and great guidance throughout.</p>
                            <div class="detailJC">
                                <span><img src="{{ asset('assets/frontend/images/ts-1.jpg') }}" alt="User" /></span>
                                <h5>Naveen Kumar <strong>Hyderabad</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="customer_items">
                        <div class="customer_item">
                            <p>Very professional service. Helped me find an independent villa in Bangalore with clear land title.</p>
                            <div class="detailJC">
                                <span><img src="{{ asset('assets/frontend/images/ts-1.jpg') }}" alt="User" /></span>
                                <h5>Nagarjuna M <strong>Bangalore</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="customer_items">
                        <div class="customer_item">
                            <p>Best property portal in South India! Accurate listings, verified images, and transparent pricing.</p>
                            <div class="detailJC">
                                <span><img src="{{ asset('assets/frontend/images/ts-1.jpg') }}" alt="User" /></span>
                                <h5>Lisa Smith <strong>Hyderabad</strong></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer Reviews End -->

    <!-- OUR PARTNERS Start -->
    <div class="section3">
        <div class="container">
            <h2 class="center">OUR <span>PARTNERS</span><strong>Trusted real estate builders</strong></h2>
            <div class="client_names">
                <div class="client_item"><a href="#"><img src="{{ asset('assets/frontend/images/client1.png') }}" alt="Client"></a></div>
                <div class="client_item"><a href="#"><img src="{{ asset('assets/frontend/images/client2.png') }}" alt="Client"></a></div>
                <div class="client_item"><a href="#"><img src="{{ asset('assets/frontend/images/client1.png') }}" alt="Client"></a></div>
                <div class="client_item"><a href="#"><img src="{{ asset('assets/frontend/images/client2.png') }}" alt="Client"></a></div>
            </div>
        </div>
    </div>
    <!-- OUR PARTNERS End -->

@endsection

@push('scripts')
<script type="text/javascript">
function constructUrlAndRedirect() {
  var city = document.getElementById('city').value;
  var errorDiv = document.getElementById("errorDiv");
  if(!city || city === ''){
    errorDiv.innerHTML = '<span style="color:red;font-weight:bold;display:block;margin-top:10px;">Please select city</span>';
    return false;
  }
  
  var city_extend = 'properties-in-' + city;
  var location = document.getElementById('location').value;
  var location_extend = city_extend + '-near-' + location;
 
  var baseUrl = "{{ url('/') }}";
  var targetUrl = (location && location !== '') ? `${baseUrl}/${city}/${location_extend}` : `${baseUrl}/${city}/${city_extend}`;
  window.location.href = targetUrl;
}

$(document).ready(function() {
  $('.city').on('change', function() {
    var citySlug = $(this).val();
    if(citySlug) {
      $.ajax({
        type: 'GET',
        url: "{{ url('/mainpage/getlocations') }}/" + citySlug,
        success: function(data) {
          $('#location').empty();
          $('#location').append(data.html);
        }
      });
    } else {
      $('#location').html('<option value="">Select Location</option>');
    }
  });

  $(".banners_items").owlCarousel({
    autoPlay: 3000,
    items: 1,
    navigation: false,
    pagination: false,
    lazyLoad: true,
  });

  $(".cus_rev_inner").owlCarousel({
    autoPlay: 3000,
    items: 3,
    navigation: false,
    pagination: true,
    lazyLoad: true,
  });

  $(".client_names").owlCarousel({
    autoPlay: 3000,
    items: 4,
    navigation: false,
    pagination: true,
    lazyLoad: true,
  });
});
</script>
@endpush
