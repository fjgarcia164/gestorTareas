<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    
    public function index()
    {
        $tareas = Tarea::where('creador_id', Auth::id())
                       ->with('categoria')
                       ->get();

        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('tareas.create', compact('categorias'));
    }

    
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
            'creador_id' => Auth::id(),
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada con éxito');
    }

    public function show(string $id)
    {
        
        $tarea = Tarea::where('id', $id)
                      ->where('creador_id', Auth::id())
                      ->with(['categoria', 'subtareas', 'comentarios'])
                      ->firstOrFail();

        return view('tareas.show', compact('tarea'));
    }

    public function edit(string $id)
    {
        $tarea = Tarea::where('id', $id)
                      ->where('creador_id', Auth::id())
                      ->firstOrFail();

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

        $tarea = Tarea::where('id', $id)
                      ->where('creador_id', Auth::id())
                      ->firstOrFail();
        
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
        $tarea = Tarea::where('id', $id)
                      ->where('creador_id', Auth::id())
                      ->firstOrFail();

        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }
}