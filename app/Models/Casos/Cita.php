<?php

namespace App\Models\Casos;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamp=false;
    public static function existe($id)
    {
        $cita=null;
        try {
            $cita = self::findOrFail($id);
            if ($cita->eliminado) {
                throw new Exception('la cita está eliminada.');
            }
        
        } catch (\Throwable $th) {
            throw new Exception('La cita no existe.');
        }
        return $cita;
    }
}
