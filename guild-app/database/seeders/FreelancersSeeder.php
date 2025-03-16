<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FreelancersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freelancerUsers = DB::table('users')->where('role_id', 3)->get();

        $freelancers = [
            [
                'user_id' => $freelancerUsers[0]->id,
                'rank' => 1,
                'rank_point' => 150,
                'github' => 'https://github.com/dev_emily',
                'X' => 'https://x.com/dev_emily',
                'instagram' => 'https://instagram.com/dev_emily',
                'facebook' => 'https://facebook.com/dev.emily',
                'total_earnings' => 75000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $freelancerUsers[1]->id,
                'rank' => 3,
                'rank_point' => 200,
                'github' => 'https://github.com/data_mike',
                'X' => 'https://x.com/data_mike',
                'instagram' => 'https://instagram.com/data_mike',
                'facebook' => 'https://facebook.com/data.mike',
                'total_earnings' => 120000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $freelancerUsers[2]->id,
                'rank' => 5,
                'rank_point' => 90,
                'github' => 'https://github.com/ui_olivia',
                'X' => 'https://x.com/ui_olivia',
                'instagram' => 'https://instagram.com/ui_olivia',
                'facebook' => 'https://facebook.com/ui.olivia',
                'total_earnings' => 45000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('freelancers')->insert($freelancers);
    }
}
