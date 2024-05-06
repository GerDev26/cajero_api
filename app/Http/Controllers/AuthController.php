<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){

        $isValid = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname' => 'required|string|max:255',
            'dni' => 'required|string|min:8|unique:users',
        ]);

        $errors = $isValid->errors();

        if($isValid->fails()){
            return response(['error' => $errors], 422);
        }
        
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'dni' => $request->dni,
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'message' => 'User Created!',
            'data' => $user,
            'access_token' => $token, 
            'token_type' => 'Bearer'
        ], 201);
    }

    public function logIn(Request $request){

        $user = User::where('dni', '=', $request->only('dni'))->first();
        
        if(!$user){
            return response(['error' => 'Unauthorized'], 401);
        }
        

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'message' => 'You are Logged now!',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return ['message' => 'You hace successfully logged out and the token was successfully deleted'];
    }

}
