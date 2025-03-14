<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsSeeder extends Seeder
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
                'balance' => 0.00,
                'total_fee_revenue' => 0.00,
                'escrow_balance' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
