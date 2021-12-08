<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Gallery;
use App\Models\User;

class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->words(5, true),
            'description' => $this->faker->text($maxNbChars = 50)
        ];
    }
}
