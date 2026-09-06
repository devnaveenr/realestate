<?php

namespace Database\Seeders;

use App\Models\BhkType;
use App\Models\City;
use App\Models\Contact;
use App\Models\Facing;
use App\Models\Furnishing;
use App\Models\Location;
use App\Models\Parking;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
            ]
        );

        // BHK Types
        $bhkTypes = [
            ['id' => 1, 'bhk_type' => '1 BHK'],
            ['id' => 2, 'bhk_type' => '2 BHK'],
            ['id' => 3, 'bhk_type' => '3 BHK'],
            ['id' => 4, 'bhk_type' => '4 BHK'],
        ];
        foreach ($bhkTypes as $item) {
            BhkType::updateOrCreate(['id' => $item['id']], $item);
        }

        // Cities
        $cities = [
            ['id' => 1, 'city_name' => 'Hyderabad', 'city_slug' => 'hyderabad'],
            ['id' => 2, 'city_name' => 'Banglore', 'city_slug' => 'banglore'],
            ['id' => 3, 'city_name' => 'Vijayawada', 'city_slug' => 'vijayawada'],
            ['id' => 4, 'city_name' => 'Mumbai', 'city_slug' => 'mumbai'],
            ['id' => 5, 'city_name' => 'Delhi', 'city_slug' => 'delhi'],
        ];
        foreach ($cities as $item) {
            City::updateOrCreate(['id' => $item['id']], $item);
        }

        // Facing
        $facings = [
            ['id' => 1, 'facing_type' => 'East'],
            ['id' => 2, 'facing_type' => 'West'],
            ['id' => 3, 'facing_type' => 'North'],
            ['id' => 4, 'facing_type' => 'South'],
        ];
        foreach ($facings as $item) {
            Facing::updateOrCreate(['id' => $item['id']], $item);
        }

        // Furnishing
        $furnishings = [
            ['id' => 1, 'furnishing_type' => 'Full'],
            ['id' => 2, 'furnishing_type' => 'Semi'],
            ['id' => 3, 'furnishing_type' => 'None'],
        ];
        foreach ($furnishings as $item) {
            Furnishing::updateOrCreate(['id' => $item['id']], $item);
        }

        // Locations
        $locations = [
            ['id' => 1, 'location_name' => 'Ameerpet', 'city_slug' => 'hyderabad', 'location_slug' => 'ameerpet', 'city_id' => 1],
            ['id' => 2, 'location_name' => 'Madhapur', 'city_slug' => 'hyderabad', 'location_slug' => 'madhapur', 'city_id' => 1],
            ['id' => 3, 'location_name' => 'Miyapur', 'city_slug' => 'hyderabad', 'location_slug' => 'miyapur', 'city_id' => 1],
            ['id' => 4, 'location_name' => 'Patancheru', 'city_slug' => 'hyderabad', 'location_slug' => 'patancheru', 'city_id' => 1],
            ['id' => 5, 'location_name' => 'Nizampet', 'city_slug' => 'hyderabad', 'location_slug' => 'nizampet', 'city_id' => 1],
            ['id' => 6, 'location_name' => 'L B Nagar', 'city_slug' => 'hyderabad', 'location_slug' => 'l-b-nagar', 'city_id' => 1],
            ['id' => 7, 'location_name' => 'Whitefield', 'city_slug' => 'banglore', 'location_slug' => 'whitefield', 'city_id' => 2],
            ['id' => 8, 'location_name' => 'Sarjapur Road', 'city_slug' => 'banglore', 'location_slug' => 'sarjapur-road', 'city_id' => 2],
            ['id' => 9, 'location_name' => 'Devanahalli', 'city_slug' => 'banglore', 'location_slug' => 'devanahalli', 'city_id' => 2],
            ['id' => 10, 'location_name' => 'Machavaram Hill area part', 'city_slug' => 'vijayawada', 'location_slug' => 'machavaram-hill-area-part', 'city_id' => 3],
        ];
        foreach ($locations as $item) {
            Location::updateOrCreate(['id' => $item['id']], $item);
        }

        // Parking
        $parkings = [
            ['id' => 1, 'parking_type' => '2 Wheeler'],
            ['id' => 2, 'parking_type' => '4 Wheeler'],
            ['id' => 3, 'parking_type' => '2 Wheeler, 4 Wheeler'],
        ];
        foreach ($parkings as $item) {
            Parking::updateOrCreate(['id' => $item['id']], $item);
        }

        // Property Status
        $statuses = [
            ['id' => 1, 'property_status' => 'Under Construction'],
            ['id' => 2, 'property_status' => 'Ready'],
            ['id' => 3, 'property_status' => 'New Projects'],
        ];
        foreach ($statuses as $item) {
            PropertyStatus::updateOrCreate(['id' => $item['id']], $item);
        }

        // Property Types
        $types = [
            ['id' => 1, 'property_type' => 'Apartment'],
            ['id' => 2, 'property_type' => 'Independent House/Villa'],
            ['id' => 3, 'property_type' => 'Gated Community Villa'],
            ['id' => 4, 'property_type' => 'Standalone Building'],
        ];
        foreach ($types as $item) {
            PropertyType::updateOrCreate(['id' => $item['id']], $item);
        }

        // Properties
        $properties = [
            [
                'id' => 1,
                'property_title' => '2 BHK Flat In Vijay Durga For Sale In Kukatpally',
                'property_type' => 1,
                'property_desc' => 'Spacious 2 BHK flat with modern amenities located in Kukatpally.',
                'price' => 4500000.00,
                'property_size' => '1200 Sqft',
                'facing' => 2,
                'bhk_type' => 2,
                'bathrooms' => 2,
                'property_status' => 1,
                'furnishing_type' => 1,
                'parking_type' => 3,
                'city' => 1,
                'city_slug' => 'hyderabad',
                'location' => 1,
                'location_slug' => 'ameerpet',
                'agent_id' => null,
                'property_slug' => '2-bhk-flat-in-vijay-durga-for-sale-in-kukatpally',
                'seo_url' => '2-bhk-flat-in-vijay-durga-for-sale-in-kukatpally',
                'status' => 1,
                'created_by' => 1,
            ],
            [
                'id' => 2,
                'property_title' => '3 Bhk flat in Miyapur hmt colony',
                'property_type' => 1,
                'property_desc' => 'Beautiful 3 BHK flat with scenic views and excellent cross ventilation.',
                'price' => 5000000.00,
                'property_size' => '1900 sqft',
                'facing' => 3,
                'bhk_type' => 3,
                'bathrooms' => 3,
                'property_status' => 2,
                'furnishing_type' => 2,
                'parking_type' => 2,
                'city' => 1,
                'city_slug' => 'hyderabad',
                'location' => 3,
                'location_slug' => 'miyapur',
                'agent_id' => null,
                'property_slug' => '3-bhk-flat-in-miyapur-hmt-colony',
                'seo_url' => '3-bhk-flat-in-miyapur-hmt-colony',
                'status' => 1,
                'created_by' => 1,
            ],
            [
                'id' => 3,
                'property_title' => 'Luxury Villa in Patancheru',
                'property_type' => 2,
                'property_desc' => 'Grand luxury villa with private garden, 4 bedrooms, and premium fittings.',
                'price' => 9000000.00,
                'property_size' => '6000 SQFT',
                'facing' => 1,
                'bhk_type' => 4,
                'bathrooms' => 4,
                'property_status' => 2,
                'furnishing_type' => 2,
                'parking_type' => 2,
                'city' => 1,
                'city_slug' => 'hyderabad',
                'location' => 4,
                'location_slug' => 'patancheru',
                'agent_id' => null,
                'property_slug' => 'villa-in-patacheru',
                'seo_url' => 'villa-in-patacheru',
                'status' => 1,
                'created_by' => 1,
            ],
            [
                'id' => 4,
                'property_title' => '2 BHK Flat In Krishna Soudha Apartments Ameerpet',
                'property_type' => 1,
                'property_desc' => 'Well-maintained apartment in the heart of Ameerpet close to metro.',
                'price' => 5500000.00,
                'property_size' => '1000 sqft',
                'facing' => 3,
                'bhk_type' => 2,
                'bathrooms' => 2,
                'property_status' => 2,
                'furnishing_type' => 2,
                'parking_type' => 1,
                'city' => 1,
                'city_slug' => 'hyderabad',
                'location' => 1,
                'location_slug' => 'ameerpet',
                'agent_id' => null,
                'property_slug' => '2-bhk-flat-krishna-soudha-ameerpet',
                'seo_url' => '2-bhk-flat-krishna-soudha-ameerpet',
                'status' => 1,
                'created_by' => 1,
            ],
            [
                'id' => 5,
                'property_title' => '2 BHK House For Sale In Miyapur',
                'property_type' => 2,
                'property_desc' => 'Independent house in Miyapur with clear title and fast access to IT corridor.',
                'price' => 8000000.00,
                'property_size' => '1000 sqft',
                'facing' => 1,
                'bhk_type' => 2,
                'bathrooms' => 2,
                'property_status' => 2,
                'furnishing_type' => 2,
                'parking_type' => 1,
                'city' => 1,
                'city_slug' => 'hyderabad',
                'location' => 3,
                'location_slug' => 'miyapur',
                'agent_id' => null,
                'property_slug' => '2-bhk-house-for-sale-in-miyapur',
                'seo_url' => '2-bhk-house-for-sale-in-miyapur',
                'status' => 1,
                'created_by' => 1,
            ],
            [
                'id' => 6,
                'property_title' => '2 BHK Gated Community Villa In Sai Sruthi Nilayam, Ameerpet',
                'property_type' => 3,
                'property_desc' => 'Exclusive gated community villa with 24/7 security and lush green parks.',
                'price' => 12000000.00,
                'property_size' => '1000 sqft',
                'facing' => 1,
                'bhk_type' => 2,
                'bathrooms' => 2,
                'property_status' => 2,
                'furnishing_type' => 1,
                'parking_type' => 1,
                'city' => 1,
                'city_slug' => 'hyderabad',
                'location' => 1,
                'location_slug' => 'ameerpet',
                'agent_id' => null,
                'property_slug' => '2-bhk-gated-community-villa-sai-sruthi-nilayam',
                'seo_url' => '2-bhk-gated-community-villa-sai-sruthi-nilayam',
                'status' => 1,
                'created_by' => 1,
            ],
            [
                'id' => 7,
                'property_title' => '2 BHK Flat For Sale In Lakeview Colony Road in Madhapur',
                'property_type' => 4,
                'property_desc' => 'Prime Madhapur location flat, perfect for IT professionals near Hitec City.',
                'price' => 8000000.00,
                'property_size' => '1000 sqft',
                'facing' => 2,
                'bhk_type' => 2,
                'bathrooms' => 2,
                'property_status' => 2,
                'furnishing_type' => 1,
                'parking_type' => 1,
                'city' => 1,
                'city_slug' => 'hyderabad',
                'location' => 2,
                'location_slug' => 'madhapur',
                'agent_id' => null,
                'property_slug' => '2-bhk-flat-lakeview-colony-madhapur',
                'seo_url' => '2-bhk-flat-lakeview-colony-madhapur',
                'status' => 1,
                'created_by' => 1,
            ],
            [
                'id' => 8,
                'property_title' => '3 BHK Flat For Sale In Whitefield, Bangalore',
                'property_type' => 1,
                'property_desc' => 'Spacious 3 BHK apartment in Whitefield with clubhouse, pool, and gym.',
                'price' => 8500000.00,
                'property_size' => '1400 sqft',
                'facing' => 2,
                'bhk_type' => 3,
                'bathrooms' => 3,
                'property_status' => 2,
                'furnishing_type' => 2,
                'parking_type' => 2,
                'city' => 2,
                'city_slug' => 'banglore',
                'location' => 7,
                'location_slug' => 'whitefield',
                'agent_id' => null,
                'property_slug' => '3-bhk-flat-whitefield-bangalore',
                'seo_url' => '3-bhk-flat-whitefield-bangalore',
                'status' => 1,
                'created_by' => 1,
            ],
        ];

        foreach ($properties as $item) {
            Property::updateOrCreate(['id' => $item['id']], $item);
        }

        // Property Images
        $propertyImages = [
            ['id' => 7, 'property_id' => 1, 'property_image' => 'assets/frontend/images/properyimages/1717557605_1.jpg'],
            ['id' => 8, 'property_id' => 2, 'property_image' => 'assets/frontend/images/properyimages/1717589879_gal2.jpg'],
            ['id' => 9, 'property_id' => 3, 'property_image' => 'assets/frontend/images/properyimages/1717589935_gal5.jpg'],
            ['id' => 10, 'property_id' => 1, 'property_image' => 'assets/frontend/images/properyimages/1717658810_gal1.jpg'],
            ['id' => 11, 'property_id' => 1, 'property_image' => 'assets/frontend/images/properyimages/1717658828_gal2.jpg'],
        ];
        foreach ($propertyImages as $item) {
            PropertyImage::updateOrCreate(['id' => $item['id']], $item);
        }

        // Contacts
        $contacts = [
            ['id' => 5, 'first_name' => 'Naveen', 'last_name' => 'Kumar', 'phone' => '09100312065', 'email' => 'naveen@example.com', 'message' => 'Interested in 2 BHK flat Kukatpally', 'property_id' => 1],
            ['id' => 7, 'first_name' => 'Nagarjuna', 'last_name' => 'M', 'phone' => '9972611846', 'email' => 'mnagarjuna@example.com', 'message' => 'Would like to visit Miyapur property.', 'property_id' => 2],
        ];
        foreach ($contacts as $item) {
            Contact::updateOrCreate(['id' => $item['id']], $item);
        }

        // Slides
        Slide::updateOrCreate(
            ['id' => 14],
            [
                'slide_image' => 'assets/frontend/images/slides/1692039635.png',
                'slide_priority' => 0,
                'slide_desc' => 'Find Your Dream Home Today',
                'slide_status' => 1,
            ]
        );

        // Settings
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'logo' => 'assets/backend/images/1716061331.png',
                'site_name' => 'Nag Real Estate',
                'contact_no' => '8309694254',
                'company_email' => 'info@nagrealestate.com',
                'gst' => 0,
                'address' => 'Hyderabad, Telangana, India',
                'usd_price' => 83.50,
            ]
        );
    }
}
