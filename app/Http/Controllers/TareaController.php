<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TareaController extends Controller
{
    public function index(Request $request, Proyecto $proyecto)
    {
        $query = $proyecto->tareas();

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        $tareas = $query->orderBy('fecha_limite', 'asc')->paginate(10);

        return view('tareas.index', compact('proyecto', 'tareas'));
    }

    public function create(Proyecto $proyecto) 
    {
        $hoy = now()->startOfDay();
        $fechaFin = Carbon::parse($proyecto->fecha_fin)->startOfDay();

        // Bloqueo de seguridad
        if ($hoy->gt($fechaFin)) {
            return redirect()->route('proyectos.tareas.index', $proyecto->id)
                             ->with('error', 'No se pueden crear tareas: El proyecto ya venció.');
        }

        return view('tareas.create', compact('proyecto'));
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_limite' => 'required|date',
        ]);

        $data = $request->all();
        $data['proyecto_id'] = $proyecto->id;

        // Lógica de prioridad automática
        $hoy = now()->startOfDay();
        $fechaLimite = Carbon::parse($request->fecha_limite)->startOfDay();
        
        if ($hoy->diffInDays($fechaLimite, false) <= 3) {
            $data['prioridad'] = 'Alta';
        }

        $proyecto->tareas()->create($data);

        return redirect()->route('proyectos.tareas.index', $proyecto->id)
                         ->with('success', 'Tarea guardada correctamente.');
    }

    public function edit(Proyecto $proyecto, Tarea $tarea)
    {
        return view('tareas.edit', compact('proyecto', 'tarea'));
    }

    public function update(Request $request, Proyecto $proyecto, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_limite' => 'required|date',
        ]);

        $data = $request->all();
        $hoy = now()->startOfDay();
        $fechaLimite = Carbon::parse($request->fecha_limite)->startOfDay();
        
        if ($hoy->diffInDays($fechaLimite, false) <= 3) {
            $data['prioridad'] = 'Alta';
        }

        $tarea->update($data);

        return redirect()->route('proyectos.tareas.index', $proyecto->id)
                         ->with('success', 'Tarea actualizada');
    }

    public function destroy(Proyecto $proyecto, Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('proyectos.tareas.index', $proyecto->id)
                         ->with('success', 'Tarea eliminada');
    }
}