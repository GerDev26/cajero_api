<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $table = 'sectores';

    public function turno(){
        return $this->hasMany('App\Models\Turno');
    }
    public function letra(){
        return $this->belongsTo('App\Models\Letra');
    }
}
