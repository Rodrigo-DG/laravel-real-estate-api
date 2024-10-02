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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id'); // Identificador único de la persona
            $table->string('name'); // Nombre completo de la persona
            $table->string('email')->unique(); // Correo electrónico de la persona
            $table->string('phone')->nullable(); // Número de teléfono de la persona
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
