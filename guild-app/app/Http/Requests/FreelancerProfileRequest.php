<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreelancerProfileRequest extends FormRequest
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
        return [
            'username'   => 'required|string|max:255',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'github_id'  => 'nullable|string|max:255',
            'x'          => 'nullable|string|max:255',
            'instagram'  => 'nullable|string|max:255',
            'facebook'   => 'nullable|string|max:255',
            'skills'     => 'nullable',
            'avatar'     => 'mimes:jpeg,jpg,png,gif|max:1048'
        ];
    }
}
