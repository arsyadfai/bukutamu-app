<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'arfaizun62@gmail.com',
            'password' => bcrypt('password'), // Ganti 'password' sesuai keinginan
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
