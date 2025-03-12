<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->createProjectRules();
        // return $this->evaluateFreelancerWorkRules();
    }

    
    private function createProjectRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'required_rank' => 'required|integer|min:1|max:5',
            'deadline' => 'required|date',
            'reward_amount' => 'required|numeric',
            'skills' => 'nullable|string',
        ];
    }

    // private function evaluateFreelancerWorkRules(): array 
    // {
    //     return [
    //         'quality' => 'required',
    //         'communication' => 'required',
    //         'adherence' => 'required',
    //         'total' => 'required'
    //     ];
    // }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.string' => 'タイトルは文字列で入力してください。',
            'title.max' => 'タイトルは255文字以内で入力してください。',

            'description.required' => 'プロジェクトの説明は必須です。',
            'description.string' => '説明は文字列で入力してください。',

            'required_rank.required' => '必要ランクは必須です。',
            'required_rank.integer' => '必要ランクは整数で入力してください。',
            'required_rank.min' => '必要ランクは1以上で指定してください。',
            'required_rank.max' => '必要ランクは5以下で指定してください。',

            'deadline.date' => '締切日は正しい日付形式で入力してください。',

            'reward_amount.required' => '報酬額は必須です。',
            'reward_amount.numeric' => '報酬額は数値で入力してください。',
        ];
    }
}
