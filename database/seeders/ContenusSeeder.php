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
    // --- LITTÉRATURE (Type 1) ---
    [
        'id' => 1, 
        'titre' => "Le Cycle de l'Araignée (Yéhoué Gbadogli)", 
        'texte' => "Plongez dans l'univers de la ruse et de la sagesse populaire à travers les récits fondateurs du sud-Bénin.",
        'statut' => 'actif', 
        'region_id' => 2, 
        'langue_id' => 3, 
        'type_contenu_id' => 1, 
        'id_auteur' => 4,
        'image' => 'img/patrimoine/littérature/araignee.jpg'
    ],

    // --- GASTRONOMIE (Type 2) ---
    [
        'id' => 2, 'titre' => "L'Amiwo au Poulet", 
        'texte' => "La fameuse pâte de maïs rouge fermentée, pilier de la table royale d'Abomey.",
        'statut' => 'actif', 
        'region_id' => 2, 
        'langue_id' => 3, 'type_contenu_id' => 2, 
        'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/amiwo.jpg'
    ],
    [
        'id' => 3, 'titre' => "L'Agoun (Igname Pilée)", 
        'texte' => "La noblesse culinaire du centre-Bénin, servie avec une sauce arachide ou graine.",
        'statut' => 'actif', 
        'region_id' => 10, 
        'langue_id' => 3, 'type_contenu_id' => 2, 
        'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/agoun.jpg'
    ],
    [
        'id' => 4, 'titre' => "L'Atassi Classique", 
        'texte' => "Le mélange riz-haricots indissociable du piment noir (Dja) et du poisson frit.",
        'statut' => 'actif', 
        'region_id' => 7, 
        'langue_id' => 3, 'type_contenu_id' => 2, 
        'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/atassi.jpg'
    ],
    [
        'id' => 5, 'titre' => "Le Wassa-Wassa", 
        'texte' => "Le 'couscous noir' à base de cossettes d'igname, une merveille du Nord-Bénin.",
        'statut' => 'actif', 
        'region_id' => 5, 
        'langue_id' => 3, 
        'type_contenu_id' => 2, 
        'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/wassa-wassa.jpg'
    ],
    [
        'id' => 6, 'titre' => "Le Toubani", 
        'texte' => "Gâteau de farine de haricots ou de niébé cuit à la vapeur. Léger et nutritif.",
        'statut' => 'actif', 'region_id' => 4, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/toubani.jpg'
    ],
    [
        'id' => 7, 'titre' => "Le Dakouin", 
        'texte' => "La polenta de gari (manioc) cuite dans un bouillon de poisson frais du lac Ahémé.",
        'statut' => 'actif', 'region_id' => 11, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/dakouin.jpg'
    ],
    [
        'id' => 8, 'titre' => "Les Massa", 
        'texte' => "Délicieuses galettes de riz sucrées, frites et croustillantes, spécialité du Nord.",
        'statut' => 'actif', 'region_id' => 4, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/massa.jpg'
    ],
    [
        'id' => 9, 'titre' => "Talé-Talé", 
        'texte' => "Beignets de bananes plantains mûres, le goûter préféré des Béninois.",
        'statut' => 'actif', 'region_id' => 7, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/tale-tale.jpg'
    ],
    [
        'id' => 10, 'titre' => "Sauce Gombo (Fétri)", 
        'texte' => "Une sauce gluante riche en crabes, crevettes et fromage local (Wagashi).",
        'statut' => 'actif', 'region_id' => 3, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/gombo.jpg'
    ],
    [
        'id' => 11, 'titre' => "Wagashi Gasno", 
        'texte' => "L'unique fromage au lait de vache, teint en rouge grâce aux tiges de sorgho.",
        'statut' => 'actif', 'region_id' => 4, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/wagashi.jpg'
    ],
    [
        'id' => 12, 'titre' => "Yovo-Doko", 
        'texte' => "Les beignets de farine de blé vendus à chaque coin de rue, symboles du 'Street-Food'.",
        'statut' => 'actif', 'region_id' => 7, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/yovo-doko.jpg'
    ],
    [
        'id' => 13, 'titre' => "Le Djanman", 
        'texte' => "Poisson grillé ou braisé à la béninoise, mariné aux épices locales.",
        'statut' => 'actif', 'region_id' => 7, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600'
    ],
    [
        'id' => 14, 'titre' => "Le Kpétchi", 
        'texte' => "Plat à base de sang de porc ou de mouton cuit, très apprécié dans le Sud.",
        'statut' => 'actif', 'region_id' => 2, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/kpetchi.jpg'
    ],
    [
        'id' => 15, 'titre' => "Le Télibo", 
        'texte' => "La pâte noire obtenue à partir de la farine de cossettes d'igname.",
        'statut' => 'actif', 'region_id' => 10, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/telibo.jpg'
    ],
    [
        'id' => 16, 'titre' => "Rafraîchissements", 
        'texte' => "Bissap (fleurs d'hibiscus), jus de Baobab ou Ananas 'Pain de Sucre'.",
        'statut' => 'actif', 'region_id' => 7, 'langue_id' => 3, 'type_contenu_id' => 2, 'id_auteur' => 4,
        'image' => 'img/patrimoine/gastronomie/rafraichissement.jpg'
    ],

    // --- HISTOIRE (Type 3) ---
    [
        'id' => 17, 'titre' => "L'Amazone du Bénin", 
        'texte' => "Inspirées par l'élite militaire féminine du Danxomè, elles incarnent aujourd'hui la force et l'émancipation.",
        'statut' => 'actif', 'region_id' => 2, 'langue_id' => 3, 'type_contenu_id' => 3, 'id_auteur' => 4,
        'image' => 'img/patrimoine/histoire/amazone.jpg'
    ],
    [
        'id' => 18, 'titre' => "Bio Guéra : L'Immortel", 
        'texte' => "Prince guerrier et figure de la résistance anticoloniale dans le septentrion béninois.",
        'statut' => 'actif', 'region_id' => 8, 'langue_id' => 3, 'type_contenu_id' => 3, 'id_auteur' => 4,
        'image' => 'img/patrimoine/histoire/bioguera.jpg'
    ],
];

        foreach ($contenus as $contenu) {
            Contenu::updateOrCreate(['id' => $contenu['id']], $contenu);
        }
    }
}
