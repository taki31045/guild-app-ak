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
        $company = DB::table('companies')->first();

        if ($company) {
            DB::table('projects')->insert([
                'title' => 'Web Application Development',
                'description' => 'Build a full-stack Laravel and Vue.js application.',
                'required_rank' => 2,
                'deadline' => now()->addDays(30),
                'reward_amount' => 5000.00,
                'status' => 'open',
                'company_id' => $company->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
