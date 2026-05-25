<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PracticeArea;
use App\Models\VerdictJudgment;
use Illuminate\Http\Request;

class VerdictJudgmentPageController extends Controller
{
    private const FALLBACK_IMAGE = 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=1000&q=80';

    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $verdictJudgments = VerdictJudgment::where('status', 1)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('court_name', 'like', "%{$search}%")
                        ->orWhere('case_number', 'like', "%{$search}%")
                        ->orWhere('citation', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->latest('judgment_date')
            ->latest()
            ->get();

        $featuredVerdicts = VerdictJudgment::where('status', 1)
            ->where('is_featured', 1)
            ->latest('judgment_date')
            ->take(3)
            ->get();

        $relatedPractices = PracticeArea::where('status', 1)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('frontend.verdicts', compact('verdictJudgments', 'featuredVerdicts', 'relatedPractices', 'search'));
    }

    public function show(VerdictJudgment $verdictJudgment)
    {
        abort_unless($verdictJudgment->status, 404);

        $latestVerdicts = VerdictJudgment::where('status', 1)
            ->where('id', '!=', $verdictJudgment->id)
            ->latest('judgment_date')
            ->take(3)
            ->get();

        return view('frontend.verdict-details', [
            'verdictJudgment' => $verdictJudgment,
            'latestVerdicts' => $latestVerdicts,
            'fallbackImage' => self::FALLBACK_IMAGE,
        ]);
    }
}
