<?php
// MediasSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Media;

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
