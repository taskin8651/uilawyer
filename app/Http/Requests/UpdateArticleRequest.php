<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateArticleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('article_edit');
    }

    public function rules()
    {
        return [
            'article_category_id' => 'nullable|integer|exists:article_categories,id',
            'title'              => 'nullable|string|max:255',
            'slug'               => 'nullable|string|max:255|unique:articles,slug,' . request()->route('article')->id,
            'author_name'        => 'nullable|string|max:255',
            'published_date'     => 'nullable|date',
            'short_description'  => 'nullable|string',
            'description'        => 'nullable|string',
            'read_more_text'     => 'nullable|string|max:255',
            'read_more_url'      => 'nullable|string|max:255',
            'is_latest'          => 'nullable|boolean',
            'status'             => 'nullable|boolean',
            'sort_order'         => 'nullable|integer',
            'meta_title'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string',
            'meta_keywords'      => 'nullable|string|max:255',
            'article_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}