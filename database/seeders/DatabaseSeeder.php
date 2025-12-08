<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
             // 1. TABLES SANS DÉPENDANCE
            RoleSeeder::class,
            LangueSeeder::class,
            RegionSeeder::class,
            TypeContenusSeeder::class,
            TypeMediaSeeder::class,
            
            // 2. USERS (dépend de roles + langues)
            UserSeeder::class,
            
            // 3. CONTENUS (dépend de users + regions + langues + type_contenus)
            ContenusSeeder::class,
            
            // 4. MEDIAS (dépend de contenus + type_medias)
            MediasSeeder::class,
            
            // 5. PARLERS (dépend de langues + regions)
            ParlersSeeder::class,
            
            // 6. COMMENTAIRES (dépend de users + contenus)
            CommentairesSeeder::class,
            
            // 7. PAIEMENTS (dépend de users + contenus)
            PaiementsSeeder::class,
        ]);
    }
}
