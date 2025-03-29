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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('operating_hours')->nullable();
            
            // Room properties
            $table->integer('capacity')->default(0);
            $table->boolean('is_vip')->default(false);
            
            // Service columns (1-6)
            $table->string('service_name_1')->nullable();
            $table->text('service_description_1')->nullable();
            $table->string('service_name_2')->nullable();
            $table->text('service_description_2')->nullable();
            $table->string('service_name_3')->nullable();
            $table->text('service_description_3')->nullable();
            $table->string('service_name_4')->nullable();
            $table->text('service_description_4')->nullable();
            $table->string('service_name_5')->nullable();
            $table->text('service_description_5')->nullable();
            $table->string('service_name_6')->nullable();
            $table->text('service_description_6')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('name');
            $table->index('is_vip');
            $table->index('capacity');
            $table->index(['is_vip', 'capacity']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
