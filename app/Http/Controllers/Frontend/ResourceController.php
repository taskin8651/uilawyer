<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AwarenessVideo;
use App\Models\ImportantLink;
use App\Models\LegalQa;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function importantLinks()
    {
        $importantLinks = ImportantLink::where('status', 1)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('frontend.important-links', compact('importantLinks'));
    }

    public function awarenessVideos()
    {
        $awarenessVideos = AwarenessVideo::where('status', 1)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('frontend.awareness-videos', compact('awarenessVideos'));
    }

    public function legalQa()
    {
        $legalQas = LegalQa::where('status', 'answered')
            ->whereNotNull('answer')
            ->latest()
            ->take(12)
            ->get();

        return view('frontend.legal-qa', compact('legalQas'));
    }

    public function storeLegalQa(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:5000',
            'consent' => 'accepted',
        ]);

        LegalQa::create([
            'user_id' => auth()->id(),
            'question' => $data['question'],
            'answer' => 'Thank you for your question. Our legal team will review it and may publish a general answer shortly.',
            'status' => 'answered',
        ]);

        return back()
            ->with('message_title', 'Legal Q&A')
            ->with('message', 'Your question has been submitted successfully.');
    }
}
