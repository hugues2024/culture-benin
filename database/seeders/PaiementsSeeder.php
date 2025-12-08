<?php

namespace Database\Seeders;

use App\Models\Paiement;
use Illuminate\Database\Seeder;

class PaiementsSeeder extends Seeder
{
    public function run(): void
    {
        $paiements = [
            // Paiement pour le conte Pokou (contenu ID=1)
            [
                'user_id' => 3, // Hugues Hounkpatin
                'contenu_id' => 1,
                'montant' => 500.00,
                'statut' => 'payé',
                'numero' => 'PAI-2025-001',
                'paiement_methode' => 'carte',
                'transaction_id' => 'TXN_ABC123456',
            ],
            [
                'user_id' => 3, // Dewanou Hounkpatin
                'contenu_id' => 1,
                'montant' => 500.00,
                'statut' => 'payé',
                'numero' => 'PAI-2025-002',
                'paiement_methode' => 'mobile_money',
                'transaction_id' => 'TXN_DEF789012',
            ],
            // Paiement pour le proverbe (contenu ID=2)
            [
                'user_id' => 3, // Hugue HOUNKPATIN
                'contenu_id' => 2,
                'montant' => 250.00,
                'statut' => 'payé',
                'numero' => 'PAI-2025-003',
                'paiement_methode' => 'carte',
                'transaction_id' => 'TXN_GHI345678',
            ],
            // Paiement en attente
            [
                'user_id' => 3, // Manager Platform
                'contenu_id' => 2,
                'montant' => 250.00,
                'statut' => 'en_attente',
                'numero' => 'PAI-2025-004',
                'paiement_methode' => 'mobile_money',
            ],
            // Paiement échoué
            [
                'user_id' => 3, // Admin System
                'contenu_id' => 1,
                'montant' => 500.00,
                'statut' => 'échoué',
                'numero' => 'PAI-2025-005',
                'paiement_methode' => 'carte',
                'transaction_id' => 'TXN_FAILED_001',
            ],
        ];

        foreach ($paiements as $paiement) {
            Paiement::create([
                'user_id' => $paiement['user_id'],
                'contenu_id' => $paiement['contenu_id'],
                'montant' => $paiement['montant'],
                'statut' => $paiement['statut'],
                'numero' => $paiement['numero'],
                'paiement_methode' => $paiement['paiement_methode'],
                'transaction_id' => $paiement['transaction_id'] ?? null,
                'created_at' => now()->subDays(rand(1, 60)),
                'updated_at' => now()->subDays(rand(1, 60)),
            ]);
        }
    }
}
