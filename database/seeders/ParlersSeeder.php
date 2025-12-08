<?php

namespace Database\Seeders;

use App\Models\Parler;
use Illuminate\Database\Seeder;

// ParlersSeeder.php
class ParlersSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Parlers::create([
            'id_langue' => 2, 'id_region' => 1
        ]);
    }
}
