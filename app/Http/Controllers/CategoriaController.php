<?php

namespace App\Http\Controllers;

use App\Models\Categoria; // <--- Importante
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Muestra la lista de categorías.
     * Este es el método "index" que Laravel no encontraba.
     */
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();
        
        // Devolver la vista pasando los datos
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Guarda la nueva categoría en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar
        $request->validate([
            'nombre' => 'required|max:255'
        ]);

        // 2. Guardar
        Categoria::create($request->all());

        // 3. Redirigir
        return redirect()->route('categorias.index')->with('success', 'Categoría creada.');
    }

    // Métodos vacíos para que no falle si intentas acceder a rutas de edición/borrado
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}