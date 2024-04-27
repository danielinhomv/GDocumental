<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Models\Casos\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($caso_id)
    {
        try {
            //code...
            $citas = Cita::where('caso_id', $caso_id);
            $abogado_id = Auth::id();
            return view('Casos/Citas/citaIndex', $citas, $caso_id, $abogado_id);
        } catch (\Throwable $th) {
            abort(403, 'Not found.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($caso_id, $abogado_id)
    {
        return view('Casos/Citas/citaCreate', $caso_id, $abogado_id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'abogado_id' => 'required|exists:users,id',
                'caso_id' => 'required|exists:casos,id',
                'descripcion' => 'required|string',
                'audio' => 'nullable|file|mimes:audio/mpeg,audio/wav', 
                'fecha_hora' => 'required|date',
            ]);
            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audioPath = $audio->store('audio'); 
            }
            $cita = new Cita();
            $cita->abogado_id = $request->abogado_id;
            $cita->caso_id = $request->caso_id;
            $cita->descripcion = $request->descripcion;
            $cita->audio_url = isset($audioPath) ? $audioPath : null;
            $cita->fecha_hora = $request->fecha_hora;
            $cita->eliminado = false;
            $cita->save();
            return redirect()->route('casos_cita.index', $cita->caso_id);
        } catch (\Throwable $th) {
            abort(403, 'Not found.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $cita = Cita::findOrFail($id);
            return view('citas.show', compact('cita'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('casos_cita.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
