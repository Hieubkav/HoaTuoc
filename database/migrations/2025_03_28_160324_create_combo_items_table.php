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
        Schema::create('combo_items', function (Blueprint $table) {
            $table->id();
            
            $table->integer('quantity')->default(1);
            
            // Relationships
            $table->foreignId('version_id')->constrained()->cascadeOnDelete();
            $table->foreignId('combo_id')->constrained()->cascadeOnDelete();
            
            $table->timestamps();
            
            $table->index(['combo_id', 'version_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_items');
    }
};
