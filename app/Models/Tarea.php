<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'fecha_vencimiento', 'estado', 'prioridad', 'creador_id', 'categoria_id'];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function creador() {
        return $this->belongsTo(User::class, 'creador_id');
    }

    public function subtareas() {
        return $this->hasMany(Subtarea::class);
    }
    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }
    public function usuariosAsignados() {
        return $this->belongsToMany(User::class, 'tarea_user');
    }
}
