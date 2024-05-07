<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Casos\Caso;
use App\Models\Casos\Cita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($caso_id)
    {
        User::esClienteOrAbogado();
        try {

            $citas = Cita::where('caso_id', $caso_id)
                ->where('eliminado', false)
                ->orderBy('fecha_creacion', 'desc')
                ->get();
            return view('Casos/Citas/citaIndex', compact('citas', 'caso_id'));
        } catch (\Throwable $th) {
            abort(403, 'Not found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($caso_id)
    {
        User::tieneRol('abogado');

        return view('Casos/Citas/citaCreate', compact('caso_id'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request, $caso_id)
    {
        User::tieneRol('abogado');

        try {
            Caso::existe($caso_id);
            $request->validate([
                'descripcion' => 'required|string',
                'fecha_hora' => 'required|date',
                'nota_adicional' => 'nullable',
            ]);
            $cita = new Cita();
            $cita->abogado_id = Auth::id();
            $cita->caso_id = $caso_id;
            $cita->descripcion = $request->descripcion;
            $cita->fecha_creacion = now('America/La_Paz');
            $cita->fecha_cierre = $request->fecha_hora;
            $cita->nota_adicional = $request->nota_adicional;
            $cita->save();
            Bitacora::log('Creación de una cita');
            return redirect()->route('citas.index', $cita->caso_id);
        } catch (\Throwable $th) {
            abort(403, $th->getMessage());
        }
    }

    public function show(string $id)
    {
        User::esClienteOrAbogado();
        try {
            $cita = Cita::existe($id);
            $abogado = User::find($cita->abogado_id);
            Bitacora::log('visita una cita');
            return view('Casos/Citas/citaShow', compact('cita', 'abogado'));
        } catch (\Throwable $th) {
            abort(403, 'Not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        User::tieneRol('abogado');
        try {
            $cita = Cita::existe($id);
            return view('Casos/Citas/citaEdit', compact('cita'));
        } catch (\Throwable $th) {
            abort(403, 'Not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        User::tieneRol('abogado');
        try {
            $cita = Cita::existe($id);
            $request->validate([
                'descripcion' => 'required|string',
                'fecha_hora' => 'required|date',
                'nota_adicional' => 'nullable',
            ]);
            $cita->descripcion = $request->descripcion;
            $cita->fecha_creacion = now('America/La_Paz');
            $cita->fecha_cierre = $request->fecha_hora;
            $cita->nota_adicional = $request->nota_adicional;
            $cita->save();
            Bitacora::log('actualizacion de una cita');
            return redirect()->route('citas.index', $cita->caso_id);
        } catch (\Throwable $th) {
            abort(403, $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::tieneRol('abogado');
        try {
            //code...
            $cita = Cita::existe($id);
            $cita->eliminado = true;
            $cita->save();
            Bitacora::log('eliminacion de una cita');
            return redirect()->route('citas.index', $cita->caso_id);
        } catch (\Throwable $th) {
            abort(403, 'Not found');
        }
    }
    // public function verUsuarioCliente(string $caso_id)
    // {
    //     User::tieneRol('abogado');
    //     try {
    //         //code...
    //         Caso::existe($caso_id);
    //         $caso = Caso::Find($caso_id);
    //         $usuario = User::findOrFail($caso->cliente_id);
    //         $usuario->estaEliminado();
    //         Bitacora::log('visito el perfil de su cliente');
    //         return view('Casos/Citas/citaUsuario', compact('usuario'));
    //     } catch (\Throwable $th) {
    //         abort(403, $th->getMessage());
    //     }
    // }
    public function verUsuarioAbogado(string $abogado_id){
        User::esClienteOrAbogado();
        try {
            $usuario = User::findOrFail($abogado_id);
            $usuario->estaEliminado();
            Bitacora::log('visito el perfil de abogado');
            return view('Casos/Citas/citaUsuario', compact('usuario'));
        } catch (\Throwable $th) {
            abort(403, $th->getMessage());
        }

    }
    public function search(Request $request){
        //
    }
}
