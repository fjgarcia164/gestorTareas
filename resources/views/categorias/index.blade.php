@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Categorías</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-success">Nueva Categoría</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary" disabled>Editar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($categorias->isEmpty())
                <div class="text-center mt-3 text-muted">No hay categorías creadas aún.</div>
            @endif
        </div>
    </div>
@endsection