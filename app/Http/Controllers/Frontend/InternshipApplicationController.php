<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;

class InternshipApplicationController extends Controller
{
    public function index()
    {
        return view('frontend.internship-application');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'city_state' => 'nullable|string|max:255',
            'college_university' => 'nullable|string|max:255',
            'course_year' => 'nullable|string|max:255',
            'internship_type' => 'nullable|string|max:255',
            'practice_area_interest' => 'nullable|string|max:255',
            'preferred_start_date' => 'nullable|date',
            'preferred_duration' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'consent' => 'accepted',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'aadhar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'photograph' => 'nullable|image|max:5120',
            'payment_screenshot' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $data['consent'] = true;
        unset($data['resume'], $data['aadhar_card'], $data['photograph'], $data['payment_screenshot']);

        $internship = InternshipApplication::create($data);

        foreach (['resume', 'aadhar_card', 'photograph', 'payment_screenshot'] as $collection) {
            if ($request->hasFile($collection)) {
                $internship->addMediaFromRequest($collection)->toMediaCollection($collection);
            }
        }

        return back()
            ->with('message_title', 'Internship Application')
            ->with('message', 'Internship application submitted successfully.');
    }
}
