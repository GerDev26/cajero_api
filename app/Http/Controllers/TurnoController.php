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
    public function getAll(Request $request){
        try{
            $safeParams = ['letter', 'sortBy', 'sortByDesc', 'vip'];
            $presentSafeParams = $request->only($safeParams);

            if(in_array($presentSafeParams, $safeParams)){
                throw new \Exception('Invalid QueryParams');
            }

            $response = Turno::select()->active();
    
            return $response
                ->letter($request->letter)
                ->sortBy($request->sortBy)
                ->sortByDesc($request->sortByDesc)
                ->Vips($request->vip)
                ->get();

        } catch(\Exception $e){
            return response(['error' => $e->getMessage(), "QueryParams" => $safeParams]);
        }
        
    
    }
    public function store(Request $request){
    }
    public function test(){
        $turnosConUsuarios = DB::table('turnos')
        ->join('users', 'turnos.user_id', '=', 'users.id')
        ->select('turnos.letter', 'turnos.number', 'users.*')
        ->get();
    
        return $turnosConUsuarios;
    }
}
