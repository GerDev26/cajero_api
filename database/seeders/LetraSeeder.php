<?php

namespace Database\Seeders;

use App\Models\Letra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LetraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = DB::table('letras')->count();

        if ($count === 0) {
            $data = ([
                [
                    'descripcion' => 'C',
                    'activo' => 1,
                    'numero' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'descripcion' => 'AT',
                    'activo' => 1,
                    'numero' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'descripcion' => 'N',
                    'activo' => 1,
                    'numero' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'descripcion' => 'V',
                    'activo' => 1,
                    'numero' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
            Letra::insert($data);
        }
    }
}
