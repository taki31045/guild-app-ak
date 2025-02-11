<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            CompaniesTableSeeder::class,
            FreelancersTableSeeder::class,
            ProjectsTableSeeder::class,
            ApplicationsTableSeeder::class,
            FavoriteFreelancersTableSeeder::class,
            FavoriteProjectsTableSeeder::class,
            ProjectCommentsTableSeeder::class,
            TransactionsTableSeeder::class,
            EvaluationsTableSeeder::class,
            MessagesTableSeeder::class,
            SkillsTableSeeder::class,
            FreelancerSkillsTableSeeder::class,
            ProjectSkillsTableSeeder::class,
        ]);
    }
}
