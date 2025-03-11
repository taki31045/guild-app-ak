<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Freelancer;
use App\Models\Skill;
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


//freelancerのいいね追加
    public function favorite(Request $request, $freelancerId)
    {
        $company = Auth::user()->company;
        $freelancer = Freelancer::findOrFail($freelancerId);
    
        if ($company->favoriteFreelancers()->where('freelancer_id', $freelancerId)->exists()) {
            // すでにお気に入り → 削除
            $company->favoriteFreelancers()->detach($freelancerId);
            return response()->json(['favorite' => false]);
        } else {
            // お気に入り追加
            $company->favoriteFreelancers()->attach($freelancerId);
            return response()->json(['favorite' => true]);
        }
    }
    

    
}
//freelancer listのページに移動。また絞り込み
//freelancerのいいね追加