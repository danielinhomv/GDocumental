<?php

use App\Http\Controllers\casoController;
//use App\Http\Controllers\Usuarios\CompanyUserAbogadoController;
use App\Http\Controllers\Casos\CitaController;
use App\Http\Controllers\Usuarios\AbogadoController;
use App\Http\Controllers\Usuarios\BitacoraController;
use App\Http\Controllers\Usuarios\CompanyUserAbogadoController;
use App\Models\User;
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
Auth::routes(['verify' => false]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    
    Route::get('/casos/index', [App\Http\Controllers\Casos\casoController::class, 'index'])->name('casos.index');
    Route::get('/casos/crear', [App\Http\Controllers\Casos\casoController::class, 'create'])->name('casos.create');
    Route::post('/casos/crear', [App\Http\Controllers\Casos\casoController::class, 'store'])->name('casos.store');
    Route::get('/casos/{id}/show',[App\Http\Controllers\Casos\casoController::class, 'show'])->name('casos.show');
    Route::get('/casos/{id}/edit',[App\Http\Controllers\Casos\casoController::class, 'edit'])->name('casos.edit');
    Route::patch('/casos/{id}/update',[App\Http\Controllers\Casos\casoController::class, 'update'])->name('casos.update');
    Route::delete('/casos/{id}/delete',[App\Http\Controllers\Casos\casoController::class, 'destroy'])->name('casos.destroy');
    Route::post('/casos/search', [App\Http\Controllers\Casos\casoController::class, 'search'])->name('casos.search');
    Route::post('/casos/crear_cliente', [App\Http\Controllers\Casos\clienteController::class, 'store'])->name('casos.cliente-store');

    //Route::resource('casos', casoController::class);
    // Route::resource('company_abogado_users', CompanyUserAbogadoController::class);
    //Route::post('/company_abogado_users/search', [CompanyUserAbogadoController::class, 'search'])->name('company_abogado_users.search');
//es empresa
        Route::resource('company_abogado_users', AbogadoController::class);
        Route::post('/company_abogado_users/search', [AbogadoController::class, 'search'])->name('company_abogado_users.search');
        Route::get('bitacoras/index', [BitacoraController::class, 'index']);
        Route::post('bitacoras/search', [BitacoraController::class, 'search'])->name('bitacoras.search');

        Route::get('citas/{caso_id}',[CitaController::class,'index'])->name('citas.index');
        Route::get('citas/{caso_id}/{abogado_id}',[CitaController::class,'create'])->name('citas.create');
        Route::post('citas',[CitaController::class,'store'])->name('citas.store');

        Route::get('prueba',function(){
            return view('Casos/Citas/citaIndex');
        });
});
