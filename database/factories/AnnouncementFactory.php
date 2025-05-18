<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->text(),
            'operation_type' => Arr::random(['vente', 'echange', 'don']),
            'is_completed' => fake()->boolean(),
            'is_canceled' => fake()->boolean(),
            'school_level' => fake()->randomElement(['primaire', 'secondaire', 'supérieur', 'universitaire']),
            'price' => fake()->numberBetween(100,1000000),
            'state' => fake()->randomElement(['neuf', 'comme neuf', 'bon etat','usagé']),
            'exchange_location' => fake()->text(),
            'exchange_location_lat' => fake()->randomFloat(2, 10, 100),
            'exchange_location_logt' => fake()->randomFloat(2, 10, 100),
            'user_id' => User::factory(),
            'category_id' => Category::factory()

        ];
    }
}
