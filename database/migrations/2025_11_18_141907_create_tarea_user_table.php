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
    Schema::create('tarea_user', function (Blueprint $table) {
        $table->id();
        
        // Las dos llaves foráneas
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
        Schema::dropIfExists('tarea_user');
    }
};
