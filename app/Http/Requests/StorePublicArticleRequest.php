<?php

namespace App\Http\Requests;

use App\Rules\MeaningfulText;
use App\Rules\PersonName;
use App\Rules\ValidPhoneNumber;
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
            'title' => ['required', 'string', 'min:8', 'max:255', new MeaningfulText(8, 3)],
            'author_name' => ['required', 'string', 'max:255', new PersonName],
            'submitter_email' => 'required|email:rfc,filter|max:255',
            'submitter_phone' => ['required', 'string', 'max:30', new ValidPhoneNumber],
            'short_description' => ['required', 'string', 'min:30', 'max:2000', new MeaningfulText(30, 6)],
            'description' => ['required', 'string', 'min:150', new MeaningfulText(150, 30)],
            'article_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|min:10|max:4096|dimensions:min_width=300,min_height=180',
            'article_document' => 'nullable|file|mimes:pdf,doc,docx|min:10|max:8192',
            'payment_screenshot' => 'required|image|mimes:jpg,jpeg,png,webp|min:10|max:4096|dimensions:min_width=200,min_height=200',
        ];
    }

    public function messages()
    {
        return [
            'payment_screenshot.required' => 'Payment screenshot is required.',
            'payment_screenshot.min' => 'Payment screenshot file is too small. Please upload a valid screenshot.',
            'payment_screenshot.dimensions' => 'Payment screenshot image is too small or invalid.',
            'article_image.min' => 'Article image file is too small. Please upload a valid image.',
            'article_document.min' => 'Article document file is too small. Please upload a valid PDF/DOC/DOCX file.',
        ];
    }
}
