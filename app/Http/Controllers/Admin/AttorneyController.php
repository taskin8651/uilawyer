<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttorneyRequest;
use App\Http\Requests\UpdateAttorneyRequest;
use App\Models\Attorney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AttorneyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attorney_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attorneys = Attorney::orderBy('sort_order')->latest()->get();

        return view('admin.attorneys.index', compact('attorneys'));
    }

    public function create()
    {
        abort_if(Gate::denies('attorney_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attorneys.create');
    }

    public function store(StoreAttorneyRequest $request)
    {
        $data = $request->validated();

        $data['meta_items'] = $this->prepareMetaItems($request);
        $data['tags'] = array_values(array_filter($request->tags ?? []));
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        unset($data['meta_icons'], $data['meta_texts'], $data['attorney_image']);

        $attorney = Attorney::create($data);

        if ($request->hasFile('attorney_image')) {
            $attorney
                ->addMediaFromRequest('attorney_image')
                ->toMediaCollection('attorney_image');
        }

        return redirect()
            ->route('admin.attorneys.index')
            ->with('message', 'Attorney created successfully.');
    }

    public function show(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attorneys.show', compact('attorney'));
    }

    public function edit(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attorneys.edit', compact('attorney'));
    }

    public function update(UpdateAttorneyRequest $request, Attorney $attorney)
    {
        $data = $request->validated();

        $data['meta_items'] = $this->prepareMetaItems($request);
        $data['tags'] = array_values(array_filter($request->tags ?? []));
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        unset($data['meta_icons'], $data['meta_texts'], $data['attorney_image']);

        $attorney->update($data);

        if ($request->hasFile('attorney_image')) {
            $attorney
                ->addMediaFromRequest('attorney_image')
                ->toMediaCollection('attorney_image');
        }

        return redirect()
            ->route('admin.attorneys.index')
            ->with('message', 'Attorney updated successfully.');
    }

    public function destroy(Attorney $attorney)
    {
        abort_if(Gate::denies('attorney_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attorney->delete();

        return back()->with('message', 'Attorney deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('attorney_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Attorney::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function prepareMetaItems(Request $request): array
    {
        $metaItems = [];

        foreach (($request->meta_texts ?? []) as $key => $text) {
            if ($text) {
                $metaItems[] = [
                    'icon' => $request->meta_icons[$key] ?? 'bi bi-check-circle-fill',
                    'text' => $text,
                ];
            }
        }

        return $metaItems;
    }
}