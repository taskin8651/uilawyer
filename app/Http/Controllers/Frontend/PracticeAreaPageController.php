<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PracticeArea;
use App\Models\PracticeAreaService;
use Illuminate\Http\Request;

class PracticeAreaPageController extends Controller
{
    public function index(Request $request)
    {
        $activeCategory = $request->get('category');

        $practiceAreas = PracticeArea::with(['services' => function ($query) {
                $query->where('status', 1)->orderBy('sort_order');
            }])
            ->where('status', 1)
            ->when($activeCategory, function ($query) use ($activeCategory) {
                $query->where('slug', $activeCategory);
            })
            ->orderBy('sort_order')
            ->get();

        $practiceAreaFilters = PracticeArea::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.practice-area', compact('practiceAreas', 'practiceAreaFilters', 'activeCategory'));
    }

    public function show(PracticeArea $practiceArea)
    {
        abort_unless($practiceArea->status, 404);

        $practiceArea->load('activeFaqs');

        $latestPracticeAreas = PracticeArea::where('status', 1)
            ->where('id', '!=', $practiceArea->id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('frontend.practice-area-details', compact('practiceArea', 'latestPracticeAreas'));
    }

    public function showService(PracticeAreaService $practiceAreaService)
    {
        abort_unless($practiceAreaService->status, 404);

        $practiceAreaService->load('practiceArea');

        abort_unless(optional($practiceAreaService->practiceArea)->status, 404);

        $relatedServices = PracticeAreaService::where('status', 1)
            ->where('id', '!=', $practiceAreaService->id)
            ->where('practice_area_id', $practiceAreaService->practice_area_id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('frontend.practice-service-details', compact('practiceAreaService', 'relatedServices'));
    }
}
