<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CityLocationController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (CodeIgniter Slug Compatibility)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/property/{idOrSlug}', [PropertyController::class, 'show'])->name('properties.show');

Route::get('/contact-us', [ContactController::class, 'showForm'])->name('contact');
Route::get('/contact', [ContactController::class, 'showForm']);
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::post('/contact', [ContactController::class, 'store']);

// AJAX location lookup by city slug
Route::get('/mainpage/getlocations/{citySlug}', [PropertyController::class, 'getLocationsByCitySlug'])->name('locations.ajax');

/*
|--------------------------------------------------------------------------
| Admin Auth & Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Admin Properties CRUD
        Route::resource('properties', AdminPropertyController::class)->names([
            'index'   => 'admin.properties.index',
            'create'  => 'admin.properties.create',
            'store'   => 'admin.properties.store',
            'show'    => 'admin.properties.show',
            'edit'    => 'admin.properties.edit',
            'update'  => 'admin.properties.update',
            'destroy' => 'admin.properties.destroy',
        ]);

        // Cities & Locations
        Route::get('/cities-locations', [CityLocationController::class, 'index'])->name('admin.cities.index');
        Route::post('/cities', [CityLocationController::class, 'storeCity'])->name('admin.cities.store');
        Route::post('/locations', [CityLocationController::class, 'storeLocation'])->name('admin.locations.store');

        // Inquiries
        Route::get('/inquiries', [AdminContactController::class, 'index'])->name('admin.inquiries.index');
        Route::delete('/inquiries/{contact}', [AdminContactController::class, 'destroy'])->name('admin.inquiries.destroy');

        // Settings & Slides
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings', [SettingController::class, 'updateSetting'])->name('admin.settings.update');
        Route::post('/slides', [SettingController::class, 'storeSlide'])->name('admin.slides.store');
        Route::delete('/slides/{slide}', [SettingController::class, 'destroySlide'])->name('admin.slides.destroy');
    });
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

/*
|--------------------------------------------------------------------------
| CodeIgniter Dynamic Slug Routes (City, Location & Property Slugs)
|--------------------------------------------------------------------------
*/
// City + Location slug route: e.g. /hyderabad/properties-in-hyderabad-near-ameerpet
Route::get('/{citySlug}/properties-in-{citySlug2}-near-{locationSlug}', [PropertyController::class, 'indexBySlug'])
    ->name('properties.city.location');

// City slug route: e.g. /hyderabad/properties-in-hyderabad
Route::get('/{citySlug}/properties-in-{citySlug2}', [PropertyController::class, 'indexBySlug'])
    ->name('properties.city');

// Direct Property Slug route: e.g. /2-bhk-flat-in-vijay-durga-for-sale-in-kukatpally
Route::get('/{propertySlug}', [PropertyController::class, 'showBySlug'])->name('properties.slug');
