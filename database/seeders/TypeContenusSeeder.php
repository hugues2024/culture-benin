<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeContenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['id' => 1, 'nom' => 'Conte'],
            ['id' => 2, 'nom' => 'Proverbe'],
            ['id' => 3, 'nom' => 'Chanson'],
            ['id' => 4, 'nom' => 'Légende'],
        ];

        foreach ($types as $type) {
            TypeContenu::updateOrCreate(['id' => $type['id']], $type);
        }
    }
}
