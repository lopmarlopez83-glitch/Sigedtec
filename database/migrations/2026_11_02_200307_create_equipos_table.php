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
        Schema::create('equipos', function (Blueprint $table) {
    $table->id();
    $table->string('codigo_patrimonial')->unique();
    $table->string('marca');
    $table->string('modelo');
    $table->string('cpu')->nullable();
    $table->string('ram')->nullable();
    $table->string('almacenamiento')->nullable();
    $table->enum('estado', ['Disponible', 'Asignado', 'En Mantenimiento'])->default('Disponible');
    $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
    $table->softDeletes();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
