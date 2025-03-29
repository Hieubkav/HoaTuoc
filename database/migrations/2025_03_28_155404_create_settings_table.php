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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            
            // Contact information
            $table->string('facebook_link')->nullable();
            $table->string('zalo_link')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('slogan')->nullable();
            
            // General settings
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->string('logo')->nullable();
            $table->string('brand_name')->default('Restaurant Name');
            $table->string('default_product_image')->nullable();
            
            // Location information
            $table->text('address')->nullable();
            $table->text('google_map_embed')->nullable();
            
            // Discount settings
            $table->decimal('global_discount_percentage', 5, 2)->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            $table->index(['brand_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
