<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePracticeAreaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('practice_area_create');
    }

    public function rules()
    {
        return [
            'title'             => 'nullable|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:practice_areas,slug',
            'icon_class'        => 'nullable|string|max:255',
            'button_text'       => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'issue_overview'    => 'nullable|string',
            'legal_position'    => 'nullable|string',
            'remedies'          => 'nullable|string',
            'documents_required' => 'nullable|string',
            'process_overview'  => 'nullable|string',
            'when_to_consult_lawyer' => 'nullable|string',
            'faq_questions'     => 'nullable|array',
            'faq_questions.*'   => 'nullable|string|max:500',
            'faq_answers'       => 'nullable|array',
            'faq_answers.*'     => 'nullable|string|max:2000',
            'faq_statuses'      => 'nullable|array',
            'faq_statuses.*'    => 'nullable|boolean',
            'faq_sort_orders'   => 'nullable|array',
            'faq_sort_orders.*' => 'nullable|integer',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string|max:255',
            'practice_area_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
