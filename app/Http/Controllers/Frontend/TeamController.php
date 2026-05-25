<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJoinTeamRequest;
use App\Models\Attorney;
use App\Models\PracticeArea;

class TeamController extends Controller
{
    public function index()
    {
        $attorneys = Attorney::where('status', 1)
            ->orderBy('sort_order','asc')
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

    public function join()
    {
        return view('frontend.join-team');
    }

    public function storeJoin(StoreJoinTeamRequest $request)
    {
        $data = $request->validated();

        $attorney = Attorney::create([
            'name' => $data['name'],
            'designation' => $data['position'],
            'place_of_practice' => $data['place_of_practice'],
            'experience' => $data['experience'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'about_team' => $data['about_team'] ?? null,
            'badge' => 'Team Application',
            'meta_items' => [
                [
                    'icon' => 'bi bi-geo-alt-fill',
                    'text' => $data['place_of_practice'],
                ],
                [
                    'icon' => 'bi bi-calendar-check-fill',
                    'text' => $data['experience'],
                ],
            ],
            'tags' => [],
            'sort_order' => 0,
            'status' => 0,
        ]);

        if ($request->hasFile('photo')) {
            $attorney
                ->addMediaFromRequest('photo')
                ->toMediaCollection('attorney_image');
        }

        return back()
            ->with('message_title', 'Join Our Team')
            ->with('message', 'Thank you. Your team application has been submitted successfully. It will show on the team page after admin approval.');
    }
}
