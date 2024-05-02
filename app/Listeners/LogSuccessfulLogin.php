<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;
use Carbon\Carbon;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        // Crea una nueva entrada en la tabla de bitácoras
        if ($event->user) {
        Bitacora::create([
            'companyUser_id' => $event->user->id,
            'ip'=>request()->ip(),
            'accion' => 'Inicio de sesión',
            'fecha_hora'=>Carbon::now('America/La_Paz')
        ]);
       }
    }
}

