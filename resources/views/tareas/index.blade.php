@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Mis Tareas</h2>
    <a href="{{ route('tareas.create') }}" class="btn btn-primary">+ Nueva Tarea</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Vencimiento</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tareas as $tarea)
                <tr>
                    <td class="fw-bold">{{ $tarea->titulo }}</td>
                    
                    <td>
                        <span class="badge bg-info text-dark">{{ $tarea->categoria->nombre ?? 'Sin Categ.' }}</span>
                    </td>
                    
                    <td>{{ $tarea->fecha_vencimiento ?? '—' }}</td>
                    
                    <td>
                        @if($tarea->prioridad == 'alta') 
                            <span class="badge bg-danger">Alta</span>
                        @elseif($tarea->prioridad == 'media') 
                            <span class="badge bg-warning text-dark">Media</span>
                        @else 
                            <span class="badge bg-success">Baja</span>
                        @endif
                    </td>
                    
                    <td>
                        {{ ucfirst(str_replace('_', ' ', $tarea->estado)) }}
                    </td>
                    
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('tareas.show', $tarea->id) }}" class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                Ver
                            </a>
                            
                            <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                Editar
                            </a>

                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    X
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($tareas->isEmpty())
            <div class="text-center p-5 text-muted">
                <h4>No tienes tareas pendientes</h4>
                <p>¡Crea una nueva para empezar a organizarte!</p>
            </div>
        @endif
    </div>
</div>
@endsection