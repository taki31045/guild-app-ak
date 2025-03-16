<?php

namespace App\Http\Controllers\Company\Evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    //evaluationのページに移動
    public function index($id){
        session()->put('project_id', $id);
        return view('companies.projects.evaluation');
    }

//評価をデータベースに保存する。
    public function store(EvaluationRequest $request){
        $project_id = session('project_id');
       $id =  Application::where('project_id',$project_id)->first();
        $company_id = Auth::user()->company->id;
        Evaluation::create([
            'quality' => $request->quality,
            'communication' => $request->communication,
            'adherence' => $request->adherence,
            'total' => $request->total,
            // あとで考える　重要
            'company_id' => $company_id,
            'freelancer_id' => $id->freelancer_id,
            'project_id' => $project_id
        ]);

        Application::where('project_id',$project_id)->update(['status'=>'resulted']);

        return redirect()->route('company.project.on_going')->with('success','thank you');

    }
}
