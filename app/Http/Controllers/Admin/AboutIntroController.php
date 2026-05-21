<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use Illuminate\Http\Request;

class AboutIntroController extends Controller
{
    public function index()
    {
        $aboutIntro = AboutIntro::firstOrCreate(
            ['id' => 1],
            [
                'kicker_icon' => 'bi bi-building-check',
                'kicker_text' => 'Firm Introduction',
                'title' => 'Professional Legal Support Built On Trust, Clarity & Practical Strategy.',
                'description_one' => 'Rajpati & Associates is a modern legal services firm based in Patna, Bihar, focused on helping clients understand their rights, legal options, documentation requirements and the right process for their legal matters.',
                'description_two' => 'The firm provides guidance across family law, divorce matters, criminal law, civil disputes, Muslim law, service matters, property disputes, legal notices, cyber law and court-related support.',
                'experience_number' => '25+',
                'experience_text' => 'Years of Legal Experience',
                'note_icon' => 'bi bi-shield-check',
                'note_small_text' => 'Trusted Since 1999',
                'note_title' => 'All India Legal Services',
                'points' => [
                    'Confidential legal consultation',
                    'Court and litigation support',
                    'Strong client-focused communication',
                    'All India Legal Services positioning',
                ],
            ]
        );

        return view('admin.aboutIntro.index', compact('aboutIntro'));
    }

    public function update(Request $request)
    {
        $aboutIntro = AboutIntro::firstOrCreate(['id' => 1]);

        $data = $request->validate([
            'kicker_icon' => 'nullable|string|max:255',
            'kicker_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:500',
            'description_one' => 'nullable|string',
            'description_two' => 'nullable|string',
            'experience_number' => 'nullable|string|max:255',
            'experience_text' => 'nullable|string|max:255',
            'note_icon' => 'nullable|string|max:255',
            'note_small_text' => 'nullable|string|max:255',
            'note_title' => 'nullable|string|max:255',
            'points' => 'nullable|array',
            'points.*' => 'nullable|string|max:255',
            'about_intro_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['points'] = array_values(array_filter($request->points ?? []));

        $aboutIntro->update($data);

        if ($request->hasFile('about_intro_image')) {
            $aboutIntro
                ->addMediaFromRequest('about_intro_image')
                ->toMediaCollection('about_intro_image');
        }

        return back()->with('message', 'About intro section updated successfully.');
    }
}