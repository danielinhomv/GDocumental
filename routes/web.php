<?php

use App\Http\Controllers\Casos\CasoController;
use App\Http\Controllers\Casos\CitaController;
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

    //es empresa
    Route::resource('company_abogado_users', AbogadoController::class);
    Route::post('/company_abogado_users/search', [AbogadoController::class, 'search'])->name('company_abogado_users.search');
    Route::get('bitacoras/index', [BitacoraController::class, 'index']);
    Route::post('bitacoras/search', [BitacoraController::class, 'search'])->name('bitacoras.search');

    Route::get('citas/index/{caso_id}', [CitaController::class, 'index'])->name('citas.index');
    Route::get('citas/create/{caso_id}', [CitaController::class, 'create'])->name('citas.create');
    Route::post('citas', [CitaController::class, 'store'])->name('citas.store');

    Route::get('/casos/index', [CasoController::class, 'index'])->name('casos.index');
    Route::get('/casos/crear', [CasoController::class, 'create'])->name('casos.create');
    Route::post('/casos/crear', [CasoController::class, 'store'])->name('casos.store');
    Route::get('/casos/{id}/show', [CasoController::class, 'show'])->name('casos.show');
    Route::get('/casos/{id}/edit', [CasoController::class, 'edit'])->name('casos.edit');
    Route::patch('/casos/{id}/update', [CasoController::class, 'update'])->name('casos.update');
    Route::delete('/casos/{id}/delete', [CasoController::class, 'destroy'])->name('casos.destroy');
    Route::post('/casos/search', [CasoController::class, 'search'])->name('casos.search');
});
