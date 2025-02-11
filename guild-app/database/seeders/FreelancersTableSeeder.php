<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FreelancersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freelancerUser = DB::table('users')->where('role_id', 3)->first();

        if ($freelancerUser) {
            DB::table('freelancers')->insert([
                'user_id' => $freelancerUser->id,
                'rank' => 3,
                'rank_point' => 6,
                'github' => 'https://github.com/freelancer',
                'instagram' => 'https://instagram.com/freelancer',
                'total_earnings' => 3000.00,
                'avg_evaluation' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
