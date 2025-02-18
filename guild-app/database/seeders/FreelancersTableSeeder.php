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
        $freelancerUsers = DB::table('users')->where('role_id', 3)->get();

        foreach ($freelancerUsers as $user) {
            DB::table('freelancers')->insert([
                'user_id' => $user->id,
                'rank' => rand(1, 5), // 1〜5 のランダムなランク
                'rank_point' => rand(1, 10),
                'github' => 'https://github.com/freelancer' . $user->id,
                'instagram' => 'https://instagram.com/freelancer' . $user->id,
                'total_earnings' => rand(1000, 10000), // 収益もランダムに
                'avg_evaluation' => rand(30, 50) / 10, // 3.0〜5.0 の評価
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
