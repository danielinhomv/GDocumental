<?php

namespace App\Models\Documental;

use App\Models\Casos\Caso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $fillable=['nombre','descripcion', 'nota_adicional','ubicacion','eliminar'];
    public $timestamp=false;


    public function caso()
    {
        return $this->belongsTo(Caso::class);
    }

}
