<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Company;
use App\Models\User;
use App\Models\FavoriteFreelancer;
use App\Models\Project;
use App\Models\ProjectComment;
use App\Models\Freelancer;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{

    public function index(){
        $user = Auth::user();
        $projects = $user->company->projects->where('status','open')->all();
        $projects_progress = $user->company->projects->where('status','ongoing')->all();

        $company = $user->company;
        // $favoriteFreelancers = $company->favoriteFreelancers()->with('freelancer.user')->get();なるべく一度のクエリでまとめることができるなら、withを使用してN＋１問題を回避してパフォーマンスをよくしよう。
        $favoriteFreelancers = $company->favoriteFreelancers;

        return view('companies.dashboard', compact('projects','favoriteFreelancers','projects_progress'));
    }

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

        return view('companies.project_list', compact('projects'));
    }

    public function favorite_freelancer_list(){
        $user = Auth::user();
        $company = $user->company;
        $favoriteFreelancers = $company->ListOffavoriteFreelancers;

        return view('companies.favorite_freelancer_list', compact('favoriteFreelancers'));
    }

    public function show($id){
        $project = Project::findOrFail($id);
        $all_comments = ProjectComment::where('project_id', $id)->get();

        $application = $project->application ?? null;

        return view('companies.project-details', compact('project', 'all_comments', 'application'));
    }

    public function store(CommentRequest $request){
        ProjectComment::create([
            'content'    => $request->content,
            'user_id'    => Auth::user()->id,
            'project_id' => $request->id
        ]);

        return redirect()->route('company.project-details', $request->id);
    }

    public function recommendedFreelancers($projectId)
{
    // プロジェクトのスキルを取得
    $project = Project::with('skills')->findOrFail($projectId);

    // プロジェクトのスキルIDを取得
    $skillIds = $project->skills->pluck('id');

    // プロジェクトのスキルと一致するフリーランサーを取得
    $freelancers = Freelancer::whereHas('skills', function ($query) use ($skillIds) {
        $query->whereIn('skills.id', $skillIds);
    })->get();

    return view('companies.recommended_freelancers', compact('freelancers', 'project'));
}

}
