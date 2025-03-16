<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // バックエンド（サーバーサイド言語）
            ['name' => 'PHP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Python', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ruby', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Go', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rust', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'C#', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Java', 'created_at' => now(), 'updated_at' => now()],

            // フロントエンド（HTML/CSS/JS）
            ['name' => 'HTML', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CSS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'JavaScript (ES6+)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TypeScript', 'created_at' => now(), 'updated_at' => now()],

            // フレームワーク・ライブラリ
            ['name' => 'Laravel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Symfony', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Django', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Flask', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ruby on Rails', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Spring Boot', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ASP.NET', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Vue.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'React', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Next.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nuxt.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Svelte', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Angular', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bootstrap', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tailwind CSS', 'created_at' => now(), 'updated_at' => now()]
        ];


        DB::table('skills')->insert($skills);
    }
}
