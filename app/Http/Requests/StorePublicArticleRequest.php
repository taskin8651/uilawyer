<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicArticleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'article_category_id' => 'nullable|integer|exists:article_categories,id',
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'submitter_email' => 'required|email|max:255',
            'submitter_phone' => 'required|string|max:30',
            'short_description' => 'required|string|max:2000',
            'description' => 'required|string',
            'article_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'article_document' => 'nullable|file|mimes:pdf,doc,docx|max:8192',
            'payment_screenshot' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
