<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return true;
        return Auth::id() === 1; // SOLOUSER ID 1 PUO' CREARE
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|bail|min:3|max:200|unique:projects,title',
            'thumb' => 'nullable|image|max:300',
            'description' => 'nullable|bail|min:3|max:500',
            'tech' => 'nullable|bail|min:3|max:200',
            'github' => 'nullable|bail|min:3|max:2048',
            'link' => 'nullable|bail|min:3|max:2048',
        ];
    }
}
