<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    // 1. LISTADO DE TAREAS
    public function index()
    {
        // Traemos las tareas con su categoría y creador para no hacer muchas consultas
        $tareas = Tarea::with(['categoria', 'creador'])->get();
        return view('tareas.index', compact('tareas'));
    }

    // 2. FORMULARIO DE CREACIÓN
    public function create()
    {
        // Necesitamos las categorías para el desplegable (<select>)
        $categorias = Categoria::all();
        // También usuarios para asignar (opcional por ahora)
        $usuarios = User::all();
        
        return view('tareas.create', compact('categorias', 'usuarios'));
    }

    // 3. GUARDAR EN BASE DE DATOS
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'titulo' => 'required|max:255',
            'categoria_id' => 'required|exists:categorias,id', // Debe existir en la tabla categorias
            'fecha_vencimiento' => 'nullable|date',
            'prioridad' => 'required',
        ]);

        // Guardar
        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'prioridad' => $request->prioridad,
            'estado' => 'pendiente', // Por defecto
            'categoria_id' => $request->categoria_id,
            'creador_id' => 1, // <--- TRUCO: Usamos el ID 1 (el usuario dummy) obligatoriamente
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada con éxito');
    }
    
    // (Dejamos show, edit, update, destroy para el siguiente paso)
     public function show(string $id) {}
     public function edit(string $id) {}
     public function update(Request $request, string $id) {}
     public function destroy(string $id) {}
}