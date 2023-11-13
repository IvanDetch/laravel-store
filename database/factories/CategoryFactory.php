<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ['Phones', 'Laptops', 'Headphones', 'Category 4', 'Category 5'],
            'slug' => ['phones', 'laptops', 'headphones', 'category-4', 'category-5'],
            'desc' => ['Phones', 'Laptops', 'Headphones', 'Category 4', 'Category 5'],
            'img' => ['https://image.made-in-china.com/2f0j00mrVcIPZYCDbW/Game-Mobile-Phone-Wireless-Charger-Large-Screen-Mobile-Phone-11-with-Cheap-Price.jpg', 'https://www.techspot.com/images2/news/bigimage/2019/01/2019-01-12-image.jpg', 'https://mir-s3-cdn-cf.behance.net/project_modules/max_3840/ad8eb311797195.56ae8f2b95b63.png', 'https://image.made-in-china.com/2f0j00mrVcIPZYCDbW/Game-Mobile-Phone-Wireless-Charger-Large-Screen-Mobile-Phone-11-with-Cheap-Price.jpg', 'https://image.made-in-china.com/2f0j00mrVcIPZYCDbW/Game-Mobile-Phone-Wireless-Charger-Large-Screen-Mobile-Phone-11-with-Cheap-Price.jpg'],
        ];
    }
}
