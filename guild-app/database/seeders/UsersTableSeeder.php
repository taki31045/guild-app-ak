<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin ユーザー (1人)
            [
                'username' => 'admin_user',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Company ユーザー (3人)
            [
                'username' => 'company_user1',
                'name' => 'Company User 1',
                'email' => 'company1@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'company_user2',
                'name' => 'Company User 2',
                'email' => 'company2@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'company_user3',
                'name' => 'Company User 3',
                'email' => 'company3@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Freelancer ユーザー (3人)
            [
                'username' => 'freelancer_user1',
                'name' => 'Freelancer User 1',
                'email' => 'freelancer1@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'freelancer_user2',
                'name' => 'Freelancer User 2',
                'email' => 'freelancer2@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'freelancer_user3',
                'name' => 'Freelancer User 3',
                'email' => 'freelancer3@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
