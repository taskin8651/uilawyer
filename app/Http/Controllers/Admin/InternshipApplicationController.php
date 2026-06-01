<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class InternshipApplicationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('internship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $internshipApplications = InternshipApplication::latest()->get();

        return view('admin.internships.index', compact('internshipApplications'));
    }

    public function show(InternshipApplication $internship)
    {
        abort_if(Gate::denies('internship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.internships.show', compact('internship'));
    }

    public function updateStatus(Request $request, InternshipApplication $internship)
    {
        abort_if(Gate::denies('internship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate(['status' => 'required|in:new,reviewed,approved,rejected']);
        $internship->update(['status' => $request->status]);

        return back()->with('message', 'Internship status updated successfully.');
    }

    public function destroy(InternshipApplication $internship)
    {
        abort_if(Gate::denies('internship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $internship->delete();

        return back()->with('message', 'Internship application deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('internship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        InternshipApplication::whereIn('id', (array) $request->input('ids', []))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
