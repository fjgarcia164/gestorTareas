<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtarea extends Model
{
    use HasFactory;
    // Permitir rellenar estos campos
    protected $fillable = ['titulo', 'completada', 'tarea_id'];

    public function tarea() {
        return $this->belongsTo(Tarea::class);
    }
}