<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use App\Rules\sortAppointments;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TurnoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Turno::with('sector:id,descripcion', 'user:id,name,lastname,dni,vip');
    
            if ($request->has('vip')) {

                $validationRules =
                [
                    'vip' => 'boolean'
                ];
                $errorMessage = 
                [
                    'vip.boolean' => 'vip debe contener 1 o 0'
                ];
                $validator = Validator::make($request->all(), $validationRules, $errorMessage);
                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }
                
                $query = $query->Vips($request['vip']);
            }

            if($request->has('sortBy') | $request->has('sortByDesc')){

                if($request->has('sortBy') && $request->has('sortByDesc')){
                    throw new Exception('No puedes usar sortby y sortByDesc al mismo tiempo', 422);
                }

                $validationRules = 
                [
                    'sortBy' => new sortAppointments,
                    'sortByDesc' => new sortAppointments
                ];
                $validator = Validator::make($request->all(), $validationRules);
                if ($validator->fails()) {
                    throw new ValidationException($validator, 422);
                }

                if ($request->has('sortBy')) {
                    $query->SortBy($request['sortBy']);    
                }
                if ($request->has('sortByDesc')) {
                    $query->SortByDesc($request['sortByDesc']);
                }
            }
    
            return $query->get();

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
    
    public function store(Request $request){

        $request = $request->only('user_id', 'sector_id', 'letra', 'numero');

        Turno::create([
            'sector_id' => $request['sector_id'],
            'user_id' => $request['user_id'],
            'letra' => $request['letra'],
            'numero' => $request['numero'],
        ]);

        return response(['message' => 'registro guardado!'], 201);
    }


}
