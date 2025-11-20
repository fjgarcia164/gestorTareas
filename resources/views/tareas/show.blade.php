@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                <h3 class="mb-0 h5">{{ $tarea->titulo }}</h3>
                <span class="badge bg-light text-dark">{{ ucfirst($tarea->estado) }}</span>
            </div>
            <div class="card-body">
                <p>{{ $tarea->descripcion }}</p>
                <hr>
                <div class="d-flex justify-content-between text-muted small">
                    <span>Categoría: <strong>{{ $tarea->categoria->nombre }}</strong></span>
                    <span>Vencimiento: <strong>{{ $tarea->fecha_vencimiento }}</strong></span>
                    <span>Prioridad: <strong>{{ ucfirst($tarea->prioridad) }}</strong></span>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">Checklist / Subtareas</div>
            <div class="card-body">
                <form action="{{ route('subtareas.store', $tarea->id) }}" method="POST" class="d-flex gap-2 mb-3">
                    @csrf
                    <input type="text" name="titulo" class="form-control" placeholder="Añadir nueva subtarea..." required>
                    <button type="submit" class="btn btn-primary btn-sm">Añadir</button>
                </form>

                <ul class="list-group list-group-flush">
                    @foreach($tarea->subtareas as $subtarea)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <form action="{{ route('subtareas.update', $subtarea->id) }}" method="POST" class="me-2">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $subtarea->completada ? 'btn-success' : 'btn-outline-secondary' }}" style="width: 25px; height: 25px; padding: 0;">
                                        {{ $subtarea->completada ? '✓' : '' }}
                                    </button>
                                </form>
                                <span class="{{ $subtarea->completada ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $subtarea->titulo }}
                                </span>
                            </div>
                            
                            <form action="{{ route('subtareas.destroy', $subtarea->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm text-danger">×</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">Comentarios</div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                @foreach($tarea->comentarios as $comentario)
                    <div class="mb-3 border-bottom pb-2">
                        <div class="d-flex justify-content-between">
                            <strong class="small">{{ $comentario->user->name }}</strong>
                            <span class="text-muted" style="font-size: 0.75rem;">{{ $comentario->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mb-0 small text-secondary">{{ $comentario->contenido }}</p>
                    </div>
                @endforeach

                @if($tarea->comentarios->isEmpty())
                    <p class="text-center text-muted small my-4">No hay comentarios aún.</p>
                @endif
            </div>
            <div class="card-footer bg-white">
                <form action="{{ route('comentarios.store', $tarea->id) }}" method="POST">
                    @csrf
                    <textarea name="contenido" class="form-control form-control-sm mb-2" rows="2" placeholder="Escribe un comentario..." required></textarea>
                    <button type="submit" class="btn btn-primary btn-sm w-100">Enviar Comentario</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection