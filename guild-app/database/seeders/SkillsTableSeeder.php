<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laravel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'JavaScript', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vue.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'React', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Node.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Python', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Django', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ruby on Rails', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SQL', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('skills')->insert($skills);
    }
}
