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
            [
                'id' => 1,
                'nom_region' => 'Atacora',
                'description_region' => 'Chaîne de montagnes et Parc National de la Pendjari.',
                'population' => 772234,
                'localisation' => 'Nord-Ouest (Natitingou)',
                'superficie' => 20499,
                'prix' => 100,
                'img' => 'img/regions/atacora.jpg',
                'paye' => false
            ],
            [
                'id' => 2,
                'nom_region' => 'Abomey',
                'description_region' => 'Cité historique des Rois du Danxomè et palais royaux.',
                'population' => 92266,
                'localisation' => 'Zou (Sud-Bénin)',
                'superficie' => '142',
                'prix' => 150,
                'img' => 'img/regions/abomey.jpg',
                'paye' => true
            ],
            [
                'id' => 3,
                'nom_region' => 'Ouidah',
                'description_region' => 'Cité historique, berceau du Vaudou et Route des Esclaves.',
                'population' => 162034,
                'localisation' => 'Atlantique (Littoral)',
                'superficie' => '364',
                'prix' => 100,
                'img' => 'img/regions/ouidah.jpg',
                'paye' => false
            ],
            [
                'id' => 4,
                'nom_region' => 'Parakou',
                'description_region' => 'Métropole du Nord et carrefour commercial du Borgou.',
                'population' => 255478,
                'localisation' => 'Borgou (Nord-Est)',
                'superficie' => '441',
                'prix' => 100,
                'img' => 'img/regions/parakou.jpg',
                'paye' => true
            ],
            [
                'id' => 5,
                'nom_region' => 'Alibori',
                'description_region' => 'Région du fleuve Niger et du Parc National du W.',
                'population' => 867463,
                'localisation' => 'Extrême Nord (Kandi)',
                'superficie' => '26242',
                'prix' => 200,
                'img' => 'img/regions/alibori.jpg',
                'paye' => false
            ],
            [
                'id' => 6,
                'nom_region' => 'Porto-Novo',
                'description_region' => 'Capitale administrative et ville aux trois noms.',
                'population' => 264320,
                'localisation' => 'Ouémé (Sud-Est)',
                'superficie' => '110',
                'prix' => 100,
                'img' => 'img/regions/portonovo.jpg',
                'paye' => false
            ],
            [
                'id' => 7,
                'nom_region' => 'Cotonou',
                'description_region' => 'Poumon économique et ville du marché Dantokpa.',
                'population' => 679012,
                'localisation' => 'Littoral (Sud)',
                'superficie' => '79',
                'prix' => 50,
                'img' => 'img/regions/cotonou.jpg',
                'paye' => true
            ],
            [
                'id' => 8,
                'nom_region' => 'Donga',
                'description_region' => 'Région des monts et de la culture forestière.',
                'population' => 543130,
                'localisation' => 'Centre-Nord (Djougou)',
                'superficie' => '11126',
                'prix' => 100,
                'img' => 'img/regions/donga.jpg',
                'paye' => false
            ],
            [
                'id' => 9,
                'nom_region' => 'Ganvié',
                'description_region' => 'La Venise de l’Afrique, cité lacustre sur le lac Nokoué.',
                'population' => 30000,
                'localisation' => 'Atlantique (Abomey-Calavi)',
                'superficie' => '50',
                'prix' => 300,
                'img' => 'img/regions/ganvie.jpg',
                'paye' => false
            ],
            [
                'id' => 10,
                'nom_region' => 'Collines',
                'description_region' => 'Paysage de monolithes et de savanes arborées.',
                'population' => 717477,
                'localisation' => 'Centre (Dassa-Zoumé)',
                'superficie' => '13931',
                'prix' => 100,
                'img' => 'img/regions/collines.jpg',
                'paye' => true
            ],
            [
                'id' => 11,
                'nom_region' => 'Mono',
                'description_region' => 'Région balnéaire connue pour ses bouches du Roy.',
                'population' => 497243,
                'localisation' => 'Sud-Ouest (Lokossa)',
                'superficie' => '1605',
                'prix' => 100,
                'img' => 'img/regions/mono.jpg',
                'paye' => false
            ],
            [
                'id' => 12,
                'nom_region' => 'Couffo',
                'description_region' => 'Terre agricole et foyer de traditions ancestrales.',
                'population' => 745373,
                'localisation' => 'Sud-Ouest (Dogbo)',
                'superficie' => '2408',
                'prix' => 100,
                'img' => 'img/regions/couffo.jpg',
                'paye' => false
            ],
            [
                'id' => 13,
                'nom_region' => 'Plateau',
                'description_region' => 'Région frontalière riche en cultures Yoruba.',
                'population' => 622372,
                'localisation' => 'Sud-Est (Pobè)',
                'superficie' => '3264',
                'prix' => 100,
                'img' => 'img/regions/plateau.jpg',
                'paye' => true
            ],
            [
                'id' => 14,
                'nom_region' => 'Grand-Popo',
                'description_region' => 'Ancien comptoir colonial et plages de cocotiers.',
                'population' => 57636,
                'localisation' => 'Mono (Littoral)',
                'superficie' => '289',
                'prix' => 150,
                'img' => 'img/regions/grandpopo.jpg',
                'paye' => false
            ],
            [
                'id' => 15,
                'nom_region' => 'Nikki',
                'description_region' => 'Capitale de l’empire Bariba et fête de la Gaani.',
                'population' => 151234,
                'localisation' => 'Borgou (Nord-Est)',
                'superficie' => '3500',
                'prix' => 250,
                'img' => 'img/regions/nikki.jpg',
                'paye' => false
            ],
            [
                'id' => 16,
                'nom_region' => 'Natitingou',
                'description_region' => 'Porte d’entrée vers les montagnes de l’Atacora.',
                'population' => 103843,
                'localisation' => 'Atacora (Nord)',
                'superficie' => '604',
                'prix' => 100,
                'img' => 'img/regions/natitingou.jpg',
                'paye' => true
            ],
            [
                'id' => 17,
                'nom_region' => 'Bohicon',
                'description_region' => 'Ville carrefour et centre économique dynamique.',
                'population' => 171781,
                'localisation' => 'Zou (Centre-Sud)',
                'superficie' => '44',
                'prix' => 50,
                'img' => 'img/regions/bohicon.jpg',
                'paye' => false
            ],
            [
                'id' => 18,
                'nom_region' => 'Allada',
                'description_region' => 'Terre historique, berceau des fondateurs de royaumes.',
                'population' => 127512,
                'localisation' => 'Atlantique (Sud)',
                'superficie' => '381',
                'prix' => 100,
                'img' => 'img/regions/allada.jpg',
                'paye' => true
            ],
            [
                'id' => 19,
                'nom_region' => 'Malanville',
                'description_region' => 'Grand marché frontalier sur les rives du Niger.',
                'population' => 168641,
                'localisation' => 'Alibori (Nord)',
                'superficie' => '3016',
                'prix' => 100,
                'img' => 'img/regions/malanville.jpg',
                'paye' => false
            ],
            [
                'id' => 20,
                'nom_region' => 'Possotomé',
                'description_region' => 'Région thermale au bord du lac Ahémé.',
                'population' => 7800,
                'localisation' => 'Mono (Bopa)',
                'superficie' => '120',
                'prix' => 200,
                'img' => 'img/regions/possotome.jpg',
                'paye' => false
            ]
];

        foreach ($regions as $region) {
            Region::updateOrCreate(['id' => $region['id']], $region);
        }
    }
}
