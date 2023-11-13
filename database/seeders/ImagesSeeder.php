<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::all()->each(function ($gallery){
           $images = Image::factory()->count(4)->create();
           $gallery->images()->saveMany($images);
        });
    }
}
