<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeContenu;

class TypeContenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['id' => 1, 'nom' => 'Littérature Orale'],
            ['id' => 2, 'nom' => 'Gastronomie'],
            ['id' => 3, 'nom' => 'Histoire & Rites'],
            ['id' => 4, 'nom' => 'Légende'],
        ];

        foreach ($types as $type) {
            TypeContenu::updateOrCreate(['id' => $type['id']], $type);
        }
    }
}