<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($count = 1; $count <= 100; $count++) {
            DB::table('products')->insert([
                'title' => $faker->text(30),
                'description' => $faker->text(300),
                'price' => $faker->numberBetween(10, 5000),
                'image' => 'image.jpg'
            ]);
        }
    }
}
