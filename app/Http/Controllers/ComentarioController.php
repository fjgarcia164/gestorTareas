<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request, $tarea_id)
    {
        $request->validate(['contenido' => 'required']);

        Comentario::create([
            'contenido' => $request->contenido,
            'tarea_id' => $tarea_id,
            'user_id' => Auth::id(), // El usuario que escribe
        ]);

        return back()->with('success', 'Comentario publicado.');
    }
}