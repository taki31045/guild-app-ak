<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Freelancer;
use App\Models\Company;
use App\Models\User;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\Admin;


class DashboardController extends Controller
{   
    private $freelancer;
    private $company;
    private $project;

    public function __construct(Freelancer $freelancer_model, Company $company_model, Project $project_model){
        $this->freelancer = $freelancer_model;
        $this->company = $company_model;
        $this->project = $project_model;
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

    public function showFreelancer($id){
        $user = User::findOrFail($id);
        $freelancer = $user->freelancer;

        if($freelancer){
            if($freelancer->evaluations()){
                $evaluations = $freelancer->evaluations()->get();
            }
            if($freelancer->applications()){
                $ongoingProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', '!=', 'completed')
                                                ->get();

                $completedProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', 'completed')
                                                ->get();
            }
                $favoriteProjects = $user->favoriteProjects()->get();
        }else{
            $evaluations = collect();
            $ongoingProjects = collect();
            $completedProjects = collect();
            $favoriteProjects = collect();
        }

        return view('admins.freelancer-profile', compact('user', 'evaluations', 'ongoingProjects', 'completedProjects', 'favoriteProjects'));
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

    public function showCompany($id){
        $company = Company::with('projects')->findOrFail($id);
        $projects = $company->projects;
        $user = $company->user;
        
        $transactions = Transaction::where('payer_id', $user->id)
                    ->orWhere('payee_id', $user->id)
                    ->with('project')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admins.company-profile', compact('company','user','projects','transactions'));
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

    public function getAllProjects(){
        $all_projects = Project::with(['company' => function ($query) {
            $query->withTrashed(); 
        }])
        ->withTrashed()->orderBy('id', 'asc')->paginate(4);

        return view('admins.project')
                ->with('all_projects', $all_projects);
    }

    public function deactivateProject($id){
        $project = $this->project->findOrFail($id);
        $project->delete();
        return redirect()->route('admin.project');
    }

    public function activateProject($id){
        $project = $this->project->withTrashed()->findOrFail($id);    
        $project->restore();
        return redirect()->route('admin.project');
    }
    
    public function getAllTransactions(){
        $adminId = User::where('role_id', 1)->value('id');

    // Adminデータ取得
    $admin = Admin::where('user_id', $adminId)->first();
   

    // 関連するプロジェクトと取引情報を取得
    $projects = Project::withTrashed()
        ->with([
            'company.user',
            'application.freelancer.user',

            'transactions' => function ($query) use ($adminId) {
                $query->where('payer_id', $adminId)
                      ->orWhere('payee_id', $adminId)
                      ->orderBy('created_at', 'asc');
            }
        ])
        ->orderBy('id', 'asc')
        ->paginate(4);


    // ビューにデータを渡す
    return view('admins.transaction', [
        'projects' => $projects,
        'adminId' => $adminId,
        'balance' => $admin->balance ?? 0,
        'totalFeeRevenue' => $admin->total_fee_revenue ?? 0,
        'escrowBalance' => $admin->escrow_balance ?? 0
    ]);
        
}       
        
    //     $adminId = User::where('role_id', 1)->value('id');

    //     // $adminBalance = $this->getAdminBalance($adminId);

    //     $projects = Project::withTrashed()
    //         ->with([
    //         'company.user',
    //         'application.freelancer.user',
    //         'transactions' => function ($query) use ($adminId) {
    //             $query->where('payer_id', $adminId)
    //                 ->orWhere('payee_id', $adminId)
    //                 ->orderBy('created_at', 'asc');
    //         }
    //     ])
    //     ->orderBy('id', 'asc')
    //     ->paginate(4);

    //     return view('admins.transaction')
    //         ->with('projects', $projects)
    //         ->with('adminId', $adminId)
    //         ->with('adminBalance', $adminBalance);

    // }

    // public function showFinancials()
    // {
    //     $admin = Admin::first(); // 管理者データを取得

    //     // 計算メソッドがあるなら更新
    //     $admin->updateFinancials();

    //     return view('admin.financials', [
    //         'balance' => $admin->balance,
    //         'totalFeeRevenue' => $admin->total_fee_revenue,
    //         'escrowBalance' => $admin->escrow_balance,
    //     ]);
    // }

    // private function getAdminBalance($adminId)
    // {
    //     $totalIncome = Transaction::where('payee_id', $adminId)
    //         ->sum(\DB::raw('amount + COALESCE(fee, 0)'));

    //     $totalExpense = Transaction::where('payer_id', $adminId)
    //         ->sum(\DB::raw('amount + COALESCE(fee, 0)'));

    //     return $totalIncome - $totalExpense;
    // }

}