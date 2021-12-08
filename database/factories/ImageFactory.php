<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use App\Models\Gallery;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gallery_id' => Gallery::inRandomOrder()->first()->id,
            'url' => $this->faker->imageUrl(800, 600)
        ];
    }
}
