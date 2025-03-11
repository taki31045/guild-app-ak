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

//ongoingのページに今ongoingのプロジェクトを表示させる。また、移動
    public function index(){
        $user = Auth::user();
        $projects = $user->company->projects->where('status','open')->all();
        $projects_progress = $user->company->projects->where('status','ongoing')->all();

        $company = $user->company;
        // $favoriteFreelancers = $company->favoriteFreelancers()->with('freelancer.user')->get();なるべく一度のクエリでまとめることができるなら、withを使用してN＋１問題を回避してパフォーマンスをよくしよう。
        $favoriteFreelancers = $company->favoriteFreelancers;

        return view('companies.projects.on_going', compact('projects','favoriteFreelancers','projects_progress'));
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


//favorite freelancerを表示させるため　また移動
    public function favorite_freelancer_list(){
        $user = Auth::user();
        $company = $user->company;
        $favoriteFreelancers = $company->ListOffavoriteFreelancers;

        return view('companies.freelancers.favorite_freelancer_list', compact('favoriteFreelancers'));
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


//projectの作成
    public function store(CommentRequest $request){
        ProjectComment::create([
            'content'    => $request->content,
            'user_id'    => Auth::user()->id,
            'project_id' => $request->id
        ]);

        return redirect()->route('company.project.detail', $request->id);
    }



//プロジェクトに対するフリーランサーのおすすめ
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

    return view('companies.projects.recommended_freelancers', compact('freelancers', 'project'));
}

}
//ongoingのページに今ongoingのプロジェクトを表示させる。また、移動
//project_listを表示させる。　また移動
//favorite freelancerを表示させるため　また移動
//companyのprojectの詳細を表示
//projectの作成
//プロジェクトに対するフリーランサーのおすすめ

//evaluationのページに移動
//評価をデータベースに保存する。

//freelancer listのページに移動。また絞り込み
//freelancerのいいね追加

//freelancer and companyのmessageのやりとり
//-----
//adminとcontactを取るためのpageに移動するだけもの
//adminへのコンタクトはgmailを使用する。そのためのfunction

//profileの編集
//profileのページに移動

//project作成のためのpageに移動
//projectの作成
//projectの編集をするためのpageに移動
//projectの編集
//projectのdelete

//ongoingのrequested時のdecline