<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            User::tieneRol(null); 
            return $next($request);
        });
    }
    public function principal(){
        return view('dashboard');
    }
}
