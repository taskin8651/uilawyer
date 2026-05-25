<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCareerApplicationRequest;
use App\Models\CareerApplication;

class CareerApplicationController extends Controller
{
    public function index()
    {
        $careerApplications = CareerApplication::latest()->get();

        return view('frontend.career', compact('careerApplications'));
    }
    public function store(StoreCareerApplicationRequest $request)
    {
        $data = $request->validated();

        $data['consent'] = $request->has('consent') ? 1 : 0;
        $data['status'] = 'new';

        unset($data['resume'], $data['id_proof']);

        $careerApplication = CareerApplication::create($data);

        if ($request->hasFile('resume')) {
            $careerApplication
                ->addMediaFromRequest('resume')
                ->toMediaCollection('resume');
        }

        if ($request->hasFile('id_proof')) {
            $careerApplication
                ->addMediaFromRequest('id_proof')
                ->toMediaCollection('id_proof');
        }

        return back()
            ->with('message_title', 'Career Application')
            ->with('message', 'Thank you. Your career application has been submitted successfully.');
    }
}
