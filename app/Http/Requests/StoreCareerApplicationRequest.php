<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCareerApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name'              => 'required|string|max:255',
            'phone'                  => 'required|string|max:30',
            'email'                  => 'required|email|max:255',
            'city_state'             => 'required|string|max:255',

            'college_university'     => 'nullable|string|max:255',
            'course_year'            => 'nullable|string|max:255',

            'internship_type'        => 'required|string|max:255',
            'practice_area_interest' => 'nullable|string|max:255',

            'preferred_start_date'   => 'nullable|date',
            'preferred_duration'     => 'nullable|string|max:255',

            'message'                => 'required|string',
            'consent'                => 'required|accepted',

            'resume'                 => 'required|file|mimes:pdf,doc,docx|max:5120',
        ];
    }
}