<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i <= 100 ; $i++) { 
            Nivel::create([
                'numero' => $i,
                'experiencia' => ($i * 1000),
            ]);
        }
    }
}
