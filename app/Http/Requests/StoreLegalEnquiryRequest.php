<?php

namespace App\Http\Requests;

use App\Rules\MeaningfulText;
use App\Rules\PersonName;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLegalEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'form_type' => ['nullable', Rule::in(['contact', 'consultation', 'attorney_profile'])],

            'full_name' => ['required', 'string', 'max:255', new PersonName],
            'mobile' => ['required', 'string', 'max:30', new ValidPhoneNumber],
            'email' => 'nullable|email:rfc,filter|max:255',
            'case_category' => ['required', 'string', 'max:255', new MeaningfulText(3, 1)],
            'city_state' => ['nullable', 'string', 'max:255', new MeaningfulText(4, 1)],

            'preferred_contact_mode' => ['nullable', Rule::in(['Phone Call', 'WhatsApp', 'Email', 'Office Visit'])],
            'preferred_date' => 'nullable|date|after_or_equal:today',
            'preferred_time' => 'nullable',

            'case_message' => ['required', 'string', 'min:20', 'max:5000', new MeaningfulText(20, 5)],
            'consent' => 'required|accepted',

            'case_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|min:10|max:5120',
        ];
    }
}
