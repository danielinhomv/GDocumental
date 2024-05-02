<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bitacora extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps=false;

    public static function log($accion){
        self::create([
            'companyUser_id' => Auth::id(),
            'accion' => $accion,
            'fecha_hora'=>Carbon::now('America/La_Paz')
        ]);
    }
}

