<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }
    public function getUserIdFromToken()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            return response()->json(['user_id' => $user->id], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
