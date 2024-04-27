<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;
use Carbon\Carbon;

class LogSuccessfulRegistration
{
    public function handle(Registered $event)
    {
        // Crea una nueva entrada en la tabla de bitácoras
        if ($event->user) {
        Bitacora::create([
            'companyUser_id' => $event->user->id,
            'accion' => 'Registro de empresa',
            'fecha_hora'=>Carbon::now('America/La_Paz')
        ]);
    }
    }
}
