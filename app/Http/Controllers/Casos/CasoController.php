<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;

use App\Models\Casos\Caso;
use App\Models\Documental\Expediente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CasoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //brrr
        $user = Auth::user();
        $result = [];
        if ($user->empresa_id != null) {
            if ($user->rol == 'cliente') {
                $casos = $user->cliente_user; // Obtiene todos los casos asociados a este abogado
            } else {
                $casos = $user->abogado_user;
            }

            foreach ($casos as $caso) {

                if ($caso->eliminado == false) {
                    if ($user->rol == 'cliente') {
                        $cliente = $caso->abogado_user; // Obtiene todos los casos asociados a este abogado
                    } else {
                        $cliente = $caso->cliente_user;
                    }
                    $result[] = [
                        'nombre' => $caso->nombre,
                        'nombre_cliente' => $cliente->name,
                        'descripcion' => $caso->descripcion,
                        'estado' => $caso->estado,
                        'id' => $caso->id,
                    ];
                }
            }
            return view('Casos.Casos.index', compact('result'));
        } else {

            $hijos = $user->children_empresa; // conseguimos todos los usuario hijos de la empresa
            foreach ($hijos as $hijo) {

                $casos = $hijo->abogado_user; // Obtiene todos los casos asociados a este abogado  
                foreach ($casos as $caso) {

                    if ($caso->eliminado == false) {
                        $cliente = $caso->cliente_user;
                        $result[] = [ //'abogado_nombre'=>$hijo->name,
                            'nombre_abogado' => $hijo->name,
                            'nombre_cliente' => $cliente->name,
                            'nombre' => $caso->nombre,
                            'descripcion' => $caso->descripcion,
                            'estado' => $caso->estado,
                            'id' => $caso->id,
                        ];
                    }
                }
            }
            return view('Casos.Casos.index', compact('result'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $id = $user->empresa_id;
        $empresa = User::find($id);
        $clientes = $empresa->children_empresa;
        $result = [];
        foreach ($clientes as $lis) {
            if ($lis->rol == 'cliente') {
                $result[] = ['id' => $lis->id, 'name' => $lis->name];
            }
        }
        return view('Casos.Casos.create', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(Caso::$rules);
        $caso = new Caso;

        $caso->abogado_id = Auth::id(); // Aquí obtenemos el ID del usuario autenticado
        $caso->cliente_id = $request->cliente_id;
        $caso->nombre = $request->nombre;
        $caso->descripcion = $request->descripcion;
        $caso->nota_adicional = $request->nota_adicional;
        $caso->fecha_apertura = Carbon::now('America/La_Paz');

        $caso->save();

        $expediente = new Expediente;
        $expediente->caso_id = $caso->id;
        $expediente->nombre = $caso->nombre;
        $expediente->descripcion = $caso->descripcion;
        $expediente->fecha_creacion = $caso->fecha_apertura;
        $expediente->save();



        return redirect()->route('casos.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $caso = Caso::find($id);
        $abogado = $caso->abogado_user->name;
        $cliente = $caso->cliente_user->name;
        if (!$caso) {
            return redirect()->route('casos.index')
                ->withErrors(__('´Recursos no encontrado'));
        }
        return view('Casos.Casos.show', compact('caso', 'abogado', 'cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $user = Caso::find($id);
        return view('Casos.Casos.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate(Caso::$rules);
        $caso = Caso::find($id);

        $caso->nombre = $request->nombre;
        $caso->descripcion = $request->descripcion;
        $caso->fecha_apertura = Carbon::now('America/La_Paz');
        $caso->save();
        return redirect()->route('casos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Caso::find($id);
        $user->eliminado = true;
        $user->save();

        return redirect()->route('casos.index')
            ->withSuccess(__('User deleted successfully.'));
    }


    public function search(Request $request)
    {
        $user = Auth::user();
        if ($user->rol == 'cliente') {
            $casos = $user->cliente_user; // Obtiene todos los casos asociados a este abogado
        } elseif ($user->rol == 'abogado') {
            $casos = $user->abogado_user;
        } else {
            $casos = Caso::all();
        }

        $a = User::all();
        $search = $request->get('search');
        $result = collect();
        foreach ($casos as $caso) {
            $nombre = $caso->abogado_user->name;
            if (str_contains($caso->nombre, $search)) {
                $caso->nombre_abogado = $nombre;
                $result->push($caso);
            }
        }
        return view('Casos.Casos.index', compact('result'));
    }

}
