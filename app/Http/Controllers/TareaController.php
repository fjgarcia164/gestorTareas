<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- IMPORTANTE: Añadir esto

class TareaController extends Controller
{
    /**
     * Muestra SOLO las tareas del usuario conectado.
     */
    public function index()
    {
        // Filtramos por creador_id = ID del usuario actual
        $tareas = Tarea::where('creador_id', Auth::id())
                        ->with(['categoria', 'creador'])
                        ->get();
                        
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('tareas.create', compact('categorias'));
    }

    /**
     * Guarda la tarea asignándole el ID del usuario conectado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'prioridad' => 'required',
        ]);

        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'prioridad' => $request->prioridad,
            'estado' => 'pendiente',
            'categoria_id' => $request->categoria_id,
            'creador_id' => Auth::id(), // <--- AQUÍ ESTÁ EL CAMBIO (Ya no es 1)
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada con éxito');
    }

    public function show(string $id)
    {
        // Usamos findOrFail para dar error 404 si no existe
        // IMPORTANTE: En una app real, aquí comprobaríamos si la tarea pertenece al usuario
        $tarea = Tarea::with(['categoria', 'subtareas', 'comentarios'])->findOrFail($id);
        return view('tareas.show', compact('tarea'));
    }

    public function edit(string $id)
    {
        $tarea = Tarea::findOrFail($id);
        $categorias = Categoria::all();
        return view('tareas.edit', compact('tarea', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'prioridad' => 'required',
            'estado' => 'required'
        ]);

        $tarea = Tarea::findOrFail($id);
        
        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada.');
    }

    public function destroy(string $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }
}