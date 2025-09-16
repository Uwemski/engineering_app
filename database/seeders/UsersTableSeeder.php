<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name'=> 'Admin',
            'email'=> 'admin@test.com',
            'password'=> bcrypt('password'),
            'role'=> 'admin'
        ]);

        User::create([
            'name'=> 'Engineer',
            'email'=> 'engineer@test.com',
            'password'=> bcrypt('password'),
            'role'=> 'engineer'
        ]);
    
        User::create([
            'name' => 'Client',
            'email'=> 'client@example.com',
            'password'=> bcrypt('password'),
            'role'=> 'client'
        ]);

    }
}
