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
        Schema::create('solicitudes', function (Blueprint $table) {
    $table->id();
    $table->string('oficina');
    $table->integer('cantidad_equipos');
    $table->enum('estado', ['Pendiente', 'Aprobada', 'Rechazada'])->default('Pendiente');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
    $table->timestamp('fecha_respuesta')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
