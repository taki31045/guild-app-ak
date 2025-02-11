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
        $user = DB::table('users')->first();
        $project = DB::table('projects')->first();

        if ($user && $project) {
            DB::table('project_comments')->insert([
                'content' => 'This looks like an interesting project!',
                'user_id' => $user->id,
                'project_id' => $project->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
