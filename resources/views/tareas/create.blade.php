@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Crear Tarea para: {{ $proyecto->nombre }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('proyectos.tareas.store', ['proyecto' => $proyecto->id]) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Título de la Tarea</label>
                            <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prioridad</label>
                                <select name="prioridad" class="form-select">
                                    <option value="Baja" {{ old('prioridad') == 'Baja' ? 'selected' : '' }}>Baja</option>
                                    <option value="Media" {{ old('prioridad') == 'Media' || !old('prioridad') ? 'selected' : '' }}>Media</option>
                                    <option value="Alta" {{ old('prioridad') == 'Alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en_proceso" {{ old('estado') == 'en_proceso' || !old('estado') ? 'selected' : '' }}>En proceso</option>
                                    <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizada</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha Límite</label>
                                <input type="date" name="fecha_limite" class="form-control" value="{{ old('fecha_limite') }}" required>
                            </div>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="{{ route('proyectos.tareas.index', ['proyecto' => $proyecto->id]) }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Tarea</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection