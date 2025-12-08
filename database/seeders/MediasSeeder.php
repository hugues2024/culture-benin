<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    <?php
// MediasSeeder.php
namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediasSeeder extends Seeder
{
    public function run(): void
    {
        Media::create([
            'chemin' => 'medias/pokou.jpg',
            'description' => 'Illustration du conte Pokou',
            'id_contenu' => 1,
            'id_type_media' => 1
        ]);
    }
}

// ParlersSeeder.php
class ParlersSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Parler::create([
            'id_langue' => 2, 'id_region' => 1
        ]);
    }
}

// CommentairesSeeder.php + PaiementsSeeder.php suivent la même logique

}
