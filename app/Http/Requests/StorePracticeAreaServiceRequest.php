<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePracticeAreaServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('practice_area_service_create');
    }

    public function rules()
    {
        return [
            'practice_area_id'  => 'nullable|integer|exists:practice_areas,id',
            'title'             => 'nullable|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:practice_area_services,slug',
            'icon_class'        => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string|max:255',
        ];
    }
}
