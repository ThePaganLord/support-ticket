<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('Admin123!'),
        ]);
        User::create([
            'name' => 'Demo',
            'email' => 'demo@email.com',
            'password' => bcrypt('Demo123!'),
        ]);
    }
}
