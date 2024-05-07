<?php

namespace Database\Factories;

use App\Models\Letra;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turno>
 */
class TurnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $usersMap = $users->map(function($user){
            return 
            [
                'user_id' => $user->id,
                'vip' => $user->vip
            ];
        });
    
        $sectores = Sector::with('letra')->get();
        $sectoresMap = $sectores->map(function($sector){
            return [
                'sector_id' => $sector->id,
                'letra' => $sector->letra->descripcion,
                'letra_id' => $sector->letra->id
            ];
        });
    
        $randomSector = collect($sectoresMap)->random();
        $randomUser = collect($usersMap)->random();



        return [
            'user_id' => $randomUser['user_id'],
            'sector_id' => $randomSector['sector_id'],
            'numero' => function() use ($randomUser, $randomSector){
                if($randomUser['vip'] == "1"){
                    $vipNumber = Letra::find(4);
                    $vipNumber->numero = $vipNumber->numero + 1;
                    $vipNumber->save();
                    return $vipNumber->numero;
                }
                $number = Letra::find($randomSector['letra_id']);
                $number->numero = $number->numero + 1;
                $number->save();
                return $number->numero;
            },
            'letra' => function() use ($randomUser, $randomSector) { 
                if($randomUser['vip'] == "1"){
                    $vipLetter = Letra::find(4);
                    return $vipLetter->descripcion;
                }
                return $randomSector['letra'];
            },
            'active' => true,
        ];
    }
    
}
