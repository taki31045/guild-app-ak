<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index(){
        return view('companies.evaluation');
    }

    public function store(EvaluationRequest $request){
        $company_id = Auth::user()->company->id;
        Evaluation::create([
            'quality' => $request->quality,
            'communication' => $request->communication,
            'adherence' => $request->adherence,
            'total' => $request->total,
            // あとで考える　重要
            'company_id' => $company_id,
            'freelancer_id' => Auth::user()->id,
            'project_id' => $company_id
        ]);

    }
}