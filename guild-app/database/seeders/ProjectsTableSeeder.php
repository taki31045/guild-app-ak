<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = DB::table('companies')->get();

        foreach ($companies as $company) {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('projects')->insert([
                    'title' => "Project {$i} for Company {$company->user_id}",
                    'description' => 'This is a sample project description.',
                    'required_rank' => rand(1, 5),
                    'deadline' => now()->addDays(rand(10, 60)),
                    'reward_amount' => rand(2000, 10000),
                    'status' => 'open',
                    'company_id' => $company->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
