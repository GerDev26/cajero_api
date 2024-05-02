<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function index() {
        $turnos = Turno::all();
        $users = [];
        foreach ($turnos as $turno) {
            $users[] = $turno->user->name;
        }

        return $turnos;
    }
    public function getProduct(Request $request){
        return $request->id;
    }
}
