<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_name')->nullable();
            $table->string('city_slug')->nullable();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name')->nullable();
            $table->string('city_slug')->nullable();
            $table->string('location_slug')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->timestamps();
        });

        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('property_type')->nullable();
            $table->timestamps();
        });

        Schema::create('property_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('property_status')->nullable();
            $table->timestamps();
        });

        Schema::create('bhk_types', function (Blueprint $table) {
            $table->id();
            $table->string('bhk_type')->nullable();
            $table->timestamps();
        });

        Schema::create('facings', function (Blueprint $table) {
            $table->id();
            $table->string('facing_type')->nullable();
            $table->timestamps();
        });

        Schema::create('furnishings', function (Blueprint $table) {
            $table->id();
            $table->string('furnishing_type')->nullable();
            $table->timestamps();
        });

        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('parking_type')->nullable();
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_title')->nullable();
            $table->unsignedBigInteger('property_type')->nullable();
            $table->longText('property_desc')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('property_size')->nullable();
            $table->unsignedBigInteger('facing')->nullable();
            $table->unsignedBigInteger('bhk_type')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->unsignedBigInteger('property_status')->nullable();
            $table->unsignedBigInteger('furnishing_type')->nullable();
            $table->unsignedBigInteger('parking_type')->nullable();
            $table->unsignedBigInteger('city')->nullable();
            $table->string('city_slug')->nullable();
            $table->unsignedBigInteger('location')->nullable();
            $table->string('location_slug')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('property_slug')->nullable();
            $table->string('seo_url')->nullable();
            $table->integer('status')->default(1);
            $table->text('title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamps();
        });

        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('property_image')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('message')->nullable();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->timestamps();
        });

        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('slide_image')->nullable();
            $table->integer('slide_priority')->default(0);
            $table->text('slide_desc')->nullable();
            $table->integer('slide_status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('site_name')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('company_email')->nullable();
            $table->integer('gst')->nullable();
            $table->text('address')->nullable();
            $table->double('usd_price', 10, 2)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('slides');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('property_images');
        Schema::dropIfExists('properties');
        Schema::dropIfExists('parkings');
        Schema::dropIfExists('furnishings');
        Schema::dropIfExists('facings');
        Schema::dropIfExists('bhk_types');
        Schema::dropIfExists('property_statuses');
        Schema::dropIfExists('property_types');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('cities');
    }
};
