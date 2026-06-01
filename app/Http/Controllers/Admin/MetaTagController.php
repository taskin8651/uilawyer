<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class MetaTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('meta_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $metaTags = MetaTag::latest()->get();

        return view('admin.metaTags.index', compact('metaTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('meta_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.metaTags.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('meta_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        MetaTag::create($this->validateMeta($request));

        return redirect()->route('admin.meta-tags.index')->with('message', 'Meta tag created successfully.');
    }

    public function show(MetaTag $metaTag)
    {
        abort_if(Gate::denies('meta_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.metaTags.show', compact('metaTag'));
    }

    public function edit(MetaTag $metaTag)
    {
        abort_if(Gate::denies('meta_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.metaTags.edit', compact('metaTag'));
    }

    public function update(Request $request, MetaTag $metaTag)
    {
        abort_if(Gate::denies('meta_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $metaTag->update($this->validateMeta($request, $metaTag->id));

        return redirect()->route('admin.meta-tags.index')->with('message', 'Meta tag updated successfully.');
    }

    public function destroy(MetaTag $metaTag)
    {
        abort_if(Gate::denies('meta_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $metaTag->delete();

        return back()->with('message', 'Meta tag deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('meta_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        MetaTag::whereIn('id', (array) $request->input('ids', []))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateMeta(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'page_name' => 'required|string|max:255',
            'page_key' => ['required', 'string', 'max:255', Rule::unique('meta_tags')->ignore($ignoreId)],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data['status'] = $request->has('status');

        return $data;
    }
}
