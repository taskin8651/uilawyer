<?php

namespace App\Http\Requests;

use App\Rules\MeaningfulText;
use App\Rules\PersonName;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreJoinTeamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', new PersonName],
            'place_of_practice' => ['required', 'string', 'max:255', new MeaningfulText(4, 1)],
            'position' => ['required', 'string', 'max:255', new MeaningfulText(3, 1)],
            'experience' => ['required', 'string', 'max:255', new MeaningfulText(2, 1)],
            'address' => ['required', 'string', 'max:1000', new MeaningfulText(10, 3)],
            'phone' => ['required', 'string', 'max:30', new ValidPhoneNumber],
            'email' => 'nullable|email:rfc,filter|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|min:10|max:4096|dimensions:min_width=120,min_height=120',
            'about_team' => ['nullable', 'string', 'max:3000', new MeaningfulText(20, 5)],
        ];
    }
}
