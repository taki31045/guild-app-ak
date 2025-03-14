<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //  あとでいくつか消す
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            AdminsSeeder::class,
            CompaniesSeeder::class,
            FreelancersSeeder::class,
            SkillsSeeder::class,
            ProjectsSeeder::class,
            ProjectSkillsSeeder::class,
        ]);
    }
}
