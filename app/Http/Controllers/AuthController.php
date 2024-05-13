<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request){

        $isValid = Validator::make($request->all(), [
            'dni' => 'required|string|min:8|max:8|unique:users',
        ]);

        $errors = $isValid->errors();

        if($isValid->fails()){
            return response(['error' => $errors], 422);
        }

        $user = User::create([
            'dni' => $request->dni,
            'remember_token' => Str::random(10)
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'message' => '¡Usuario Creado!',
            'data' => $user,
            'access_token' => $token, 
            'token_type' => 'Bearer'
        ], 201);
    }

    public function logIn(Request $request){
        
        $isValid = Validator::make($request->all(), [
            'dni' => 'required|string|min:8|max:8',
        ]);

        $errors = $isValid->errors();

        if($isValid->fails()){
            return response(['error' => $errors], 422);
        }

        $user = User::where('dni', '=', $request->only('dni'))->first();
        
        if(!$user){
            return response(['error' => '¡DNI incorrecto!'], 401);
        }
        

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'message' => '¡Iniciaste sesion!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user,
        ], 200);
    }
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return ['message' => '¡Cerraste sesion!'];
    }

}
