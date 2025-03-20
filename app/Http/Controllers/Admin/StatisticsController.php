<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\DB; // ← ここを修正
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

    public function getSkillStatistics()
    {
        // スキルごとの集計データを取得
        $skills = DB::table('project_skills')
            ->join('skills', 'project_skills.skill_id', '=', 'skills.id')
            ->select('skills.name', DB::raw('COUNT(project_skills.skill_id) as count'))
            ->groupBy('skills.name')
            ->orderByDesc('count')
            ->get();

        return response()->json($skills);
    }
}