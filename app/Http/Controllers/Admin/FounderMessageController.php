<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FounderMessage;
use Illuminate\Http\Request;

class FounderMessageController extends Controller
{
    public function index()
    {
        $founderMessage = FounderMessage::firstOrCreate(
            ['id' => 1],
            [
                'kicker_icon' => 'bi bi-person-badge-fill',
                'kicker_text' => 'Founder Message',
                'title' => 'Legal Guidance Should Be Clear, Ethical & Useful For Every Client.',
                'description' => 'Our approach is to simplify complex legal situations and give clients a clear understanding of their matter, available remedies and practical legal steps. Every case requires patience, confidentiality, legal knowledge and careful strategy.',
                'quote_icon' => 'bi bi-quote',
                'quote_text' => 'A client should never feel lost in the legal process. Our responsibility is to guide them with clarity, confidence and professional care.',
                'founder_name' => 'Pramod Rajpati',
                'founder_designation' => 'Founder, Rajpati & Associates',
                'card_name' => 'Pramod Rajpati',
                'card_designation' => 'Founder & Legal Professional',
                'meta_items' => [
                    [
                        'icon' => 'bi bi-geo-alt-fill',
                        'text' => 'Patna, Bihar',
                    ],
                    [
                        'icon' => 'bi bi-bank2',
                        'text' => 'Litigation & Consultation',
                    ],
                    [
                        'icon' => 'bi bi-award-fill',
                        'text' => 'Since 1999',
                    ],
                ],
            ]
        );

        return view('admin.founderMessage.index', compact('founderMessage'));
    }

    public function update(Request $request)
    {
        $founderMessage = FounderMessage::firstOrCreate(['id' => 1]);

        $data = $request->validate([
            'kicker_icon' => 'nullable|string|max:255',
            'kicker_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'quote_icon' => 'nullable|string|max:255',
            'quote_text' => 'nullable|string',
            'founder_name' => 'nullable|string|max:255',
            'founder_designation' => 'nullable|string|max:255',
            'card_name' => 'nullable|string|max:255',
            'card_designation' => 'nullable|string|max:255',
            'meta_icons' => 'nullable|array',
            'meta_icons.*' => 'nullable|string|max:255',
            'meta_texts' => 'nullable|array',
            'meta_texts.*' => 'nullable|string|max:255',
            'founder_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $metaItems = [];

        foreach (($request->meta_texts ?? []) as $key => $text) {
            if ($text) {
                $metaItems[] = [
                    'icon' => $request->meta_icons[$key] ?? 'bi bi-check-circle-fill',
                    'text' => $text,
                ];
            }
        }

        $data['meta_items'] = $metaItems;

        unset($data['meta_icons'], $data['meta_texts']);

        $founderMessage->update($data);

        if ($request->hasFile('founder_image')) {
            $founderMessage
                ->addMediaFromRequest('founder_image')
                ->toMediaCollection('founder_image');
        }

        return back()->with('message', 'Founder message section updated successfully.');
    }
}
