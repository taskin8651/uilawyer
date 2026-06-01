<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportantLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ImportantLinkController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('important_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $importantLinks = ImportantLink::orderBy('sort_order')->latest()->get();

        return view('admin.importantLinks.index', compact('importantLinks'));
    }

    public function create()
    {
        abort_if(Gate::denies('important_link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantLinks.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('important_link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ImportantLink::create($this->validateLink($request));

        return redirect()->route('admin.important-links.index')->with('message', 'Important link created successfully.');
    }

    public function show(ImportantLink $importantLink)
    {
        abort_if(Gate::denies('important_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantLinks.show', compact('importantLink'));
    }

    public function edit(ImportantLink $importantLink)
    {
        abort_if(Gate::denies('important_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantLinks.edit', compact('importantLink'));
    }

    public function update(Request $request, ImportantLink $importantLink)
    {
        abort_if(Gate::denies('important_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $importantLink->update($this->validateLink($request));

        return redirect()->route('admin.important-links.index')->with('message', 'Important link updated successfully.');
    }

    public function destroy(ImportantLink $importantLink)
    {
        abort_if(Gate::denies('important_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $importantLink->delete();

        return back()->with('message', 'Important link deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('important_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ImportantLink::whereIn('id', (array) $request->input('ids', []))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateLink(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
