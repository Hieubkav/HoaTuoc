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
        Schema::create('combos', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            
            // Discount information
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 10, 2)->default(0);
            $table->boolean('apply_discount')->default(true);
            
            // Price information (total of all items)
            $table->decimal('price', 10, 2)->default(0);
            
            // Status
            $table->string('status')->default('available');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
