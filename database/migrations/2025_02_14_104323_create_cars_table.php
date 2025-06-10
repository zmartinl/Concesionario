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
        Schema::create('cars', function (Blueprint $table) {
            $table->unsignedInteger("id")->autoIncrement(); 
            $table->string('name', 20);
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('color_id');
            $table->decimal('price', 10, 2);
            $table->decimal('horse_power', 6, 2);
            $table->year('year');
            $table->boolean('sale');
            $table->tinyText('description')->nullable();
            $table->string('main_image', 255);
            $table->timestamps(); 

            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
