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
    Schema::create('subtareas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->boolean('completada')->default(false);
        
        // Relación: Una subtarea pertenece a una Tarea
        $table->foreignId('tarea_id')->constrained('tareas')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtareas');
    }
};
