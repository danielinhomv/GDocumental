<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        // Crea una nueva entrada en la tabla de bitácoras
        if ($event->user) {
        Bitacora::create([
            'companyUser_id' => $event->user->id,
            'accion' => 'Cierre de sesión',
            'fecha_hora'=>Carbon::now('America/La_Paz')
        ]);
    }
    }
}
