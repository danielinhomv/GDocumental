<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BitacoraController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            User::tieneRol(null); // Cambia 'admin' por el rol requerido
            return $next($request);
        });
    }
    public function index()
    {
        $bitacoras = Bitacora::select('bitacoras.*', 'users.name', 'users.rol')
            ->join('users', 'bitacoras.companyUser_id', '=', 'users.id')
            ->where('users.id', Auth::id())
            ->orWhere('users.empresa_id', Auth::id())
            ->orderBy('bitacoras.fecha_hora', 'desc')
            ->get();
        return view('Usuarios/bitacora', compact('bitacoras'));
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $bitacoras = Bitacora::select('bitacoras.*', 'users.name', 'users.rol')
            ->join('users', 'bitacoras.companyUser_id', '=', 'users.id')
            ->where('users.name', $search)
            ->Where('users.empresa_id', Auth::id())
            //->orWhere('users.id', '=', Auth::id())
            ->get();
        Bitacora::log('busqueda de un usuario en bitacoras');
        return view('Usuarios/bitacora', compact('bitacoras'));
    }
}
