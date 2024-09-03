<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:10|unique:categories,name',
            'description' => 'required|string|min:10'
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'name.required' => 'နာမည်လေးထည့်ပေးပါ',
    //         'description.required' => 'အကြောင်းအရာထည့်ပေးပါ'
    //     ];
    // }
}
