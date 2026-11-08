<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Publication>
 */
class PublicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(4),
            'contenu' => fake()->paragraph(5),
            'user_id' => User::factory(),
            'categorie_id' => Categorie::inRandomOrder()->value('id'),
        ];
    }
}