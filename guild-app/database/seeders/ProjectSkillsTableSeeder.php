<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjectSkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = DB::table('projects')->get();
        $skills = DB::table('skills')->pluck('id')->toArray();

        foreach ($projects as $project) {
            // 各プロジェクトにランダムなスキルを 2〜5 つ関連付ける
            $randomSkills = array_rand(array_flip($skills), rand(2, 5));

            foreach ($randomSkills as $skill_id) {
                DB::table('project_skills')->insert([
                    'project_id' => $project->id,
                    'skill_id' => $skill_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
