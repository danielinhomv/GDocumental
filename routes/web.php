<?php

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

        Route::get('citas/{caso_id}',[CitaController::class,'index'])->name('citas.index');
        Route::get('citas/{caso_id}/{abogado_id}',[CitaController::class,'create'])->name('citas.create');
        Route::post('citas',[CitaController::class,'store'])->name('citas.store');

        Route::get('prueba',function(){
            return view('Casos/Citas/citaIndex');
        });
});
