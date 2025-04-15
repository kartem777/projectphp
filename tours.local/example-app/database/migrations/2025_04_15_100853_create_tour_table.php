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
        Schema::create('tour', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('name');
            $table->text('description');
            $table->foreignId('city_id')->constrained('city')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('country')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tag')->onDelete('cascade');
            $table->timestamps();
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour');
    }
};
