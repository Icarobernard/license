<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                'id' => 1,
                'user_id' => 1,
                'name' => 'Super Links',
                'payment_type' => 'hotmart',
                'image' => 'uploads/superlinks.png',
                'rank'=> 1,
                'product_id' => 'test',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        DB::table('products')->insert(
            [
                'id' => 2,
                'user_id' => 1,
                'name' => 'Go Hacks',
                'payment_type' => 'hotmart',
                'image' => 'uploads/gohacks.png',
                'rank'=> 2,
                'product_id' => 'test123',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
        DB::table('products')->insert(
            [
                'id' => 3,
                'user_id' => 1,
                'name' => 'Super Presell',
                'payment_type' => 'hotmart',
                'image' => 'uploads/superpresell.png',
                'rank'=> 3,
                'product_id' => 'test1234',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
        DB::table('products')->insert(
            [
                'id' => 4,
                'user_id' => 1,
                'name' => 'Super Escassez',
                'payment_type' => 'hotmart',
                'image' => 'uploads/superescassez.png',
                'rank' => 4,
                'product_id' => 'test12345',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
