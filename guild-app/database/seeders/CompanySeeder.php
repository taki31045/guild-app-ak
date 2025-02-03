<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [];
        for($i = 2; $i <= 4; $i++){
            $companies[] = [
                'user_id' => $i,
                'address'         => 'Cebu city' . $i,
                'website'         => 'company' . $i . '.com',
                'paypal_account'  => 'company' . $i . '@example.com',
                'total_spent'     => 9000,
                'created_at'      => NOW(),
                'updated_at'      => NOW()
            ];
        }
        DB::table('companies')->insert($companies);
    }
}
