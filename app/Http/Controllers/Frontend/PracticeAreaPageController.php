<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PracticeArea;

class PracticeAreaPageController extends Controller
{
    public function index()
    {
        return view('frontend.practice-area');
    }

    public function show(PracticeArea $practiceArea)
    {
        abort_unless($practiceArea->status, 404);

        $latestPracticeAreas = PracticeArea::where('status', 1)
            ->where('id', '!=', $practiceArea->id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('frontend.practice-area-details', compact('practiceArea', 'latestPracticeAreas'));
    }
}
