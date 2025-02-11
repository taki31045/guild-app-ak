<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freelancer = DB::table('freelancers')->first();
        $company = DB::table('companies')->first();
        $project = DB::table('projects')->first();

        if ($freelancer && $company && $project) {
            DB::table('evaluations')->insert([
                'quality' => 2,
                'communication' => 4,
                'adherence' => 3,
                'total' => 4,
                'freelancer_id' => $freelancer->id,
                'company_id' => $company->id,
                'project_id' => $project->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
