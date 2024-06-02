<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'username' => 'user' . $i,
                'password' => Hash::make('password'),
                'is_admin' => $i === 0 ? true : false, // Jadikan pengguna pertama sebagai admin
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
