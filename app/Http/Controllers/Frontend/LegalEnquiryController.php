<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLegalEnquiryRequest;
use App\Models\LegalEnquiry;
use App\Models\PracticeArea;

class LegalEnquiryController extends Controller
{
      public function index()
    {
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

        return view('frontend.book-consultation', compact(
            'practiceAreaCategories'
        ));
    }

    public function store(StoreLegalEnquiryRequest $request)
    {
        $data = $request->validated();

        $data['consent'] = $request->has('consent') ? 1 : 0;
        $data['status'] = 'new';

        unset($data['case_document']);

        $legalEnquiry = LegalEnquiry::create($data);

        if ($request->hasFile('case_document')) {
            $legalEnquiry
                ->addMediaFromRequest('case_document')
                ->toMediaCollection('case_document');
        }

        return back()->with('message', 'Thank you. Your legal enquiry has been submitted successfully.');
    }
}