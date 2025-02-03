<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freelancers = [];
        for($i = 5; $i <= 7; $i++){
            $freelancers[] = [
                'user_id'         => $i,
                'rank'            => 3,
                'rank_point'      => 7,
                'github'          => 'github' . $i,
                'X'          => 'x' . $i,
                'instagram'          => 'instagram' . $i,
                'facebook'          => 'facebook' . $i,
                'total_earnings'     => 9000,
                'avg_evaluation'     => 3.5,
                'created_at'      => NOW(),
                'updated_at'      => NOW()
            ];
        }
        DB::table('freelancers')->insert($freelancers);
    }
}
