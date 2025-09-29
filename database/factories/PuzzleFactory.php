<?php

namespace Database\Factories;

use App\Models\Puzzle;
use Illuminate\Database\Eloquent\Factories\Factory;

class PuzzleFactory extends Factory
{
    protected $model = Puzzle::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'categorie' => $this->faker->word,
            'description' => $this->faker->sentence,
            'prix' => $this->faker->randomFloat(2, 1, 100),
            'image' => $this->faker->imageUrl(640, 480, 'puzzle', true),
        ];
    }
}

