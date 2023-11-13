<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => $this->faker->numerify('Product ###'),
            'description' => $this->faker->paragraph(4,true),
            'price' => $this->faker->randomFloat(2, 10, 999),
            'barcode' => $this->faker->ean8(),
            'stock' => $this->faker->numberBetween(0, 99),
            'cover' => 'https://loremflickr.com/640/480/computer'
        ];
    }
}
