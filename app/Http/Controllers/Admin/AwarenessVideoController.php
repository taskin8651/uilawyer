<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwarenessVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AwarenessVideoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('awareness_video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $awarenessVideos = AwarenessVideo::orderBy('sort_order')->latest()->get();

        return view('admin.awarenessVideos.index', compact('awarenessVideos'));
    }

    public function create()
    {
        abort_if(Gate::denies('awareness_video_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.awarenessVideos.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('awareness_video_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        AwarenessVideo::create($this->validateVideo($request));

        return redirect()->route('admin.awareness-videos.index')->with('message', 'Awareness video created successfully.');
    }

    public function show(AwarenessVideo $awarenessVideo)
    {
        abort_if(Gate::denies('awareness_video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.awarenessVideos.show', compact('awarenessVideo'));
    }

    public function edit(AwarenessVideo $awarenessVideo)
    {
        abort_if(Gate::denies('awareness_video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.awarenessVideos.edit', compact('awarenessVideo'));
    }

    public function update(Request $request, AwarenessVideo $awarenessVideo)
    {
        abort_if(Gate::denies('awareness_video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $awarenessVideo->update($this->validateVideo($request));

        return redirect()->route('admin.awareness-videos.index')->with('message', 'Awareness video updated successfully.');
    }

    public function destroy(AwarenessVideo $awarenessVideo)
    {
        abort_if(Gate::denies('awareness_video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $awarenessVideo->delete();

        return back()->with('message', 'Awareness video deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('awareness_video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        AwarenessVideo::whereIn('id', (array) $request->input('ids', []))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateVideo(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url|max:255',
            'thumbnail_image' => 'nullable|url|max:255',
            'short_description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
