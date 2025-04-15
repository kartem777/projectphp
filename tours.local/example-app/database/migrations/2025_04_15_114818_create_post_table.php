<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained('city')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('country')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tag')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('photo');
            $table->timestamp('created_at');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
