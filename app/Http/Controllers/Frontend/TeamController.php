<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attorney;
use App\Models\PracticeArea;

class TeamController extends Controller
{
    public function index()
    {
        $attorneys = Attorney::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $teamPractices = PracticeArea::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.our-team', compact(
            'attorneys',
            'teamPractices'
        ));
    }

    public function show(Attorney $attorney)
    {
        abort_if(! $attorney->status, 404);

        $relatedAttorneys = Attorney::where('status', 1)
            ->where('id', '!=', $attorney->id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

            $teamPractices = PracticeArea::where('status', 1)
    ->orderBy('sort_order', 'asc')
    ->latest()
    ->take(4)
    ->get();

      $practiceAreaCategories = PracticeArea::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        return view('frontend.profile', compact('attorney', 'relatedAttorneys', 'teamPractices', 'practiceAreaCategories'));
    }
}
