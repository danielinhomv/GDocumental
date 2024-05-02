<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbogadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            User::tieneRol(null); 
            return $next($request);
        });
    }
    public function index()
    {
        $abogados = User::where('empresa_id', Auth::id())
            ->where('rol', 'abogado')
            ->where('eliminado', null)
            ->get();
        return view('Usuarios/abogadoIndex', compact('abogados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Usuarios/abogadoCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'name' => 'required',
                'nombre_completo' => 'required',
                'email' => 'required',
                'password' => 'required|min:8',
                'direccion' => 'required',
                'telefono' => 'required',
                'nota_adicional' => 'nullable',
            ]);
            $abogado = User::create($request->all());
            $abogado->rol = 'abogado';
            $abogado->password = bcrypt($abogado->password);
            $abogado->empresa_id = Auth::id();
            $abogado->save();
            Bitacora::log('creacion de abogado');
            return redirect()->route('company_abogado_users.index')->with('success', 'registro exitoso');
        } catch (\Throwable $th) {
            return redirect()->route('company_abogado_users.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $abogado = User::findOrFail($id);
            $abogado->estaEliminado($id);
            Bitacora::log('visita un abogado');
            return view('Usuarios/abogadoShow', compact('abogado'));
        } catch (\Throwable $th) {
            return redirect()->route('company_abogado_users.index')->with('success', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $abogado = User::findOrFail($id);
            $abogado->estaEliminado($id);
            return view('Usuarios/abogadoEdit', compact('abogado'));
        } catch (\Throwable $th) {
            return redirect()->route('company_abogado_users.index')->with('success', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nombre_completo' => 'required',
                'direccion' => 'required',
                'telefono' => 'required',
                'nota_adicional' => 'nullable',
            ]);
            $abogado = User::findOrFail($id);
            $abogado->estaEliminado($id);
            $abogado->fill($request->all());
            $abogado->save();
            Bitacora::log('actualizacion de abogado');
            return redirect()->route('company_abogado_users.index')->with('actualizacion exitosa');
        } catch (\Throwable $th) {
            return redirect()->route('company_abogado_users.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $abogado = User::findOrFail($id);
            $abogado->estaEliminado($id);
            $abogado->delete();
            Bitacora::log('eliminacion de abogado');
            return redirect()->route('company_abogado_users.index')->with('sucess', 'elimacion exitosa');
        } catch (\Throwable $th) {
            return redirect()->route('company_abogado_users.index')->with('error', $th->getMessage());
        }
    }
    public function search(Request $request)
    {
        Bitacora::log('busqueda de abogado');
        $search = $request->get('search');
        $abogados = User::where('nombre_completo', 'like', '%' . $search . '%')
            ->where('rol', 'abogado')
            ->where('empresa_id', Auth::id())
            ->where('eliminado', null)
            ->get();
        return view('Usuarios/abogadoIndex', compact('abogados'));
    }
}
