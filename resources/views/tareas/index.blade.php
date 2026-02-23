@extends('layouts.app')

@section('content')
<div class="container py-4">
    @php
        $hoy = now()->startOfDay();
        $fechaFin = \Carbon\Carbon::parse($proyecto->fecha_fin)->startOfDay();
        $estaVencido = $hoy->gt($fechaFin); 
    @endphp

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Tareas: <strong>{{ $proyecto->nombre }}</strong></h1>
            <span class="badge {{ $estaVencido ? 'bg-danger' : 'bg-success' }}">
                {{ $estaVencido ? 'Proyecto Finalizado (Vencido)' : 'Proyecto en Proceso' }}
            </span>
        </div>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    <div class="mb-3">
        @if(!$estaVencido)
            <a href="{{ route('proyectos.tareas.create', $proyecto->id) }}" class="btn btn-primary">Nueva tarea</a>
        @else
            <button class="btn btn-secondary" disabled>No se admiten más tareas</button>
        @endif
    </div>

    {{-- Filtros (Corregido: Solo uno) --}}
    <form action="{{ route('proyectos.tareas.index', $proyecto->id) }}" method="GET" class="row g-3 mb-4 shadow-sm p-3 bg-light rounded">
        <div class="col-md-4">
            <label class="form-label fw-bold">Estado</label>
            <select name="estado" class="form-select" onchange="this.form.submit()">
                <option value="">Todos los estados</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_proceso" {{ request('estado') == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>Finalizada</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Prioridad</label>
            <select name="prioridad" class="form-select" onchange="this.form.submit()">
                <option value="">Todas las prioridades</option>
                <option value="Baja" {{ request('prioridad') == 'Baja' ? 'selected' : '' }}>Baja</option>
                <option value="Media" {{ request('prioridad') == 'Media' ? 'selected' : '' }}>Media</option>
                <option value="Alta" {{ request('prioridad') == 'Alta' ? 'selected' : '' }}>Alta</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <a href="{{ route('proyectos.tareas.index', $proyecto->id) }}" class="btn btn-outline-secondary w-100">Limpiar</a>
        </div>
    </form>

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Fecha límite</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ Str::limit($tarea->descripcion, 30) }}</td>
                    <td>
                        @php
                            $colorEstado = ['pendiente' => 'bg-warning text-dark', 'en_proceso' => 'bg-info text-dark', 'finalizado' => 'bg-success text-white'][$tarea->estado] ?? 'bg-secondary';
                        @endphp
                        <span class="badge {{ $colorEstado }}">{{ ucfirst($tarea->estado) }}</span>
                    </td>
                    <td>
                        <span class="fw-bold {{ $tarea->prioridad == 'Alta' ? 'text-danger' : 'text-primary' }}">
                            {{ $tarea->prioridad }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('proyectos.tareas.edit', [$proyecto->id, $tarea->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('proyectos.tareas.destroy', [$proyecto->id, $tarea->id]) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No hay tareas.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINACIÓN --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $tareas->appends(request()->query())->links() }}
    </div>
</div>
@endsection