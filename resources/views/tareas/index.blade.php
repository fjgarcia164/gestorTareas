@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Mis Tareas</h2>
    <a href="{{ route('tareas.create') }}" class="btn btn-primary">+ Nueva Tarea</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Vencimiento</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->titulo }}</td>
                    
                    <td>
                        <span class="badge bg-info text-dark">{{ $tarea->categoria->nombre ?? 'Sin Categ.' }}</span>
                    </td>
                    
                    <td>{{ $tarea->fecha_vencimiento ?? 'N/A' }}</td>
                    
                    <td>
                        @if($tarea->prioridad == 'alta') <span class="text-danger fw-bold">Alta</span>
                        @elseif($tarea->prioridad == 'media') <span class="text-warning fw-bold">Media</span>
                        @else <span class="text-success">Baja</span>
                        @endif
                    </td>
                    
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary">Ver</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($tareas->isEmpty())
            <div class="text-center p-4">No hay tareas registradas aún.</div>
        @endif
    </div>
</div>
@endsection