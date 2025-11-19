@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">{{ $tarea->titulo }}</h3>
                <span class="badge bg-{{ $tarea->estado == 'completada' ? 'success' : 'warning' }}">
                    {{ ucfirst(str_replace('_', ' ', $tarea->estado)) }}
                </span>
            </div>
            <div class="card-body">
                <p class="lead">{{ $tarea->descripcion }}</p>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Categoría:</strong> {{ $tarea->categoria->nombre }}
                    </div>
                    <div class="col-md-4">
                        <strong>Vencimiento:</strong> {{ $tarea->fecha_vencimiento ?? 'Sin fecha' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Prioridad:</strong> 
                        <span class="text-{{ $tarea->prioridad == 'alta' ? 'danger' : ($tarea->prioridad == 'media' ? 'warning' : 'success') }}">
                            {{ ucfirst($tarea->prioridad) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Subtareas (Checklist)</div>
            <div class="card-body">
                <p class="text-muted">Aquí irán las subtareas...</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Comentarios</div>
            <div class="card-body">
                <p class="text-muted">Aquí irán los comentarios...</p>
            </div>
        </div>
    </div>
</div>
@endsection