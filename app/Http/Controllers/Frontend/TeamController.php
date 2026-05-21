<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attorney;

class TeamController extends Controller
{
    public function index()
    {
        $attorneys = Attorney::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.our-team', compact('attorneys'));
    }

    public function show(Attorney $attorney)
    {
        abort_if(! $attorney->status, 404);

        $relatedAttorneys = Attorney::where('status', 1)
            ->where('id', '!=', $attorney->id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('frontend.profile', compact('attorney', 'relatedAttorneys'));
    }
}
