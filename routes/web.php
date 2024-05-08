<?php


//use App\Http\Controllers\Usuarios\CompanyUserAbogadoController;

use App\Http\Controllers\BackupController;
use App\Http\Controllers\Casos\CasosController;
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
        return view('dashboard');
    })->name('dashboard');

    Route::resource('company_abogado_users', AbogadoController::class);
    Route::post('/company_abogado_users/search', [AbogadoController::class, 'search'])->name('company_abogado_users.search');
    Route::get('bitacoras/index', [BitacoraController::class, 'index']);
    Route::post('bitacoras/search', [BitacoraController::class, 'search'])->name('bitacoras.search');

    Route::get('/casos/index', [CasosController::class, 'index'])->name('casos.index');
    Route::get('/casos/crear', [CasosController::class, 'create'])->name('casos.create');
    Route::post('/casos/crear', [CasosController::class, 'store'])->name('casos.store');
    Route::get('/casos/{id}/show', [CasosController::class, 'show'])->name('casos.show');
    Route::get('/casos/{id}/edit', [CasosController::class, 'edit'])->name('casos.edit');
    Route::patch('/casos/{id}/update', [CasosController::class, 'update'])->name('casos.update');
    Route::delete('/casos/{id}/delete', [CasosController::class, 'destroy'])->name('casos.destroy');
    Route::post('/casos/search', [CasosController::class, 'search'])->name('casos.search');
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
});
