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
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id'); // Identificador único de la propiedad
            $table->string('address'); // Dirección de la propiedad
            $table->string('city'); // Ciudad donde se encuentra la propiedad
            $table->integer('price'); // Precio de la propiedad
            $table->text('description'); // Descripción detallada de la propiedad
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
