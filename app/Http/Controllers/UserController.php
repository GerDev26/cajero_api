<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turno;

class UserController extends Controller
{
    public function index(){
        return User::all()->turno;
    }
}
