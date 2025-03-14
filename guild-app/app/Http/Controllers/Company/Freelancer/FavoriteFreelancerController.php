<?php

namespace App\Http\Controllers\Company\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Freelancer;
use Illuminate\Support\Facades\Auth;



class FavoriteFreelancerController extends Controller
{
    public function favorite_freelancer_list(){
        $user = Auth::user();
        $company = $user->company;
        $favoriteFreelancers = $company->ListOffavoriteFreelancers;

        return view('companies.freelancers.favorite_freelancer_list', compact('favoriteFreelancers'));
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
