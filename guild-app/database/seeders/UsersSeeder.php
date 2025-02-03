<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username'   => 'admin',
            'name'       => 'John',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('11111111'),
            'avatar'     => NULL,
            'role_id'       => User::ADMIN_ROLE_ID,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        $companies = [];
        for($i = 1; $i <= 3; $i++){
            $companies[] = [
                'username' => 'company' . $i,
                'name'       => 'John' . $i,
                'email'    => 'company' . $i . '@example.com',
                'password' => Hash::make('company' . $i),
                'role_id'     => User::COMPANY_ROLE_ID,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ];
        }
        DB::table('users')->insert($companies);

        $freelancers = [];
        for($i = 1; $i <= 3; $i++){
            $freelancers[] = [
                'username' => 'freelancer' . $i,
                'name'       => 'John' . $i,
                'email'    => 'freelancer' . $i . '@example.com',
                'password' => Hash::make('freelancer' . $i),
                'role_id'     => User::FREELANCER_ROLE_ID,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ];
        }
        DB::table('users')->insert($freelancers);
    }
}
