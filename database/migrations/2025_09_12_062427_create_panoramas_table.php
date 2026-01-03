<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('panoramas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('floor')->nullable();
            $table->string('display_image')->nullable();
            $table->string('folder');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('panoramas');
    }
};
