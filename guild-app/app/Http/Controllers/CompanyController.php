<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\User;
use App\Models\FavoriteFreelancer;
use App\Models\Project;
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

        return view('companies.project_list', compact('projects'));
    }

    public function favorite_freelancer_list(){
        $user = Auth::user();
        $company = $user->company;
        $favoriteFreelancers = $company->favoriteFreelancers;

        return view('companies.favorite_freelancer_list', compact('favoriteFreelancers'));

    }
}
