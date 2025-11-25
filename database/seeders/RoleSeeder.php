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
        //
        Role::create([
            "nom"=>"Admin",

        ]);
        Role::create([
            "nom" => "Manager",

        ]);
        Role::create([
            "nom" => "Moderateurs",

        ]);
        Role::create([
            "nom" => "Lecteur",

        ]);
        Role::create([
            "nom" => "Auteur",

        ]);
    }
}
