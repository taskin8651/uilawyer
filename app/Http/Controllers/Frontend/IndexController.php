<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use App\Models\Article;
use App\Models\Attorney;
use App\Models\AwarenessVideo;
use App\Models\ImportantLink;
use App\Models\LegalQa;
use App\Models\PracticeArea;
use App\Models\Testimonial;
use App\Services\GooglePlacesReviews;

class IndexController extends Controller
{
    public function index(GooglePlacesReviews $googlePlacesReviews)
    {
        $aboutIntro = AboutIntro::latest()->first();

        $practiceAreaCategories = PracticeArea::with([
                'services' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('sort_order', 'asc')
                        ->latest();
                }
            ])
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        $homeAttorneys = Attorney::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(4)
            ->get();

        $homeArticles = Article::with('category')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(2)
            ->get();

        $homeTestimonials = Testimonial::where('status', 1)
            ->where('approval_status', 'approved')
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(6)
            ->get();

        $homeImportantLinks = ImportantLink::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(6)
            ->get();

        $homeAwarenessVideos = AwarenessVideo::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(3)
            ->get();

        $homeLegalQas = LegalQa::where('status', 'answered')
            ->whereNotNull('answer')
            ->latest()
            ->take(3)
            ->get();

        $googleReviews = $googlePlacesReviews->get();

        return view('frontend.index', compact(
            'aboutIntro',
            'practiceAreaCategories',
            'homeAttorneys',
            'homeArticles',
            'homeTestimonials',
            'homeImportantLinks',
            'homeAwarenessVideos',
            'homeLegalQas',
            'googleReviews'
        ));
    }
}
