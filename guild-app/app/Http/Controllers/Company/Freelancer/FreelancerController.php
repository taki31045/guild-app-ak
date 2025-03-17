<?php

namespace App\Http\Controllers\Company\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Freelancer;
use App\Models\Skill;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
class FreelancerController extends Controller
{
    //freelancer listのページに移動。また絞り込み
    public function index(Request $request){
        $query = Freelancer::query();

        if($request->filled('required_rank')){
            $query->where('rank', '=', $request->required_rank);
        }

        if($request->filled('skills')){
            $skills = $request->input('skills');
            $query->whereHas('skills', function($q) use ($skills){
                $q->whereIn('skills.id', $skills);
            });
        }


        if($request->sort == 'old'){
            $query->orderBy('created_at', 'asc');
        }else{
            $query->orderBy('created_at', 'desc');
        }

        $freelancers = $query->get();
        $all_skills = Skill::all();

        return view('companies.freelancers.list',compact('freelancers','all_skills'));
    }


    public function show($id){

        $user = User::findOrFail($id);
        $freelancer = $user->freelancer;

        $layout = match (Auth::user()->role_id) {
            1 => 'layouts.admin',      // 管理者
            2 => 'layouts.company',    // 企業
            3 => 'layouts.freelancer', // フリーランサー

        };

        $styles = match (Auth::user()->role_id) {
            1 => 'css/admins/freelancer-profile.css',      // 管理者
            2 => 'css/users/profile.css',    // 企業
            3 => 'css/users/profile.css', // フリーランサー
        };

        if($freelancer){
            if($freelancer->evaluations()){
                $evaluations = $freelancer->evaluations()->get();
            }
            if($freelancer->applications()){
                $ongoingProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', '!=', 'completed')
                                                ->get();

            }
                $completedProjects  = Transaction::where('payee_id', $id)->with('project')->get();
                $favoriteProjects = $user->favoriteProjects()->get();
        }else{
            $evaluations = collect();
            $ongoingProjects = collect();
            $completedProjects = collect();
            $favoriteProjects = collect();
        }

        return view('companies.freelancers.show', compact('user', 'evaluations', 'ongoingProjects', 'completedProjects', 'favoriteProjects','layout','styles'));
    }
}
