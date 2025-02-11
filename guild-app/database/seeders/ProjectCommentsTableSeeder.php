<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjectCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = DB::table('projects')->first();
        $skills = DB::table('skills')->pluck('id')->toArray();

        if ($project && !empty($skills)) {
            foreach (array_rand($skills, 2) as $index) {
                DB::table('project_skills')->insert([
                    'project_id' => $project->id,
                    'skill_id' => $skills[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
