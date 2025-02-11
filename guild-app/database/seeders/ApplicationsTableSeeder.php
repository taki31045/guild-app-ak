<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freelancer = DB::table('freelancers')->first();
        $project = DB::table('projects')->first();

        if ($freelancer && $project) {
            DB::table('applications')->insert([
                'freelancer_id' => $freelancer->id,
                'project_id' => $project->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
