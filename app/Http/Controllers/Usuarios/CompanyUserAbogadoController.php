<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class CompanyUserAbogadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $companyUsers = CompanyUser::where('rol', 'abogado')
            ->where('eliminado', false)
            ->where('empresa_id',$id)
            ->get();
        return view('Usuarios/abogadoIndex', compact('companyUsers'));
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
        $request->validate([
            'empresa_id' => 'required|exists:users,id',
            'nombre_completo' => 'required',
            'registro' => 'required',
            'contraseña' => 'required|min:8',
            'rol' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'nota_adicional' => 'nullable',
        ]);

        CompanyUser::create($request->all());

        return redirect()->route('company_abogado_users.index')
            ->with('success', 'Usuario de empresa creado correctamente.');
    }
    public function edit(CompanyUser $companyUser)
    {
        try {
            $companyUser = CompanyUser::findOrFail($companyUser->id);
            return view('Usuarios/abogadoEdit', compact('companyUser'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('company_abogado_users.index')->with('error', 'El usuario de empresa no fue encontrado.');
        }
    }
    public function show(CompanyUser $companyUser)
    {
        try {
            $companyUser = CompanyUser::findOrFail($companyUser->id);
            return view('Usuarios/abogadoShow', compact('companyUser'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('company_abogado_users.index')->with('error', 'El usuario de empresa no fue encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyUser $companyUser)
    {
        try {
            $request->validate([
                'empresa_id' => 'required|exists:users,id',
                'nombre_completo' => 'required',
                'registro' => 'required',
                'contraseña' => 'required|min:8',
                'rol' => 'required',
                'direccion' => 'required',
                'telefono' => 'required',
                'nota_adicional' => 'nullable',
            ]);

            $companyUser->update($request->all());

            return redirect()->route('company_abogado_users.index')
                ->with('success', 'Usuario de empresa actualizado correctamente');
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
            $companyUser = CompanyUser::find($id);
            $companyUser->delete();
            return redirect()->route('company_abogado_users.index')
                ->with('success', 'Usuario de empresa eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('company_abogado_users.index')->with('error', $th->getMessage());
        }
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $companyAbogadoUsers = CompanyUser::where('nombre_completo', 'like', '%' . $search . '%');
        return view('company_abogado_users.index', compact('companyAbogadoUsers'));
    }
}
