<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function tareas() {
        return $this->hasMany(Tarea::class);
    }
}
