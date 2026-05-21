<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    public function index()
    {
        $visionMission = VisionMission::firstOrCreate(
            ['id' => 1],
            [
                'kicker_icon' => 'bi bi-compass-fill',
                'kicker_text' => 'Vision & Mission',
                'title' => 'A Legal Firm Focused On Trust, Accessibility & Strong Representation.',
                'description' => 'Our vision and mission are designed around client confidence, ethical legal practice, proper communication and accessible legal services.',
                'vision_icon' => 'bi bi-eye-fill',
                'vision_title' => 'Our Vision',
                'vision_text' => 'To become a trusted and accessible legal services firm known for professional consultation, responsible guidance and reliable legal support across practice areas.',
                'mission_icon' => 'bi bi-bullseye',
                'mission_title' => 'Our Mission',
                'mission_text' => 'To help clients understand legal problems clearly, choose the right legal path, prepare documents properly and proceed with confidence.',
                'values_icon' => 'bi bi-gem',
                'values_title' => 'Our Values',
                'values_text' => 'Confidentiality, integrity, clarity, discipline, client respect and practical legal problem-solving remain at the centre of our service philosophy.',
            ]
        );

        return view('admin.visionMission.index', compact('visionMission'));
    }

    public function update(Request $request)
    {
        $visionMission = VisionMission::firstOrCreate(['id' => 1]);

        $data = $request->validate([
            'kicker_icon' => 'nullable|string|max:255',
            'kicker_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:500',
            'description' => 'nullable|string',

            'vision_icon' => 'nullable|string|max:255',
            'vision_title' => 'nullable|string|max:255',
            'vision_text' => 'nullable|string',

            'mission_icon' => 'nullable|string|max:255',
            'mission_title' => 'nullable|string|max:255',
            'mission_text' => 'nullable|string',

            'values_icon' => 'nullable|string|max:255',
            'values_title' => 'nullable|string|max:255',
            'values_text' => 'nullable|string',
        ]);

        $visionMission->update($data);

        return back()->with('message', 'Vision mission section updated successfully.');
    }
}