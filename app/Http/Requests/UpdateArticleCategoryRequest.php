<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateArticleCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('article_category_edit');
    }

    public function rules()
    {
        return [
            'name'       => 'nullable|string|max:255',
            'slug'       => 'nullable|string|max:255|unique:article_categories,slug,' . request()->route('article_category')->id,
            'sort_order' => 'nullable|integer',
            'status'     => 'nullable|boolean',
        ];
    }
}