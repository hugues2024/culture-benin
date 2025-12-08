<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contenu;

class ContenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $contenus = [
            [
                'id' => 1, 'titre' => 'Conte de la petite Pokou', 
                'texte' => 'Voilà la belle histoire de la petite Pokou qui traversa le fleuve avec ses enfants...',
                'statut' => 'actif', 'region_id' => 1, 'langue_id' => 2, 'type_contenu_id' => 1,
                'id_auteur' => 4
            ],
            [
                'id' => 2, 'titre' => 'Proverbe Beninois', 
                'texte' => '"Celui qui marche avec les boiteux apprend à boiter"',
                'statut' => 'actif', 'region_id' => 2, 'langue_id' => 3, 'type_contenu_id' => 2,
                'id_auteur' => 2
            ],
        ];

        foreach ($contenus as $contenu) {
            Contenu::updateOrCreate(['id' => $contenu['id']], $contenu);
        }
    }
}
