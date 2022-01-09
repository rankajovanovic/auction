<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;
use App\Models\User;
use App\Models\Category;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'description' => $this->faker->paragraph(2, true),
            'price' => $this->faker->numberBetween(20, 20000),
            'payment' => $this->faker->randomElement(['card', 'cash']),
            'delivery' => $this->faker->randomElement(['fast', 'regular']),
            'image' => $this->faker->imageUrl('300', '300'),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'end_time' => $this->faker->dateTimeBetween('+3 days', '+15 days')
        ];
    }
}