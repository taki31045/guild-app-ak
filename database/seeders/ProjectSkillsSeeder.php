<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjectSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = DB::table('projects')->pluck('id')->toArray();
        $skills = DB::table('skills')->pluck('id')->toArray();

        $projectSkills = [];

        foreach ($projects as $project) {
            $selectedSkills = array_rand($skills, rand(3, 5)); // 3〜5個のスキルをランダムに紐付け
            foreach ($selectedSkills as $index) {
                $projectSkills[] = [
                    'project_id' => $project,
                    'skill_id' => $skills[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('project_skills')->insert($projectSkills);
    }
}
