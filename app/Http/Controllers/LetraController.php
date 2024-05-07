<?php

namespace App\Http\Controllers;

use App\Models\Letra;
use Illuminate\Http\Request;

class LetraController extends Controller
{
    public function index(){
        $letra = Letra::find(4);
        return $letra->descripcion;
    }
}
