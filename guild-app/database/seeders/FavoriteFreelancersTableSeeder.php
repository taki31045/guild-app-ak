<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FavoriteFreelancersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = DB::table('companies')->first();
        $freelancer = DB::table('freelancers')->first();

        if ($company && $freelancer) {
            DB::table('favorite_freelancers')->insert([
                'company_id' => $company->id,
                'freelancer_id' => $freelancer->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
