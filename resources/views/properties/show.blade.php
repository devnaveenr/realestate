@extends('layouts.app')

@section('title', $property->property_title . ' - Real Estate')

@section('content')

    <!-- Banner Start -->
    <div class="list_banner">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><i class="fa fa-arrow-right"></i></li>
                <li><a href="{{ route('properties.index') }}">Flats</a></li>
                <li><i class="fa fa-arrow-right"></i></li>
                <li><span>Flats Sale in {{ $property->cityRelation->city_name ?? 'Hyderabad' }}</span></li>
            </ul>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Property Details Section Start -->
    <div class="section3 list_bg">
        <div class="container">
            <h1 class="page_heading" style="font-size:24px; font-weight:700; color:#333; margin-bottom:20px;">{{ $property->property_title }}</h1>
            
            <div class="show_page_wrap">
                <!-- Left Details -->
                <div class="show_page_left">
                    <div class="list_filter" style="margin-bottom:20px;">
                        <div class="flex-container1" style="display:flex; gap:15px; background:#fff; p-3; border:1px solid #ddd; padding:15px; border-radius:4px;">
                            <div style="flex-grow: 1" class="active">₹ {{ number_format($property->price) }} <span style="display:block; color:#777; font-size:12px;">Non-negotiable</span></div>
                            <div style="flex-grow: 1">{{ $property->property_size ?: '1200 Sqft' }} <span style="display:block; color:#777; font-size:12px;">Builtup Area</span></div>
                        </div>
                    </div>

                    <div class="show_page_info" style="background:#fff; padding:20px; border:1px solid #ddd; border-radius:4px; margin-bottom:25px;">
                        <div class="sh_pg_det" style="margin-bottom:15px;">
                            <div class="sh_pg_info">
                                <strong>{{ $property->bhkRelation->bhk_type ?? '2 BHK' }}</strong>
                                <span style="display:block; color:#777; font-size:12px;">No. of Bedroom</span>
                            </div>
                        </div>

                        <div class="sh_pg_det" style="margin-bottom:15px;">
                            <div class="sh_pg_info">
                                <strong>{{ $property->bathrooms ?? 2 }} Bathroom</strong>
                                <span style="display:block; color:#777; font-size:12px;">No. of Bathroom</span>
                            </div>
                        </div>

                        <div class="sh_pg_det" style="margin-bottom:15px;">
                            <div class="sh_pg_info">
                                <strong>{{ trim($property->statusRelation->property_status ?? 'Ready') }}</strong>
                                <span style="display:block; color:#777; font-size:12px;">Possession / Status</span>
                            </div>
                        </div>

                        <div class="sh_pg_det" style="margin-bottom:15px;">
                            <div class="sh_pg_info">
                                <strong>{{ trim($property->typeRelation->property_type ?? 'Apartment') }}</strong>
                                <span style="display:block; color:#777; font-size:12px;">Building Type</span>
                            </div>
                        </div>

                        <div class="sh_pg_det" style="margin-bottom:15px;">
                            <div class="sh_pg_info">
                                <strong>{{ $property->parkingRelation->parking_type ?? 'Car / Bike' }}</strong>
                                <span style="display:block; color:#777; font-size:12px;">Parking</span>
                            </div>
                        </div>

                        <div class="sh_pg_det" style="margin-top:20px;">
                            <div class="sh_butt">
                                <a href="{{ route('contact', ['id' => $property->id]) }}" class="sh_contact" style="background:#e65100; color:#fff; padding:10px 25px; border-radius:4px; text-decoration:none; font-weight:700; display:inline-block;">Contact Agent</a>
                            </div>
                        </div>
                    </div>

                    <div class="sh_heading" style="margin-bottom:10px;">
                        <h4 style="font-size:18px; font-weight:700;">Description</h4>
                    </div>
                    <div style="background:#fff; padding:20px; border:1px solid #ddd; border-radius:4px; line-height:1.6; color:#444;">
                        {!! $property->property_desc ?: 'Spacious property located in prime area with excellent amenities.' !!}
                    </div>

                </div>

                <!-- Right Photos & Similar Properties -->
                <div class="show_page_right">
                    <div class="flat_img" style="background:#fff; p-3; border:1px solid #ddd; padding:15px; border-radius:4px; margin-bottom:25px;">
                        <div class="list_item_img1">
                            @if($property->images->count() > 0)
                                @foreach($property->images as $key => $image)
                                    <div class="box" style="margin-bottom:10px;">
                                        <img src="{{ asset($image->property_image) }}" alt="Property Photo" style="width:100%; height:250px; object-fit:cover; border-radius:4px;">
                                        @if($key == 0)
                                            <span style="background:rgba(0,0,0,0.7); color:#fff; padding:3px 8px; border-radius:3px; font-size:12px; position:relative; top:-30px; left:10px;">1/{{ $property->images->count() }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="box">
                                    <img src="{{ asset('assets/frontend/images/gal2.jpg') }}" alt="Property Photo" style="width:100%; height:250px; object-fit:cover; border-radius:4px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="similar_pro" style="background:#fff; padding:15px; border:1px solid #ddd; border-radius:4px;">
                        <h4 style="font-size:16px; font-weight:700; margin-bottom:15px;">Similar Properties</h4>
                        @foreach($relatedProperties as $similar)
                            <div class="list_item_wrap" style="margin-bottom:15px; padding-bottom:15px; border-b:1px solid #eee;">
                                <div class="list_item_img" style="margin-bottom:8px;">
                                    @if($similar->images->first())
                                        <img src="{{ asset($similar->images->first()->property_image) }}" alt="{{ $similar->property_title }}" style="width:100%; height:120px; object-fit:cover; border-radius:4px;">
                                    @else
                                        <img src="{{ asset('assets/frontend/images/gal2.jpg') }}" alt="Similar Property" style="width:100%; height:120px; object-fit:cover; border-radius:4px;">
                                    @endif
                                </div>
                                <div class="list_item_det">
                                    <a href="{{ route('properties.show', $similar->property_slug ?: $similar->id) }}" style="text-decoration:none; color:inherit;">
                                        <div class="list_item_name" style="font-weight:700; font-size:14px; margin-bottom:5px;">{{ $similar->property_title }}</div>
                                        <div class="list_item_price" style="font-size:13px; color:#e65100; font-weight:700;">
                                            ₹ {{ number_format($similar->price) }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="height:100px;"></div>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('.list_item_img1').lbtLightBox({
        qtd_pagination: 6,
        pagination_width: "160px",
        pagination_height: "160px",
        custom_children: ".box img",
        captions: true
    });
});
</script>
@endpush
