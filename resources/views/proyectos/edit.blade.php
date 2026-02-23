@extends('layouts.app')
@section('content')
    <div class="card shadow">
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                    <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h3>Editar proyecto</h3>
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" 
                            value="{{ $proyecto->nombre }}" 
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Descripcion</label>
                        <input type="text" name="descripcion" 
                            value="{{ $proyecto->descripcion }}" 
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Fecha_inicio</label>
                        <input type="date" name="fecha_inicio" 
                            value="{{ $proyecto->fecha_inicio }}" 
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>fecha_finalizacion</label>
                        <input type="date" name="fecha_fin" 
                            value="{{ $proyecto->fecha_fin }}" 
                            class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
