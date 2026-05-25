<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVerdictJudgmentRequest;
use App\Http\Requests\UpdateVerdictJudgmentRequest;
use App\Models\VerdictJudgment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class VerdictJudgmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('verdict_judgment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verdictJudgments = VerdictJudgment::orderBy('sort_order')
            ->latest('judgment_date')
            ->latest()
            ->get();

        return view('admin.verdictJudgments.index', compact('verdictJudgments'));
    }

    public function create()
    {
        abort_if(Gate::denies('verdict_judgment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.verdictJudgments.create');
    }

    public function store(StoreVerdictJudgmentRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        unset($data['verdict_image'], $data['verdict_document']);

        $verdictJudgment = VerdictJudgment::create($data);

        if ($request->hasFile('verdict_image')) {
            $verdictJudgment
                ->addMediaFromRequest('verdict_image')
                ->toMediaCollection('verdict_image');
        }

        if ($request->hasFile('verdict_document')) {
            $verdictJudgment
                ->addMediaFromRequest('verdict_document')
                ->toMediaCollection('verdict_document');
        }

        return redirect()->route('admin.verdict-judgments.index')
            ->with('message', 'Verdict & judgment created successfully.');
    }

    public function show(VerdictJudgment $verdictJudgment)
    {
        abort_if(Gate::denies('verdict_judgment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.verdictJudgments.show', compact('verdictJudgment'));
    }

    public function edit(VerdictJudgment $verdictJudgment)
    {
        abort_if(Gate::denies('verdict_judgment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.verdictJudgments.edit', compact('verdictJudgment'));
    }

    public function update(UpdateVerdictJudgmentRequest $request, VerdictJudgment $verdictJudgment)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $verdictJudgment->id);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        unset($data['verdict_image'], $data['verdict_document']);

        $verdictJudgment->update($data);

        if ($request->hasFile('verdict_image')) {
            $verdictJudgment
                ->addMediaFromRequest('verdict_image')
                ->toMediaCollection('verdict_image');
        }

        if ($request->hasFile('verdict_document')) {
            $verdictJudgment
                ->addMediaFromRequest('verdict_document')
                ->toMediaCollection('verdict_document');
        }

        return redirect()->route('admin.verdict-judgments.index')
            ->with('message', 'Verdict & judgment updated successfully.');
    }

    public function destroy(VerdictJudgment $verdictJudgment)
    {
        abort_if(Gate::denies('verdict_judgment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verdictJudgment->delete();

        return back()->with('message', 'Verdict & judgment deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('verdict_judgment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        VerdictJudgment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value) ?: 'verdict-judgment';
        $slug = $baseSlug;
        $counter = 2;

        while (VerdictJudgment::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
