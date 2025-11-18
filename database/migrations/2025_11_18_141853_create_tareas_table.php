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
    Schema::create('tareas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->text('descripcion')->nullable();
        $table->date('fecha_vencimiento')->nullable();
        
        // Estados y Prioridad (usamos string o enum)
        $table->enum('estado', ['pendiente', 'en_progreso', 'completada'])->default('pendiente');
        $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media');
        
        // Claves Foráneas (Relaciones)
        // Relación con Usuarios (Creador)
        $table->foreignId('creador_id')->constrained('users')->onDelete('cascade');
        // Relación con Categorías
        $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
