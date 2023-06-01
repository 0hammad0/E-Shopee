<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cateogoryName' => [
                'required',
                'string',
            ],
            'categorySlug' => [
                'required',
                'string',
            ],
            'categoryDescription' => [
                'required',
            ],
            'categoryImage' => [
                'nullable',
                'mimes:png,jpg,jpeg'
            ],
            'categoryStatus' => [
                'required',
                'string',
            ],
            'categoryMetaTitle' => [
                'required',
                'string',
            ],
            'categoryMetaKeyword' => [
                'required',
                'string',
            ],
            'categoryMetaDescription' => [
                'required',
                'string',
            ],
        ];
    }
}
