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
    ];

    protected $fillable = [
        'user_id',
        'letter',
        'number',
        'active',
        'created_at',
        'updated_at'
    ];
    private $sortFilters = [
        'createdDate' => 'created_at', 
        'updatedDate' => 'updated_at', 
        'letter' => 'letter'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function scopeActive($query){
        return $query->where('active', "1")->with('user');
    }
    public function scopeInactive($query){
        return $query->where('active', "0")->with('user');
    }

    public function scopeLetter($query, $letter){
        if($letter){
            return $query->where('letter', 'like', "%$letter%");
        }
    }
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

    public function scopeVips($query, $value){
        
        $value = $value === null ? 0 : $value;

        return $query->whereHas('user', function($q) use ($value){
            $q->where('vip', $value);
        });
    }
}
