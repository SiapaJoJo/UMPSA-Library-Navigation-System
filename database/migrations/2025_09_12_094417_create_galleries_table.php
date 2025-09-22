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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');                   // Image title
            $table->text('description')->nullable();   // Image description
            $table->string('image_path');              // Path to image file
            $table->string('alt_text')->nullable();    // Alt text for accessibility
            $table->string('category')->nullable();    // Gallery category (e.g., "Library", "Events", "Facilities")
            $table->boolean('is_featured')->default(false); // Featured image
            $table->boolean('is_active')->default(true);   // Whether image is active
            $table->integer('sort_order')->default(0);     // Display order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};