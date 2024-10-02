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
        Schema::create('visits', function (Blueprint $table) {
            $table->id(); // Identificador único de la solicitud de visita
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Relación con la tabla clients
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade'); // Relación con la tabla properties
            $table->date('visit_date'); // Fecha programada para la visita
            $table->text('comments')->nullable(); // Comentarios adicionales
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
