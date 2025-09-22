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
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Floor name (e.g., "Ground Floor", "1st Floor")
            $table->string('level')->nullable();       // Floor level (e.g., "0", "1", "2", "B1")
            $table->text('description')->nullable();   // Floor description
            $table->string('image')->nullable();       // Floor plan image
            $table->json('facilities')->nullable();    // JSON array of facilities
            $table->boolean('is_active')->default(true); // Whether floor is active
            $table->integer('sort_order')->default(0);  // Display order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floors');
    }
};