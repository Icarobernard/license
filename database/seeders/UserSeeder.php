<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'id' => 1,
                'name' => 'Thiago Tedeschi',
                'email' => 'thiagotedeschi@hotmail.com',
                'password' => Hash::make('123456789'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        DB::table('users')->insert(
            [
                'id' => 2,
                'name' => 'Carlos Lourenço',
                'email' => 'carloslourenco.suporte@gmail.com',
                'password' => Hash::make('123456789'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
        DB::table('users')->insert(
            [
                'id' => 3,
                'name' => 'Fábio Vasconcelos',
                'email' => 'eu.fabiovasconcelos@gmail.com',
                'password' => Hash::make('123456789'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
        DB::table('users')->insert(
            [
                'id' => 4,
                'name' => 'Icaro Bernard',
                'email' => 'icarobernar@hotmail.com',
                'password' => Hash::make('123456789'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
