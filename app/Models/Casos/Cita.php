<?php

namespace App\Models\Casos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamp=false;
}
