<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePracticeAreaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('practice_area_edit');
    }

    public function rules()
    {
        return [
            'title'             => 'nullable|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:practice_areas,slug,' . request()->route('practice_area')->id,
            'icon_class'        => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keywords'     => 'nullable|string|max:255',
            'practice_area_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
