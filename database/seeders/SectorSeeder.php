<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = DB::table('sectores')->count();

        // Si no hay registros, insertar los registros
        if ($count === 0) {
            $data = ([
                [
                    'descripcion' => "caja",
                    'letra_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'descripcion' => "atencion al cliente",
                    'letra_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'descripcion' => "informacion",
                    'letra_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'descripcion' => "inversiones",
                    'letra_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'descripcion' => "vip",
                    'letra_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
            Sector::insert($data);
        }
    }
}
