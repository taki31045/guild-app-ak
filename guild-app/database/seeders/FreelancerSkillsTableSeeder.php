<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FreelancerSkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freelancer = DB::table('freelancers')->first();
        $skills = DB::table('skills')->pluck('id')->toArray();

        if ($freelancer && !empty($skills)) {
            foreach (array_rand($skills, 3) as $index) {
                DB::table('freelancer_skills')->insert([
                    'freelancer_id' => $freelancer->id,
                    'skill_id' => $skills[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
