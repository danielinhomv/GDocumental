<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            User::tieneRol(null);
            return $next($request);
        });
    }

    public function index()
    {
        $abogados = $this->abogados();
        return view('Report/reporteIndex', compact('abogados'));
    }
    private function abogados()
    {
        $abogados = User::where('empresa_id', Auth::id())
            ->where('rol', 'abogado')
            ->where('eliminado', false)
            ->get();
        return $abogados;
    }
    public function ver(Request $request)
    {
        $tipoReporte = $request->tipo_reporte;
        $respuesta = null;
        $abogados = $this->abogados();
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;
        switch ($tipoReporte) {
            case 'clientes':
                $filtro = $request->filtro_cliente_casos;
                if ($filtro == 'todas') {
                    $respuesta = User::where('empresa_id', Auth::id())
                        ->where('rol', 'cliente')
                        ->where('eliminado', false)
                        ->get();
                } else {
                    $abogado_id = $request->abogado;

                    if ($abogado_id != '0') {
                        $respuesta = User::join('casos', 'users.id', 'casos.abogado_id')
                            ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                            ->where('users.empresa_id', Auth::id())
                            ->where('casos.abogado_id', $abogado_id)
                            ->distinct('cliente.email')
                            ->select('cliente.*')
                            ->get();
                    }
                }
                break;
            case 'casos':
                $filtro = $request->filtro_cliente_casos;
                if ($fechaInicio != null) {
                    $fechaInicio = date('Y-m-d H:i:s', strtotime($fechaInicio));
                }
                if ($fechaFin != null) {
                    $fechaFin = date('Y-m-d H:i:s', strtotime($fechaFin));
                }
                if ($filtro == 'todas') {
                    switch (true) {
                        case ($fechaInicio != null && $fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->whereBetween('casos.fecha_apertura', [$fechaInicio, $fechaFin])
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();


                            break;
                        case ($fechaInicio != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.fecha_apertura', '>=', $fechaInicio)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();
                            break;
                        case ($fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.fecha_apertura', '<=', $fechaFin)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();
                            break;
                        default:
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();
                            break;
                    }
                } else {
                    $abogado_id = $request->abogado;
                    switch (true) {
                        case ($fechaInicio != null && $fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('casos.abogado_id', $abogado_id)
                                ->where('users.empresa_id', Auth::id())
                                ->whereBetween('casos.fecha_apertura', [$fechaInicio, $fechaFin])
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();
                            break;
                        case ($fechaInicio != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('casos.abogado_id', $abogado_id)
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.fecha_apertura', '>=', $fechaInicio)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();
                            break;
                        case ($fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('casos.abogado_id', $abogado_id)
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.fecha_apertura', '<=', $fechaFin)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();
                            break;
                        default:
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('casos.abogado_id', $abogado_id)
                                ->where('users.empresa_id', Auth::id())
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'casos.*')
                                ->get();
                            break;
                    }
                }
                break;


            default:
                $filtro = $request->filtro_citas;
                if ($fechaInicio != null) {
                    $fechaInicio = date('Y-m-d H:i:s', strtotime($fechaInicio));
                }
                if ($fechaFin != null) {
                    $fechaFin = date('Y-m-d H:i:s', strtotime($fechaFin));
                }
                if ($filtro == 'todas') {
                    switch (true) {
                        case ($fechaInicio != null && $fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->whereBetween('citas.fecha_creacion', [$fechaInicio, $fechaFin])
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();

                            break;
                        case ($fechaInicio != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('citas.fecha_creacion', '>=', $fechaInicio)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();
                            break;
                        case ($fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('citas.fecha_creacion', '<=', $fechaFin)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();
                            break;
                        default:
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();
                            break;
                    }
                } else {
                    $abogado_id = $request->abogado;
                    switch (true) {
                        case ($fechaInicio != null && $fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.abogado_id', $abogado_id)
                                ->whereBetween('citas.fecha_creacion', [$fechaInicio, $fechaFin])
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();

                            break;
                        case ($fechaInicio != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.abogado_id', $abogado_id)
                                ->where('citas.fecha_creacion', '>=', $fechaInicio)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();


                            break;
                        case ($fechaFin != null):
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.abogado_id', $abogado_id)
                                ->where('citas.fecha_creacion', '<=', $fechaFin)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();


                            break;
                        default:
                            $respuesta = User::join('casos', 'casos.abogado_id', 'users.id')
                                ->join('citas', 'casos.id', 'citas.caso_id')
                                ->join('users as cliente', 'casos.cliente_id', 'cliente.id')
                                ->where('users.empresa_id', Auth::id())
                                ->where('casos.abogado_id', $abogado_id)
                                ->select('users.nombre_completo as abogado', 'cliente.nombre_completo as cliente', 'citas.*')
                                ->get();

                            break;
                    }
                }
                break;
        }
        return view('Report/reporteShow', compact('respuesta', 'tipoReporte', 'abogados'));
    }
}
