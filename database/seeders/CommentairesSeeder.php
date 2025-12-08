<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Contenu;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentairesSeeder extends Seeder
{
    public function run(): void
    {
        $commentaires = [
            // Commentaires sur le contenu ID=1 (conte Pokou)
            [
                'commentaire' => 'Excellente histoire ! La petite Pokou est un symbole de courage.',
                'note' => 5,
                'id_user' => 4, // Hugues Hounkpatin
                'id_contenu' => 1,
            ],
            [
                'commentaire' => 'Très beau conte traditionnel. Merci pour le partage !',
                'note' => 4,
                'id_user' => 5, // Dewanou Hounkpatin
                'id_contenu' => 1,
            ],
            [
                'commentaire' => 'J\'adore cette histoire, elle me rappelle mon enfance à Nikki.',
                'note' => 5,
                'id_user' => 2, // Hugue HOUNKPATIN
                'id_contenu' => 1,
            ],
            // Commentaires sur le contenu ID=2 (Proverbe)
            [
                'commentaire' => 'Proverbe très sage. On l\'utilise souvent dans ma région.',
                'note' => 5,
                'id_user' => 1, // Manager Platform
                'id_contenu' => 2,
            ],
        ];

        foreach ($commentaires as $commentaire) {
            Commentaires::create([
                'commentaire' => $commentaire['commentaire'],
                'note' => $commentaire['note'],
                'id_user' => $commentaire['id_user'],
                'id_contenu' => $commentaire['id_contenu'],
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
