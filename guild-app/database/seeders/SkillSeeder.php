<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            [
                'name'       => 'HTML',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'CSS',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'PHP',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'JavaScript',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'TypeScript',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'Java',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'Python',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'Ruby',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'Go',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'C',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'C++',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'C#',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        DB::table('skills')->insert($skills);
    }
}
