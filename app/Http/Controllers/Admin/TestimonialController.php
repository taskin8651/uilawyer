<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TestimonialController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonials = Testimonial::orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        abort_if(Gate::denies('testimonial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('testimonial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->validate([
            'client_name'        => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'rating'             => 'required|integer|min:1|max:5',
            'review'             => 'required|string',
            'sort_order'         => 'nullable|integer',
            'status'             => 'nullable|boolean',
            'approval_status'    => 'required|in:new,approved,rejected',
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('message', 'Testimonial created successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->validate([
            'client_name'        => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'rating'             => 'required|integer|min:1|max:5',
            'review'             => 'required|string',
            'sort_order'         => 'nullable|integer',
            'status'             => 'nullable|boolean',
            'approval_status'    => 'required|in:new,approved,rejected',
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('message', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonial->delete();

        return back()->with('message', 'Testimonial deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('testimonial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Testimonial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
