@extends('layouts.app')

@section('content')
    <h1>Crear Categoría</h1>
    
    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Categoría</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection