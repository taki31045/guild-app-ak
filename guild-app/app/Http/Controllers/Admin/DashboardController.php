<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Freelancer;

class DashboardController extends Controller
{   
    private $freelancer;

    public function __construct(Freelancer $freelancer_model){
        $this->freelancer = $freelancer_model;
    }

    

    public function getAllFreelancers(){
        $all_freelancers = $this->freelancer
        ->with(['user' => function ($query){
            $query->withTrashed();
        }])
        ->with(['skills'])
        ->withTrashed()->latest()->paginate(4);

        return view('admins.freelancer')
                ->with('all_freelancers', $all_freelancers);
    }

    public function deactivate($id){
        $this->freelancer->findOrFail($id);
        $freelancer->user()->delete();
        return redirect()->back();
    }

    public function activate($id){

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back();
    }


}
