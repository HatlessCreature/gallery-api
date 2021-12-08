<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Comment;

class CommentFactory extends Factory
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
            'gallery_id' => Gallery::inRandomOrder()->first()->id,
            'content' => $this->faker->sentence
        ];
    }
}
