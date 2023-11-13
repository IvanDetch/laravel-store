<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(120)->create();

        $faker = Faker\Factory::create();

        Product::all()->each(function ($product) use ($faker){
           $product->slug = Str::slug($product->title, '-');
           $product->save();

           $categories = [];

           for($i = 0; $i < 4; $i++){
               array_push($categories, $faker->numberBetween(1,5));
           }

           $product->categories()->sync($categories);
        });
    }
}
