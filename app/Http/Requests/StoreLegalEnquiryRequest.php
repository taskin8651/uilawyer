<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLegalEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'form_type' => 'nullable|string|max:100',

            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'case_category' => 'required|string|max:255',
            'city_state' => 'nullable|string|max:255',

            'preferred_contact_mode' => 'nullable|string|max:255',
            'preferred_date' => 'nullable|date',
            'preferred_time' => 'nullable',

            'case_message' => 'required|string',
            'consent' => 'nullable|accepted',

            'case_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }
}