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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->decimal('price', 8, 2);
            $table->decimal('website_percentage', 8, 2);
            $table->string('duration');
            $table->foreignId('provider_id')->constrained('users');
            $table->enum('status' , ['offered' , 'pending' , 'accepted' , 'rejected' , 'completed'])->default('offered');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
