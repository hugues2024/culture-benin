<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeMedia;

class TypeMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $types = [
            ['id' => 1, 'nom' => 'Image'],
            ['id' => 2, 'nom' => 'Audio'],
            ['id' => 3, 'nom' => 'Vidéo'],
        ];

        foreach ($types as $type) {
            TypeMedia::updateOrCreate(['id' => $type['id']], $type);
        }
    }
}
