<?php

namespace App\Models\Documental;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamp=false;
}
