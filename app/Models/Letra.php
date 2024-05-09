<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letra extends Model
{
    protected $table = 'letras';
    public $timestamps = true;
    protected $fillable = [
        'descripcion',
        'activo',
        'numero',
    ];
    protected $attributes = [
        'active' => true
    ];
    use HasFactory;

    public function sector(){
        return $this->hasMany('App\Models\Sector');
    }
}
