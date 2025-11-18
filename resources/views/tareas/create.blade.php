@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Nueva Tarea</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('tareas.store') }}" method="POST">
            @csrf 

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-select" required>
                        <option value="">Selecciona una...</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Prioridad</label>
                    <select name="prioridad" class="form-select">
                        <option value="baja">Baja</option>
                        <option value="media" selected>Media</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Guardar Tarea</button>
            <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection