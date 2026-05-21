<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreAttorneyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attorney_create');
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:255',

            'meta_icons' => 'nullable|array',
            'meta_icons.*' => 'nullable|string|max:255',
            'meta_texts' => 'nullable|array',
            'meta_texts.*' => 'nullable|string|max:255',

            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',

            'profile_button_text' => 'nullable|string|max:255',
            'profile_button_url' => 'nullable|string|max:255',

            'consult_button_text' => 'nullable|string|max:255',
            'consult_button_url' => 'nullable|string|max:255',

            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',

            'attorney_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}