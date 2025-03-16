<?php

namespace App\Http\Controllers\company\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;
use App\Models\ProjectComment;
use App\Models\Freelancer;

class ProjectViewController extends Controller
{
    //ongoingのページに今ongoingのプロジェクトを表示させる。また、移動
    public function index(){
        $user = Auth::user();
        $projects_progress = $user->company->projects->where('status','ongoing')->all();

        $company = $user->company;
        // $favoriteFreelancers = $company->favoriteFreelancers()->with('freelancer.user')->get();なるべく一度のクエリでまとめることができるなら、withを使用してN＋１問題を回避してパフォーマンスをよくしよう。
        $favoriteFreelancers = $company->favoriteFreelancers;

        return view('companies.projects.on_going', compact('favoriteFreelancers','projects_progress'));
    }


    //project_listを表示させる。　また移動
    public function project_list(){
        $user = Auth::user();
        $projects = $user->company->projects->where('status','open')->all();

        // 各プロジェクトごとのおすすめフリーランサーの数を取得
    foreach ($projects as $project) {
        $skillIds = $project->skills->pluck('id');

        // スキルに一致するフリーランサーの数を取得
        $project->recommended_freelancers_count = Freelancer::whereHas('skills', function ($query) use ($skillIds) {
            $query->whereIn('skills.id', $skillIds);
        })->count();
    }

        return view('companies.projects.list', compact('projects'));
    }


    //companyのprojectの詳細を表示
    public function show($id){
        $project = Project::findOrFail($id);
        $all_comments = ProjectComment::where('project_id', $id)->get();

        $application = $project->application ?? null;

        $layout = match (Auth::user()->role_id) {
            1 => 'layouts.admin',      // 管理者
            2 => 'layouts.company',    // 企業

        };

        return view('companies.projects.details', compact('project', 'all_comments', 'application','layout'));
    }
}
