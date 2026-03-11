<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@blog.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'John Doe',
            'email'    => 'john@blog.com',
            'password' => bcrypt('password'),
            'role'     => 'user',
        ]);

        User::create([
            'name'     => 'Jane Smith',
            'email'    => 'jane@blog.com',
            'password' => bcrypt('password'),
            'role'     => 'user',
        ]);
    }
}
