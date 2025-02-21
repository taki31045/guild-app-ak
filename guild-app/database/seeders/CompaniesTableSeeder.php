<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyUsers = DB::table('users')->where('role_id', 2)->get();

        foreach ($companyUsers as $user) {
            DB::table('companies')->insert([
                'user_id' => $user->id,
                'address' => '123 Company St, Tokyo, Japan',
                'website' => 'https://company' . $user->id . '.example.com',
                'paypal_account' => 'company' . $user->id . '_paypal@example.com',
                'total_spent' => rand(1000, 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
