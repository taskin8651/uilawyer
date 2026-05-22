<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use App\Models\FounderMessage;
use App\Models\VisionMission;
use App\Models\PracticeArea;

class AboutController extends Controller
{
    public function index()
    {
        $aboutIntro = AboutIntro::first();
        $founderMessage = FounderMessage::first();
        $visionMission = VisionMission::first();

   $homeExpertisePractices = PracticeArea::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(4)
            ->get();
        return view('frontend.about', compact(
            'aboutIntro',
            'founderMessage',
            'visionMission',
            'homeExpertisePractices'
        ));
    }
}