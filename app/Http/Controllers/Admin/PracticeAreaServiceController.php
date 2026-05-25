<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePracticeAreaServiceRequest;
use App\Http\Requests\UpdatePracticeAreaServiceRequest;
use App\Models\PracticeArea;
use App\Models\PracticeAreaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PracticeAreaServiceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('practice_area_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceAreaServices = PracticeAreaService::with('practiceArea')
            ->orderBy('practice_area_id')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('admin.practiceAreaServices.index', compact('practiceAreaServices'));
    }

    public function create()
    {
        abort_if(Gate::denies('practice_area_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceAreas = PracticeArea::where('status', 1)
            ->orderBy('sort_order')
            ->pluck('title', 'id');

        return view('admin.practiceAreaServices.create', compact('practiceAreas'));
    }

    public function store(StorePracticeAreaServiceRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;
        PracticeAreaService::create($data);

        return redirect()->route('admin.practice-area-services.index')
            ->with('message', 'Practice area service created successfully.');
    }

    public function show(PracticeAreaService $practiceAreaService)
    {
        abort_if(Gate::denies('practice_area_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceAreaService->load('practiceArea');

        return view('admin.practiceAreaServices.show', compact('practiceAreaService'));
    }

    public function edit(PracticeAreaService $practiceAreaService)
    {
        abort_if(Gate::denies('practice_area_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceAreas = PracticeArea::where('status', 1)
            ->orderBy('sort_order')
            ->pluck('title', 'id');

        return view('admin.practiceAreaServices.edit', compact('practiceAreaService', 'practiceAreas'));
    }

    public function update(UpdatePracticeAreaServiceRequest $request, PracticeAreaService $practiceAreaService)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $practiceAreaService->id);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;
        $practiceAreaService->update($data);

        return redirect()->route('admin.practice-area-services.index')
            ->with('message', 'Practice area service updated successfully.');
    }

    public function destroy(PracticeAreaService $practiceAreaService)
    {
        abort_if(Gate::denies('practice_area_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practiceAreaService->delete();

        return back()->with('message', 'Practice area service deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('practice_area_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PracticeAreaService::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value) ?: 'practice-service';
        $slug = $baseSlug;
        $counter = 2;

        while (PracticeAreaService::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
