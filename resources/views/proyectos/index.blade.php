@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Proyectos</h1>
        <a href="{{ route('proyectos.create') }}" class="btn btn-success">Crear Nuevo Proyecto</a>
    </div>

    {{-- Filtros --}}
    <form action="{{ route('proyectos.index') }}" method="GET" class="row g-3 mb-4 shadow-sm p-3 bg-light rounded">
        <div class="col-md-4">
            <label class="form-label fw-bold">Filtrar por Estado</label>
            <select name="estado" class="form-select" onchange="this.form.submit()">
                <option value="">Todos los proyectos</option>
                <option value="proceso" {{ request('estado') == 'proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>Finalizados</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <a href="{{ route('proyectos.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
        </div>
    </form>

    <table class="table table-hover shadow-sm mt-3">
        <thead class="table-dark mb-8">
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Fecha Inicio</th>
                <th class="text-center">Fecha Fin</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Tareas</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                @php
                    $hoy = now()->startOfDay();
                    $fechaFin = \Carbon\Carbon::parse($proyecto->fecha_fin)->startOfDay();
                    $estaVencido = $hoy->gt($fechaFin); 
                @endphp
                <tr>
                    <td><strong>{{ $proyecto->nombre }}</strong></td>
                    <td>{{ $proyecto->descripcion }}</td>
                    <td>{{ $proyecto->fecha_inicio }}</td>
                    <td>{{ $proyecto->fecha_fin }}</td>
                    <td>
                        <span class="badge {{ $estaVencido ? 'bg-danger' : 'bg-success' }}">
                            {{ $estaVencido ? 'Finalizado' : 'En proceso' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('proyectos.tareas.index', $proyecto->id) }}" class="btn btn-info btn-sm">Ver tareas</a>
                            @if(!$estaVencido)
                                <a href="{{ route('proyectos.tareas.create', $proyecto->id) }}" class="btn btn-primary btn-sm">Nueva tarea</a>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>Bloqueado</button>
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- PAGINACIÓN --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $proyectos->appends(request()->query())->links() }}
    </div>
</div>
@endsection