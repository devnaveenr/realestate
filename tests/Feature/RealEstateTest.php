<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Contact;
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
        $response = $this->get('/' . $slug);
        $response->assertStatus(200);
        $response->assertSee($property->property_title);
    }

    public function test_contact_form_submission_stores_inquiry(): void
    {
        $response = $this->post('/contact-us', [
            'first_name'  => 'Test',
            'last_name'   => 'User',
            'phone'       => '9998887770',
            'email'       => 'test@example.com',
            'message'     => 'Testing inquiry submission.',
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
            'email'    => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);

        $dashboard = $this->get('/admin/dashboard');
        $dashboard->assertStatus(200);
        $dashboard->assertSee('Dashboard Metrics');
    }
}
