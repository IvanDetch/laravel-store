<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        User::factory()->create([
            'name' => $faker->userName,
            'lastName' => $faker->lastName,
            'email' => 'admin@laravel-shop.test',
            'password' => Hash::make('secret'),
            'is_admin' => true,
        ]);

        for ($i = 0; $i < 5; $i++)
        {
            User::factory()->create([
                'name' => $faker->userName,
                'lastName' => $faker->lastName,
                'email' => $faker->email,
                'password' => Hash::make('secret'),
            ]);
        }
    }
}

