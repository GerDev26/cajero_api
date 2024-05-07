<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turno;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $usersMap = $users->map(function($user){
            return 
            [
                'user_id' => $user->id,
                'vip' => $user->vip
            ];
        });
        $randomUser = collect($usersMap)->random();
        $esVip = $randomUser['vip'] == 1 ? "es Vip" : "es pobre";
        return $esVip;
    }
}
