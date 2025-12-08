<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['id' => 1, 'nom_region' => 'NIKKI', 'description_region' => 'Région culturelle', 'population' => 100000, 'localisation' => 'Nord Atacora', 'superficie' => 23340],
            ['id' => 2, 'nom_region' => 'Ouidah', 'description_region' => 'Région vodoun', 'population' => 100000, 'localisation' => 'Atlantique', 'superficie' => 23340],
            ['id' => 3, 'nom_region' => 'Parakou', 'description_region' => 'Capitale économique', 'population' => 100000, 'localisation' => 'Borgou', 'superficie' => 23340],
            ['id' => 4, 'nom_region' => 'TchaTou', 'description_region' => 'Région rurale', 'population' => 100000, 'localisation' => 'Atacora', 'superficie' => 23340],
        ];

        foreach ($regions as $region) {
            Region::updateOrCreate(['id' => $region['id']], $region);
        }
    }
}
