<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'BBPMP',
            'email' => 'arfaizun62@gmail.com',
            'password' => bcrypt('12345'), // Hash password
        ]);
    }
}
