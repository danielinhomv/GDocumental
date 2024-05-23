<?php

use App\Http\Controllers\Casos\CasoController;
use App\Http\Controllers\Casos\CitaController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\Report\ReporteController;
use App\Http\Controllers\Usuarios\ClienteController;
use App\Http\Controllers\Usuarios\AbogadoController;
use App\Http\Controllers\Usuarios\BitacoraController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
    Route::get('/principal',[dashboardController::class,'principal'])->name('principal');
    Route::resource('company_abogado_users', AbogadoController::class);
    Route::post('/company_abogado_users/search', [AbogadoController::class, 'search'])->name('company_abogado_users.search');
    Route::get('bitacoras/index', [BitacoraController::class, 'index']);
    Route::post('bitacoras/search', [BitacoraController::class, 'search'])->name('bitacoras.search');

    Route::get('/casos/index', [CasoController::class, 'index'])->name('casos.index');
    Route::get('/casos/crear', [CasoController::class, 'create'])->name('casos.create');
    Route::post('/casos/crear', [CasoController::class, 'store'])->name('casos.store');
    Route::get('/casos/{id}/show', [CasoController::class, 'show'])->name('casos.show');
    Route::get('/casos/{id}/edit', [CasoController::class, 'edit'])->name('casos.edit');
    Route::patch('/casos/{id}/update', [CasoController::class, 'update'])->name('casos.update');
    Route::delete('/casos/{id}/delete', [CasoController::class, 'destroy'])->name('casos.destroy');
    Route::post('/casos/search', [CasoController::class, 'search'])->name('casos.search');
    Route::post('/casos/crear_cliente', [ClienteController::class, 'store'])->name('casos.cliente-store');


    Route::get('citas/index/{caso_id}', [CitaController::class, 'index'])->name('citas.index');
    Route::get('citas/create/{caso_id}', [CitaController::class, 'create'])->name('citas.create');
    Route::post('citas/store/{caso_id}', [CitaController::class, 'store'])->name('citas.store');
    Route::get('citas/show/{id}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('citas/edit/{id}', [CitaController::class, 'edit'])->name('citas.edit');
    Route::get('citas/destroy/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::patch('citas/update/{id}', [CitaController::class, 'update'])->name('citas.update');
    Route::post('citas/search', [CitaController::class, 'search'])->name('citas.search');
    Route::get('citas/usuario/{caso_id}', [CitaController::class, 'verUsuarioCliente'])->name('citas.usuarioCliente');
    Route::get('citas/usuario/perfil/{abogado_id}', [CitaController::class, 'verUsuarioAbogado'])->name('citas.usuarioAbogado');
    Route::get('test',[CitaController::class,'test']);
    Route::get('/prueba',function(){
        return view('prueba');
    });

    Route::get('reportes/index', [ReporteController::class, 'index'])->name('reporte.index');
    Route::post('reportes/ver', [ReporteController::class, 'ver'])->name('reporte.ver');

});
