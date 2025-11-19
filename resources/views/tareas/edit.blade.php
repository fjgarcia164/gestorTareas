    @extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">Editar Tarea: {{ $tarea->titulo }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" value="{{ $tarea->titulo }}" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-select" required>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ $tarea->categoria_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ $tarea->descripcion }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $tarea->fecha_vencimiento }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Prioridad</label>
                    <select name="prioridad" class="form-select">
                        <option value="baja" {{ $tarea->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
                        <option value="media" {{ $tarea->prioridad == 'media' ? 'selected' : '' }}>Media</option>
                        <option value="alta" {{ $tarea->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="pendiente" {{ $tarea->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_progreso" {{ $tarea->estado == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                        <option value="completada" {{ $tarea->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Actualizar Tarea</button>
            <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection