<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index(){
        $sectores = Sector::with('letra:id,descripcion')->select('id', 'descripcion', 'letra_id')->get();
        return $sectores;
    }
}
