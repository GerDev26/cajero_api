<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;
    protected $table = "turnos";
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
