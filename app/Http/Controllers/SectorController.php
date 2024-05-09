<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index(){
        return Sector::select('id', 'descripcion', 'letra_id')->get();
    }
}
