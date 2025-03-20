<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('admins.statistics');
    }

    public function getStatisticsData()
    {
        $weeks = [];
        $userCounts = [];
        $projectCounts = [];

        // 過去6週間分のデータを取得
        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

            $weeks[] = $startOfWeek->format('Y-m-d') . ' ~ ' . $endOfWeek->format('Y-m-d');

            $userCounts[] = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
            $projectCounts[] = Project::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        }

        return response()->json([
            'weeks' => $weeks,
            'userCounts' => $userCounts,
            'projectCounts' => $projectCounts
        ]);
    }

        

    public function getProjectSkillStatistics()
    {
        $weeks = [];
        $skills = DB::table('skills')->get();
        $skillData = [];

        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weeks[] = $startOfWeek->format('Y-m-d') . ' ~ ' . $endOfWeek->format('Y-m-d');
        }

        foreach ($skills as $skill) {
            $weeklyCounts = [];

            for ($i = 5; $i >= 0; $i--) {
                $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
                $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

                $count = DB::table('project_skills')  // ← ここは project_skills を参照
                    ->where('skill_id', $skill->id)
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->count();

                $weeklyCounts[] = $count;
            }

            $skillData[] = [
                'name' => $skill->name,
                'weekly_counts' => $weeklyCounts
            ];
        }

        return response()->json([
            'weeks' => $weeks,
            'skills' => $skillData
        ]);
    }

    public function getFreelancerSkillStatistics()
    {
        $weeks = [];
        $skills = DB::table('skills')->get();
        $skillData = [];

        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weeks[] = $startOfWeek->format('Y-m-d') . ' ~ ' . $endOfWeek->format('Y-m-d');
        }

        foreach ($skills as $skill) {
            $weeklyCounts = [];

            for ($i = 5; $i >= 0; $i--) {
                $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
                $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

                $count = DB::table('freelancer_skills')  // ✅ ここで freelancer_skills テーブルを参照
                    ->where('skill_id', $skill->id)
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->count();

                $weeklyCounts[] = $count;
            }

            $skillData[] = [
                'name' => $skill->name,
                'weekly_counts' => $weeklyCounts
            ];
        }

        return response()->json([
            'weeks' => $weeks,
            'skills' => $skillData
        ]);
    }
}