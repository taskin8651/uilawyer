<?php

namespace App\Http\Requests;

use App\Rules\MeaningfulText;
use App\Rules\PersonName;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCareerApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name'              => ['required', 'string', 'max:255', new PersonName],
            'phone'                  => ['required', 'string', 'max:30', new ValidPhoneNumber],
            'email'                  => 'required|email:rfc,filter|max:255',
            'city_state'             => ['required', 'string', 'max:255', new MeaningfulText(4, 1)],

            'college_university'     => ['nullable', 'string', 'max:255', new MeaningfulText(4, 1)],
            'course_year'            => ['nullable', 'string', 'max:255', new MeaningfulText(2, 1)],

            'internship_type'        => ['required', Rule::in(['Online Internship', 'Offline Internship', 'Specialized Internship', 'Career Opportunity'])],
            'practice_area_interest' => ['nullable', Rule::in(['Family Law', 'Criminal Law', 'Civil Law', 'Cyber Law', 'Legal Notice Drafting', 'Documentation'])],

            'preferred_start_date'   => 'nullable|date|after_or_equal:today',
            'preferred_duration'     => ['nullable', 'string', 'max:255', new MeaningfulText(3, 1)],

            'message'                => ['required', 'string', 'min:20', 'max:5000', new MeaningfulText(20, 5)],
            'consent'                => 'required|accepted',

            'resume'                 => 'required|file|mimes:pdf,doc,docx|min:10|max:5120',
            'id_proof'               => 'required|file|mimes:pdf,jpg,jpeg,png|min:10|max:5120',
        ];
    }
}
