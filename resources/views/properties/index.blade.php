@extends('layouts.app')

@section('title', 'Properties - Real Estate')

@section('content')

    <!-- Banner Start -->
    <div class="list_banner">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><i class="fa fa-arrow-right"></i></li>
                <li><a href="{{ route('properties.index') }}">Flats</a></li>
                <li><i class="fa fa-arrow-right"></i></li>
                <li><span>Flats & Properties for Sale</span></li>
            </ul>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Main Directory Content Start -->
    <div class="section3 list_bg">
        <div class="container">
            
            <div class="list_adds">
                <form id="filterForm" action="{{ url()->current() }}" method="GET">
                    <div class="project_search">
                        <div class="find_search">
                            <div class="find_text">Find your search <a href="{{ route('properties.index') }}" id="resetFilters" style="float:right; cursor:pointer; color:#007bff; text-decoration:none;"><i class="fa fa-history"></i> Reset</a></div>
                            
                            <!-- BHK Type -->
                            <div class="bhk_type">
                                <div class="bhk_text">BHK Type</div>
                                <div class="bhk_items">
                                    @foreach($bhkTypes as $bhk_type)
                                        <label class="bhk_item {{ request('bhk_type') == $bhk_type->id ? 'active' : '' }}" style="display:inline-block; margin-right:5px; cursor:pointer;">
                                            <input type="radio" name="bhk_type" value="{{ $bhk_type->id }}" onchange="this.form.submit()" {{ request('bhk_type') == $bhk_type->id ? 'checked' : '' }} style="display:none;" />
                                            {{ $bhk_type->bhk_type }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sort By -->
                            <div class="bhk_type sort_by">
                                <div class="bhk_text">Sort By</div>
                                <select name="sort" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Posted on Newest First</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price(Low to High)</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price(High to Low)</option>
                                </select>
                            </div>

                            <!-- Property Status -->
                            <div class="Property_status">
                                <div class="bhk_text">Property Status:</div>
                                <div class="Property_select">
                                    @foreach($propertyStatuses as $pstatus)
                                        <label style="display:block; margin-bottom:4px;">
                                            <input type="radio" name="property_status" value="{{ $pstatus->id }}" onchange="this.form.submit()" {{ request('property_status') == $pstatus->id ? 'checked' : '' }} />
                                            {{ trim($pstatus->property_status) }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Furnishing -->
                            <div class="Property_status">
                                <div class="bhk_text">Furnishing:</div>
                                <div class="Property_select">
                                    @foreach($furnishings as $furnishing_type)
                                        <label style="display:block; margin-bottom:4px;">
                                            <input type="radio" name="furnishing_type" value="{{ $furnishing_type->id }}" onchange="this.form.submit()" {{ request('furnishing_type') == $furnishing_type->id ? 'checked' : '' }} />
                                            {{ $furnishing_type->furnishing_type }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div class="Property_status">
                                <div class="bhk_text">Property Type:</div>
                                <div class="Property_select">
                                    @foreach($propertyTypes as $property_type)
                                        <label style="display:block; margin-bottom:4px;">
                                            <input type="radio" name="property_type" value="{{ $property_type->id }}" onchange="this.form.submit()" {{ request('property_type') == $property_type->id ? 'checked' : '' }} />
                                            {{ trim($property_type->property_type) }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Parking -->
                            <div class="Property_status">
                                <div class="bhk_text">Parking:</div>
                                <div class="Property_select">
                                    @foreach($parkings as $p)
                                        <label style="display:block; margin-bottom:4px;">
                                            <input type="radio" name="parking_type" value="{{ $p->id }}" onchange="this.form.submit()" {{ request('parking_type') == $p->id ? 'checked' : '' }} />
                                            {{ $p->parking_type }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

                <!-- Sidebar Expert Call -->
                <div class="sidebar_expert">
                    <div class="icon-holder_img">
                        <i class="fa fa-headphones"></i>
                    </div>
                    <h3>Consult with expert &amp;<br> Start today</h3>
                    <div class="bottom-box">
                        <h2>+91 8309694254</h2>
                        <span>Email: <a href="mailto:info@nagrealestate.com">info@nagrealestate.com</a></span>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="request_call">Request A Call Back</a>
                <div class="loan" style="margin-top:15px;">
                    <img src="{{ asset('assets/frontend/images/loan1.jpg') }}" alt="Loan Info" style="width:100%;">
                </div>
            </div>

            <!-- Property List Results -->
            <div class="list_projects1" id="filteredResults">
                @forelse($properties as $property)
                    <div class="list_item_wrap" style="margin-bottom:25px; background:#fff; padding:15px; border:1px solid #e2e2e2; border-radius:5px;">
                        <div class="list_item_img" style="float:left; width:220px; margin-right:20px;">
                            @if($property->images->count() > 0)
                                <div class="box">
                                    <img src="{{ asset($property->images->first()->property_image) }}" alt="{{ $property->property_title }}" style="width:100%; height:160px; object-fit:cover; border-radius:4px;">
                                </div>
                            @else
                                <div class="box">
                                    <img src="{{ asset('assets/frontend/images/gal2.jpg') }}" alt="Property Image" style="width:100%; height:160px; object-fit:cover; border-radius:4px;">
                                </div>
                            @endif
                        </div>

                        <div class="list_item_det" style="overflow:hidden;">
                            <div class="list_item_det1">
                                <a href="{{ route('properties.slug', $property->property_slug ?: $property->id) }}" class="view_more_wrap" style="text-decoration:none; color:inherit;">
                                    <div class="list_item_name" style="font-size:18px; font-weight:700; color:#333; margin-bottom:10px;">{{ $property->property_title }}</div>
                                    <div class="list_item_price" style="display:flex; flex-wrap:wrap; gap:15px; margin-bottom:15px;">
                                        <div class="list_item_de" style="font-weight:700; color:#e65100;">₹ {{ number_format($property->price) }} <span style="display:block; font-weight:400; color:#777; font-size:12px;">Price</span></div>
                                        <div class="list_item_de">{{ $property->property_size ?: '1200 Sqft' }} <span style="display:block; color:#777; font-size:12px;">Builtup</span></div>
                                        <div class="list_item_de">{{ $property->facingRelation->facing_type ?? 'East' }} <span style="display:block; color:#777; font-size:12px;">Facing</span></div>
                                        <div class="list_item_de">{{ $property->bhkRelation->bhk_type ?? '2 BHK' }} <span style="display:block; color:#777; font-size:12px;">Apartment Type</span></div>
                                        <div class="list_item_de">{{ $property->bathrooms ?? 2 }} <span style="display:block; color:#777; font-size:12px;">Bathrooms</span></div>
                                    </div>
                                </a>
                                <a class="submit_btn" href="{{ route('contact', ['id' => $property->id]) }}" style="background:#e65100; color:#fff; padding:8px 20px; border-radius:4px; text-decoration:none; display:inline-block; font-weight:600;">Contact Us</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="padding:40px; text-align:center; background:#fff; border:1px solid #ddd; border-radius:5px;">
                        <h3>No Properties found</h3>
                        <p style="color:#777; margin-top:5px;">Try resetting search filters or select a different city.</p>
                    </div>
                @endforelse

                <div style="margin-top:20px;">
                    {{ $properties->links() }}
                </div>
            </div>

        </div>
    </div>

    <div style="height:100px;"></div>

@endsection
