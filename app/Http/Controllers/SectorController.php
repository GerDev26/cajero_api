<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index(){
        $sectores = Sector::with('letra')->get();
        $sectoresMap = $sectores->map(function($sector){
            return [
                'sector_id' => $sector->id,
                'letra' => $sector->letra->descripcion,
                'letra_id' => $sector->letra->id
            ];
        });
    
        return collect($sectoresMap)->random();
    }
}
