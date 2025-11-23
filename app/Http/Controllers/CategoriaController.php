<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
 
    
    public function index()
    {
        $categorias = Categoria::all();
        
        return view('categorias.index', compact('categorias'));
    }

   
    public function create()
    {
        return view('categorias.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255'
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría creada.');
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}