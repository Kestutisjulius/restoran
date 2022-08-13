<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('123'),
            'role'=> 1
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'role'=> 10
        ]);

        foreach (range(1, 10) as $_) {
            DB::table('restaurants')->insert([
                'name' => $faker->company(),
                'city' => $faker->city(),
                'address' => $faker->streetAddress(),
                'work_time' => 'FROM 7:00 to 19:00 I-V'
            ]);
        }

        $dishes = ['Yorkshire Pudding', 'Fish and Chips', 'English Pancakes', 'Shepherd’s Pie', 'Black Pudding', 'Trifle', 'Full English Breakfast', 'Toad in the Hole', 'Steak and Kidney Pie', 'Scotch Egg', 'Lancashire Hot Pot'];
        foreach (range(1, 11) as $key => $_) {
            DB::table('dishes')->insert([
                'name' => $dishes[$key],
                'price' => rand(299, 2999) / 100,
                'restaurant_id'=>rand(1,10)
            ]);
        }
    }
}
