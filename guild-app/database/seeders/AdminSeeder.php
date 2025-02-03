<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'user_id'            => '1',
            'balance'            => 27000,
            'total_fee_revenue'  => 2000,
            'escrow_balance'     => 25000,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
