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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            
            // Basic information
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('seats')->default(0);
            $table->string('status')->default('available');
            
            // Relationships
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['room_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
