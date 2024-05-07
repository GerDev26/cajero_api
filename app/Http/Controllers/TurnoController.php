<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{
    public function index(){
        return Turno::with('sector:descripcion,id')->get();
    }
    public function store(Request $request){

        Turno::create([
            'sector_id' => $request->sector_id,
            'user_id' => $request->user_id,
            'letra' => $request->letra,
            'numero' => $request->numero,
        ]);

        return response(['message' => 'registro guardado!'], 201);
    }


}
