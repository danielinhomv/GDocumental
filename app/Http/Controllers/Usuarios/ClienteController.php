<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
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
            $user = Auth::user()->empresa_id;
            $cliente = User::create($request->all());
            $cliente->rol = 'cliente';
            $cliente->empresa_id = $user;
            $cliente->password = bcrypt($cliente->password);
            $cliente->save();
            $result[] = ['id' => $cliente->id, 'name' => $cliente->name];


            return view('Casos.Caso.create', compact('result'))->with('success', 'registro exitoso');
        } catch (\Throwable $th) {
            return redirect()->route('casos.create')->with('error', $th->getMessage());
        }
    }
}
