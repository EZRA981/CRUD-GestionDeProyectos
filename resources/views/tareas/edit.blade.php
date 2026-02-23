@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    {{-- Mostramos el nombre de la tarea y el proyecto --}}
                    <h3 class="mb-0">Editando: <strong>{{ $tarea->titulo }}</strong></h3>
                    <small>Proyecto: {{ $proyecto->nombre }}</small>
                </div>
                <div class="card-body">
                    {{-- Cambiamos a la ruta 'update' y pasamos ambos parámetros [$proyecto, $tarea] --}}
                    <form action="{{ route('proyectos.tareas.update', [$proyecto, $tarea]) }}" method="POST">
                        @csrf
                        {{-- Laravel necesita @method('PUT') para procesar actualizaciones --}}
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Título de la Tarea</label>
                            <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" 
                                   value="{{ old('titulo', $tarea->titulo) }}" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prioridad</label>
                                <select name="prioridad" class="form-select">
                                    <option value="Baja" {{ $tarea->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
                                    <option value="Media" {{ $tarea->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                                    <option value="Alta" {{ $tarea->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="pendiente" {{ $tarea->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en_proceso" {{ $tarea->estado == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                                    <option value="finalizado" {{ $tarea->estado == 'finalizado' ? 'selected' : '' }}>Finalizada</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha Límite</label>
                                <input type="date" name="fecha_limite" class="form-control" 
                                       value="{{ old('fecha_limite', $tarea->fecha_limite) }}" required>
                            </div>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="{{ route('proyectos.tareas.index', $proyecto) }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning">Actualizar Tarea</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection