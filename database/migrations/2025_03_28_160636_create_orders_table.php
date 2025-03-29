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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('name')->default('')->comment('Default: #ID');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->integer('total_items')->default(0);
            
            // Status information
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled', 'draft'])
                ->default('draft');
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])
                ->default('pending');
            
            // Relationships
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'payment_status', 'customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
