<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;
    protected $table = "turnos";

    protected $hidden = [
        'user_id',
        'sector_id'
    ];

    protected $attributes = [
        'active' => true,
    ];
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'sector_id',
        'letra_id',
        'numero',
        'letra',
        'active'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function sector(){
        return $this->belongsTo('App\Models\Sector');
    }

    public function scopeActive($query){
        return $query->where('active', "1")->with('user');
    }
    public function scopeInactive($query){
        return $query->where('active', "0")->with('user');
    }
    public function scopeVips($query, $use){

        if($use!=null){
            $value = $use ? '1' : '0';
            return $query->whereHas('user', function($q) use ($value){
                $q->where('vip', $value);
            });
        }
    }
    public function scopeLetter($query, $letter){
        if($letter){
            return $query->where('letter', 'like', "%$letter%");
        }
    }

    private $sortFilters = [
        'createdDate' => 'created_at', 
        'updatedDate' => 'updated_at', 
        'letra' => 'letra',
        'id' => 'id'
    ];
    public function scopeSortBy($query, $filter){

        foreach ($this->sortFilters as $key => $value) {
            if($filter == $key){
                return $query->orderBy($value);
            }
        }
    }
    public function scopeSortByDesc($query, $filter){

        foreach ($this->sortFilters as $key => $value) {
            if($filter == $key){
                return $query->orderBy($value, 'desc');
            }
        }
    }

}
