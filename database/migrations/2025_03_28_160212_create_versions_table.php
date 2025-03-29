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
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('name');
            $table->string('thumbnail')->nullable();
            
            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0);
            
            // Status
            $table->boolean('is_in_stock')->default(true);
            $table->enum('status', ['available', 'unavailable'])->default('available');
            
            // Relationships
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'is_in_stock', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versions');
    }
};
