<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePracticeAreaServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('practice_area_service_edit');
    }

    public function rules()
    {
        return [
            'practice_area_id'  => 'nullable|integer|exists:practice_areas,id',
            'title'             => 'nullable|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:practice_area_services,slug,' . request()->route('practice_area_service')->id,
            'icon_class'        => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'button_text'       => 'nullable|string|max:255',
            'url'               => 'nullable|string|max:255',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string|max:255',
        ];
    }
}
