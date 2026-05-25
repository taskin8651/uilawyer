<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreArticleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('article_create');
    }

    public function rules()
    {
        return [
            'article_category_id' => 'nullable|integer|exists:article_categories,id',
            'title'              => 'nullable|string|max:255',
            'slug'               => 'nullable|string|max:255|unique:articles,slug',
            'author_name'        => 'nullable|string|max:255',
            'submitter_email'    => 'nullable|email|max:255',
            'submitter_phone'    => 'nullable|string|max:30',
            'published_date'     => 'nullable|date',
            'short_description'  => 'nullable|string',
            'description'        => 'nullable|string',
            'is_public_submission' => 'nullable|boolean',
            'is_latest'          => 'nullable|boolean',
            'status'             => 'nullable|boolean',
            'sort_order'         => 'nullable|integer',
            'meta_title'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string',
            'meta_keywords'      => 'nullable|string|max:255',
            'article_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'article_document'   => 'nullable|file|mimes:pdf,doc,docx|max:8192',
            'payment_screenshot' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
