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
        $companyUser = DB::table('users')->where('role_id', 2)->first();

        if ($companyUser) {
            DB::table('companies')->insert([
                'user_id' => $companyUser->id,
                'address' => '123 Company St, Tokyo, Japan',
                'website' => 'https://company.example.com',
                'paypal_account' => 'company_paypal@example.com',
                'total_spent' => 5000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
