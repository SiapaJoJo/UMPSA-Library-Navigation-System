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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Sender's name
            $table->string('email');                   // Sender's email
            $table->string('phone')->nullable();       // Sender's phone
            $table->string('subject');                 // Message subject
            $table->text('message');                   // Message content
            $table->enum('status', ['new', 'read', 'replied', 'closed'])->default('new'); // Message status
            $table->text('admin_notes')->nullable();   // Admin internal notes
            $table->timestamp('read_at')->nullable();  // When message was read
            $table->timestamp('replied_at')->nullable(); // When admin replied
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};