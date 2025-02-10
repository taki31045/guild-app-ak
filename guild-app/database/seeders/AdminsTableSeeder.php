<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = DB::table('users')->where('role_id', 1)->first();

        if ($adminUser) {
            DB::table('admins')->insert([
                'user_id' => $adminUser->id,
                'balance' => 10000.00,
                'total_fee_revenue' => 500.00,
                'escrow_balance' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
