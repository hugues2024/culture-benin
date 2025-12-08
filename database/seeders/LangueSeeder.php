<?php

namespace Database\Seeders;

use App\Models\Langue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langues = [
            ['id' => 1, 'nom_langue' => 'Minan', 'code_langue' => 'MN', 'description' => 'Langue du Togo'],
            ['id' => 2, 'nom_langue' => 'Minan1', 'code_langue' => 'MN1', 'description' => 'Variante Minan'],
            ['id' => 3, 'nom_langue' => 'FONGBE', 'code_langue' => 'FN', 'description' => 'Langue du Bénin'],
        ];

        foreach ($langues as $langue) {
            Langue::updateOrCreate(['id' => $langue['id']], $langue);
        }
    }
}
