<?php

namespace App\Http\Controllers;

use App\Models\Subtarea;
use App\Models\Tarea;
use Illuminate\Http\Request;

class SubtareaController extends Controller
{
    public function store(Request $request, $tarea_id)
    {
        $request->validate(['titulo' => 'required|max:255']);
        
        Subtarea::create([
            'titulo' => $request->titulo,
            'tarea_id' => $tarea_id,
            'completada' => false
        ]);

        return back()->with('success', 'Subtarea añadida.');
    }

    public function update(Request $request, $id)
    {
        $subtarea = Subtarea::findOrFail($id);
        // Cambiamos el estado al contrario del que tenga (toggle)
        $subtarea->update(['completada' => !$subtarea->completada]);
        
        return back();
    }

    public function destroy($id)
    {
        Subtarea::findOrFail($id)->delete();
        return back()->with('success', 'Subtarea eliminada.');
    }
}