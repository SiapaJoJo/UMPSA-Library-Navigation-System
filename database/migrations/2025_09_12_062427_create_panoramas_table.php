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
        Schema::create('panoramas', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Display name
            $table->text('description')->nullable();   // Detailed description
            $table->string('floor')->nullable();       // Floor information
            $table->string('display_image')->nullable(); // Preview image filename
            $table->string('folder');                  // Folder in public/panos/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panoramas');
    }
};
