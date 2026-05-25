<?php

namespace App\Http\Requests;

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
            'name' => 'required|string|max:255',
            'place_of_practice' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'about_team' => 'nullable|string|max:3000',
        ];
    }
}
