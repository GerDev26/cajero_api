<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $table = 'sectores';

    public $timestamps = true;

    public function turno(){
        return $this->hasMany('App\Models\Turno');
    }
    public function letra(){
        return $this->belongsTo('App\Models\Letra');
    }
    public function letraDesc(){
            // Verifica si hay una letra asociada al sector actual
    if ($this->letra) {
        // Si hay una letra asociada, devuelve su descripción
        return $this->letra->descripcion;
    } else {
        // Si no hay letra asociada, devuelve un valor predeterminado o null
        return null; // O un valor predeterminado, por ejemplo: 'Sin letra asociada'
    }
    }
}
