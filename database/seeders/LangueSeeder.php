<?php

namespace Database\Seeders;

use App\Models\Langue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Langue::create([

            'nom_langue'=>"Minan",
            'code_langue'=>"MN",
            'description'=>"je suis une langue de togo"
        ]);
        Langue::create([

            'nom_langue' => "Minan1",
            'code_langue' => "MN1",
            'description' => "je suis une langue de togo"
        ]);
        Langue::create([

            'nom_langue' => "FONGBE",
            'code_langue' => "FN",
            'description' => "je suis une langue de togo"
        ]);

    }
}
