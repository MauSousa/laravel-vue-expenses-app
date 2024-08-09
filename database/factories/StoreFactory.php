<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()
                ->unique()
                ->randomElement([
                    'Liverpool',
                    'Sears',
                    'Chedraui',
                    'Walmart',
                    'Banana Republic',
                    'Costco',
                    "Sam's",
                    'Whoolworth',
                    'Coppel',
                    'Tienda de abarrotes',
                    'Sanborns',
                    'Suburbia',
                    'Palacio de hierro',
                ]),
        ];
    }
}
