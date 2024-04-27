<?php

use App\Http\Controllers\casoController;
use App\Http\Controllers\Usuarios\CompanyUserAbogadoController;
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

    //Route::resource('casos', casoController::class);
    // Route::resource('company_abogado_users', CompanyUserAbogadoController::class);
    //Route::post('/company_abogado_users/search', [CompanyUserAbogadoController::class, 'search'])->name('company_abogado_users.search');
});
