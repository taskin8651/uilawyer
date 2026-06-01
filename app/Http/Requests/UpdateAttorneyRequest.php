<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAttorneyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attorney_edit');
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'place_of_practice' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'about_team' => 'nullable|string|max:3000',
            'biography' => 'nullable|string',
            'qualifications' => 'nullable|string|max:2000',
            'practice_areas_text' => 'nullable|string|max:2000',
            'courts_represented' => 'nullable|string|max:2000',
            'languages_spoken' => 'nullable|string|max:1000',
            'profile_summary' => 'nullable|string|max:1000',
            'badge' => 'nullable|string|max:255',

            'meta_icons' => 'nullable|array',
            'meta_icons.*' => 'nullable|string|max:255',
            'meta_texts' => 'nullable|array',
            'meta_texts.*' => 'nullable|string|max:255',

            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',

            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',

            'attorney_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }
}
