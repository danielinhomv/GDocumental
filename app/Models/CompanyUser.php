<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamp = false;

    public function getEmpresa()
    {
        return $this->belongsTo(User::class);
    }

    public function getBitacoras()
    {
        return $this->hasMany(Bitacora::class);
    }
    static function generarRegistro($id)
    {
        $anioActual = date('Y');
        $combinacion = mt_rand(100, 999);
        $registro = $anioActual . $id . $combinacion;
        return (string)$registro;
    }
}
