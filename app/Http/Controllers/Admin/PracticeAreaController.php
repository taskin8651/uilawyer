<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePracticeAreaRequest;
use App\Http\Requests\UpdatePracticeAreaRequest;
use App\Models\PracticeArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PracticeAreaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('practice_area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceAreas = PracticeArea::orderBy('sort_order')->latest()->get();

        return view('admin.practiceAreas.index', compact('practiceAreas'));
    }

    public function create()
    {
        abort_if(Gate::denies('practice_area_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.practiceAreas.create');
    }

    public function store(StorePracticeAreaRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;
        unset(
            $data['practice_area_image'],
            $data['faq_questions'],
            $data['faq_answers'],
            $data['faq_statuses'],
            $data['faq_sort_orders']
        );

        $practiceArea = PracticeArea::create($data);
        $this->syncFaqs($practiceArea, $request);

        if ($request->hasFile('practice_area_image')) {
            $practiceArea
                ->addMediaFromRequest('practice_area_image')
                ->toMediaCollection('practice_area_image');
        }

        return redirect()->route('admin.practice-areas.index')
            ->with('message', 'Practice area created successfully.');
    }

    public function show(PracticeArea $practiceArea)
    {
        abort_if(Gate::denies('practice_area_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceArea->load(['faqs' => fn ($query) => $query->orderBy('sort_order')]);

        return view('admin.practiceAreas.show', compact('practiceArea'));
    }

    public function edit(PracticeArea $practiceArea)
    {
        abort_if(Gate::denies('practice_area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceArea->load(['faqs' => fn ($query) => $query->orderBy('sort_order')]);

        return view('admin.practiceAreas.edit', compact('practiceArea'));
    }

    public function update(UpdatePracticeAreaRequest $request, PracticeArea $practiceArea)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $practiceArea->id);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;
        unset(
            $data['practice_area_image'],
            $data['faq_questions'],
            $data['faq_answers'],
            $data['faq_statuses'],
            $data['faq_sort_orders']
        );

        $practiceArea->update($data);
        $this->syncFaqs($practiceArea, $request);

        if ($request->hasFile('practice_area_image')) {
            $practiceArea
                ->addMediaFromRequest('practice_area_image')
                ->toMediaCollection('practice_area_image');
        }

        return redirect()->route('admin.practice-areas.index')
            ->with('message', 'Practice area updated successfully.');
    }

    public function destroy(PracticeArea $practiceArea)
    {
        abort_if(Gate::denies('practice_area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceArea->delete();

        return back()->with('message', 'Practice area deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('practice_area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PracticeArea::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value) ?: 'practice-area';
        $slug = $baseSlug;
        $counter = 2;

        while (PracticeArea::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function syncFaqs(PracticeArea $practiceArea, Request $request): void
    {
        $faqItems = $this->prepareFaqItems($request);

        $practiceArea->faqs()->delete();

        foreach ($faqItems as $faqItem) {
            $practiceArea->faqs()->create($faqItem);
        }
    }

    private function prepareFaqItems(Request $request): array
    {
        $faqItems = [];

        foreach (($request->faq_questions ?? []) as $key => $question) {
            $answer = $request->faq_answers[$key] ?? null;
            $question = trim((string) $question);
            $answer = trim((string) $answer);

            if ($question !== '' || $answer !== '') {
                $faqItems[] = [
                    'question' => $question,
                    'answer' => $answer,
                    'status' => isset($request->faq_statuses[$key]) ? 1 : 0,
                    'sort_order' => (int) ($request->faq_sort_orders[$key] ?? $key),
                ];
            }
        }

        return $faqItems;
    }
}
