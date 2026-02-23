@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Crear un proyecto</h3>
                </div>
                <div class="card-body">
                    {{-- CAMBIO AQUÍ: La ruta debe ser proyectos.store y NO necesita ID --}}
                    <form action="{{ route('proyectos.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre del proyecto</label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha de Finalización</label>
                                <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
                            </div>
                        </div>

                        <div class="mt-3 text-end">
                            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Proyecto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection