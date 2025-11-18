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
    Schema::create('comentarios', function (Blueprint $table) {
        $table->id();
        $table->text('contenido');
        
        // Relaciones: Pertenece a una Tarea y a un Usuario
        $table->foreignId('tarea_id')->constrained('tareas')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
