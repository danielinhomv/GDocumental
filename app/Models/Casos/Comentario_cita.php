<?php

namespace App\Models\Casos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario_cita extends Model
{
    use HasFactory;
    public $timestamp=false;
    protected $guarded=[];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
