<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Location;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RealEstateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Buy House');
    }

    public function test_properties_catalogue_page_is_accessible_and_filterable(): void
    {
        $response = $this->get('/properties?city=1');
        $response->assertStatus(200);
        $response->assertSee('Flats');
    }

    public function test_city_slug_route_works(): void
    {
        $response = $this->get('/hyderabad/properties-in-hyderabad');
        $response->assertStatus(200);
        $response->assertSee('Flats');
    }

    public function test_city_and_location_slug_route_works(): void
    {
        $response = $this->get('/hyderabad/properties-in-hyderabad-near-ameerpet');
        $response->assertStatus(200);
        $response->assertSee('Flats');
    }

    public function test_property_detail_slug_page_loads(): void
    {
        $property = Property::first();
        $slug = $property->property_slug ?: '2-bhk-flat-in-vijay-durga-for-sale-in-kukatpally';
        $response = $this->get('/'.$slug);
        $response->assertStatus(200);
        $response->assertSee($property->property_title);
    }

    public function test_contact_form_submission_stores_inquiry(): void
    {
        $response = $this->post('/contact-us', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '9998887770',
            'email' => 'test@example.com',
            'message' => 'Testing inquiry submission.',
            'property_id' => 1,
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('contacts', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $user = User::first();
        $response = $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);

        $dashboard = $this->get('/admin/dashboard');
        $dashboard->assertStatus(200);
        $dashboard->assertSee('Dashboard Metrics');
    }

    public function test_admin_can_update_and_delete_city(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $city = City::first();
        $updateResponse = $this->put(route('admin.cities.update', $city->id), [
            'city_name' => 'Updated City Name',
        ]);
        $updateResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('cities', [
            'id' => $city->id,
            'city_name' => 'Updated City Name',
            'city_slug' => 'updated-city-name',
        ]);

        $deleteResponse = $this->delete(route('admin.cities.destroy', $city->id));
        $deleteResponse->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    }

    public function test_admin_can_update_and_delete_location(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $city = City::first();
        $location = Location::first();

        $updateResponse = $this->put(route('admin.locations.update', $location->id), [
            'city_id' => $city->id,
            'location_name' => 'Updated Locality Name',
        ]);
        $updateResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'location_name' => 'Updated Locality Name',
            'location_slug' => 'updated-locality-name',
        ]);

        $deleteResponse = $this->delete(route('admin.locations.destroy', $location->id));
        $deleteResponse->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('locations', ['id' => $location->id]);
    }

    public function test_property_formatted_price_in_lacs_and_crores(): void
    {
        $propertyCrore = new Property(['price' => 12500000]);
        $this->assertEquals('₹ 1.25 Cr', $propertyCrore->formatted_price);

        $propertyExactCrore = new Property(['price' => 20000000]);
        $this->assertEquals('₹ 2 Cr', $propertyExactCrore->formatted_price);

        $propertyLakh = new Property(['price' => 7500000]);
        $this->assertEquals('₹ 75 Lacs', $propertyLakh->formatted_price);

        $propertyDecimalLakh = new Property(['price' => 450000]);
        $this->assertEquals('₹ 4.5 Lacs', $propertyDecimalLakh->formatted_price);

        $propertyThousand = new Property(['price' => 95000]);
        $this->assertEquals('₹ 95,000', $propertyThousand->formatted_price);
    }
}
