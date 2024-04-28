<?php

namespace App\Models\Casos;

use App\Models\Documental\Expediente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id', 'nombre', 'descripcion', 'nota_adicionar'];
    public $timestamps = false;
    static $rules=[
       // 'cliente_id'=>'required',
        'nombre'=>'required',
        'descripcion'=>'required',
    ];
    
    /**
     * Obtener el usuario al que pertenece este caso.
     * tine un user 
     */
    public function abogado_user()
    {
        return $this->belongsTo(User::class, 'abogado_id');
    }

    public function cliente_user()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

}
