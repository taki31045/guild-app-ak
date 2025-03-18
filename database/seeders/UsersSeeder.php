<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Admin User
            [
                'username' => 'admin_master',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adminpassword'),
                'role_id' => 1, // Admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Company Users (username = 会社名, name = 会社名)
            [
                'username' => 'Kredo Japan',
                'name' => 'Kredo Japan',
                'email' => 'Kredo@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => 2, // Company
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Cloud Solutions Inc',
                'name' => 'Cloud Solutions Inc.',
                'email' => 'info@cloudsolutions.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => 2, // Company
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Startup Innovators',
                'name' => 'Startup Innovators',
                'email' => 'hello@startup.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => 2, // Company
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Freelancer Users (username = ニックネーム, name = フルネーム)
            [
                'username' => 'emily',
                'name' => 'Emily Davis',
                'email' => 'emily@freelance.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => 3, // Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mike',
                'name' => 'Michael Lee',
                'email' => 'michael@freelance.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => 3, // Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'olivia',
                'name' => 'Olivia Thompson',
                'email' => 'olivia@freelance.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => 3, // Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
