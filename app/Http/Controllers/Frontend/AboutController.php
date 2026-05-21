<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use App\Models\FounderMessage;
use App\Models\VisionMission;

class AboutController extends Controller
{
    public function index()
    {
        $aboutIntro = AboutIntro::first();
        $founderMessage = FounderMessage::first();
        $visionMission = VisionMission::first();

        return view('frontend.about', compact(
            'aboutIntro',
            'founderMessage',
            'visionMission'
        ));
    }
}