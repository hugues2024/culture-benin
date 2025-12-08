<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'nom' => 'Admin'],
            ['id' => 2, 'nom' => 'Manager'],
            ['id' => 3, 'nom' => 'Moderateurs'],
            ['id' => 4, 'nom' => 'Lecteur'],
            ['id' => 5, 'nom' => 'Auteur'],
            ['id' => 6, 'nom' => 'Utilisateur'],
            ['id' => 7, 'nom' => 'Utilisateur'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }
    }
}
