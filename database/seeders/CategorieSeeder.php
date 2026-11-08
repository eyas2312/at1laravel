<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'nom' => 'Technologie',
                'description' => 'Actualités et innovations technologiques.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Culture',
                'description' => 'Articles sur la culture et les arts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Éducation',
                'description' => 'Contenus éducatifs et pédagogiques.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Divertissement',
                'description' => 'Films, musique et loisirs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}