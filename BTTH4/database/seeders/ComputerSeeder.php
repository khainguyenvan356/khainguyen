<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Computer;
use Faker\Factory as Faker;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) { 
            Computer::create([
                'computer_name' => $faker->unique()->word(), 
                'model' => $faker->randomElement(['Dell Optiplex 7080', 'HP EliteDesk 800', 'Lenovo ThinkCentre M70']),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Windows 11 Pro', 'Ubuntu 22.04']), 
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'Intel Core i7-10700', 'AMD Ryzen 5 5600X']), 
                'memory' => $faker->randomElement([8, 16, 32, 64]), 
                'available' => $faker->boolean(), 
            ]);
        }
    }
}
