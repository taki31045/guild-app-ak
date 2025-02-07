<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Freelancer;
use App\Models\Company;
use App\Models\User;

class DashboardController extends Controller
{   
    private $freelancer;
    private $company;

    public function __construct(Freelancer $freelancer_model, Company $company_model){
        $this->freelancer = $freelancer_model;
        $this->company = $company_model;
    }
    

    public function getAllFreelancers(){
        $all_freelancers = $this->freelancer
        ->with(['user' => function ($query){
            $query->withTrashed();
        }])
        ->with(['skills'])
        ->withTrashed()->orderBy('id', 'asc')->paginate(4);

        return view('admins.freelancer')
                ->with('all_freelancers', $all_freelancers);
    }

    public function deactivate($id){
        $freelancer = $this->freelancer->findOrFail($id);
        $freelancer->user()->delete();
        $freelancer->delete();
        return redirect()->route('admin.freelancer');
    }

    public function activate($id){
        $freelancer = $this->freelancer->withTrashed()->findOrFail($id);
        $user = $freelancer->user;
        if ($user && $user->trashed()){
            $user->restore();
        }
        
        $freelancer->restore();
        return redirect()->route('admin.freelancer');
    }

    public function getAllCompanies(){
        $all_companies = $this->company
        ->with(['user' => function ($query){
            $query->withTrashed();
        }])
        ->withTrashed()->orderBy('id', 'asc')->paginate(4);

        return view('admins.company')
                ->with('all_companies', $all_companies);
    }

    public function deactivateCompany($id){
        $company = $this->company->findOrFail($id);
        $company->user()->delete();
        $company->delete();
        return redirect()->route('admin.company');
    }

    public function activateCompany($id){
        $company = $this->company->withTrashed()->findOrFail($id);
        $user = $company->user;
        if ($user && $user->trashed()){
            $user->restore();
        }
        
        $company->restore();
        return redirect()->route('admin.company');
    }

}
