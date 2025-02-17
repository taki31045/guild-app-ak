<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'todos'        => 'nullable|array',
            'todos.*.id'   => 'nullable|exists:todos,id',
            'todos.*.content' => 'nullable|string|max:255',
            'deleted_todos' => 'nullable|string'
        ];
    }
}
