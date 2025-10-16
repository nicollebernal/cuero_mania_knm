<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('productos')->insert([
                'nombre' => 'Chaqueta de cuero ' . $i,
                'precio' => 100000 + ($i * 1000),
                'imagen' => 'chaqueta_' . $i . '.jpg',
                'descripcion' => 'Chaqueta de cuero elegante número ' . $i,
               
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
