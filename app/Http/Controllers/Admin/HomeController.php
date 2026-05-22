<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Attorney;
use App\Models\CareerApplication;
use App\Models\LegalEnquiry;
use App\Models\PracticeArea;
use App\Models\PracticeAreaService;
use App\Models\Testimonial;

class HomeController
{
    public function index()
    {
        $mainEnquiries = LegalEnquiry::where(function ($query) {
                $query->where('form_type', 'contact')->orWhereNull('form_type');
            });

        $bookConsultations = LegalEnquiry::where('form_type', 'consultation');

        $stats = [
            'main_enquiries' => (clone $mainEnquiries)->count(),
            'new_main_enquiries' => (clone $mainEnquiries)->where('status', 'new')->count(),
            'book_consultations' => (clone $bookConsultations)->count(),
            'new_book_consultations' => (clone $bookConsultations)->where('status', 'new')->count(),
            'career_applications' => CareerApplication::count(),
            'new_career_applications' => CareerApplication::where('status', 'new')->count(),
            'articles' => Article::count(),
            'active_articles' => Article::where('status', 1)->count(),
            'practice_areas' => PracticeArea::where('status', 1)->count(),
            'practice_services' => PracticeAreaService::where('status', 1)->count(),
            'attorneys' => Attorney::where('status', 1)->count(),
            'testimonials' => Testimonial::where('status', 1)->count(),
        ];

        $recentEnquiries = LegalEnquiry::latest()->take(6)->get();
        $recentCareerApplications = CareerApplication::latest()->take(5)->get();
        $recentArticles = Article::with('category')->latest()->take(5)->get();

        return view('home', compact('stats', 'recentEnquiries', 'recentCareerApplications', 'recentArticles'));
    }
}
