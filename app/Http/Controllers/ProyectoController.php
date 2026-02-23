<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// app/Http/Controllers/TareaController.php

    public function index(Request $request)
    {
        $hoy = now()->startOfDay();
        $query = Proyecto::query();

        if ($request->filled('estado')) {
            if ($request->estado === 'finalizado') {
                $query->where('fecha_fin', '<', $hoy);
            } else {
                $query->where('fecha_fin', '>=', $hoy);
            }
        }

        $proyectos = $query->orderBy('fecha_fin', 'asc')->paginate(10);
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create'); 
    }

    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',             
            'descripcion' => 'nullable|string|max:255', 
            'fecha_inicio' => 'required|date',          
            'fecha_fin' => 'required|date', 
        ]);
        Proyecto::create($datosValidados);

        return redirect()->route('proyectos.index')->with('success','Se ha creado el proyecto');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
        {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        return  view('proyectos.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $DatosValidados = $request->validate([
        'nombre' => 'required|string|max:255',             
        'descripcion' => 'nullable|string|max:255',
        'fecha_inicio' => 'required|date',          
        'fecha_fin' => 'required|date', 

        ]);    

        $proyecto -> update($request->all(), $request->all());
        return redirect()->route('proyectos.index')->with('success','Proyecto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto -> delete();
        return redirect()->route('proyectos.index')->with('success','Se ha eliminado el proyecto');
    }
}
