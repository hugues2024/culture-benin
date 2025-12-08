<?php
// database/seeders/PaiementsSeeder.php - VERSION CORRIGÉE
namespace Database\Seeders;

use App\Models\Paiement;
use Illuminate\Database\Seeder;

class PaiementsSeeder extends Seeder
{
    public function run(): void
    {
        $paiements = [
            // Paiement 2: user 2 → contenu 1 (UNIQUE)
            [
                'user_id' => 3,  // Hugue HOUNKPATIN
                'contenu_id' => 1,
                'montant' => 500.00,
                'statut' => 'payé',
                'numero' => 'PAI-2025-002',
                'paiement_methode' => 'mobile_money',
                'transaction_id' => 'TXN_DEF789012',
            ],
            // Paiement 3: user 4 → contenu 2 (UNIQUE)
            [
                'user_id' => 3,  // Hugues Hounkpatin
                'contenu_id' => 2,
                'montant' => 250.00,
                'statut' => 'payé',
                'numero' => 'PAI-2025-003',
                'paiement_methode' => 'carte',
                'transaction_id' => 'TXN_GHI345678',
            ],
        ];

        foreach ($paiements as $paiement) {
            Paiement::updateOrCreate(
                ['user_id' => $paiement['user_id'], 'contenu_id' => $paiement['contenu_id']],
                $paiement
            );
        }
    }
}
