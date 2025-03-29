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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('code')->unique();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('thumbnail')->nullable();
            
            // Discount details
            $table->decimal('value', 10, 2);
            $table->boolean('is_percentage')->default(false);
            $table->timestamp('valid_until')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'valid_until']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
