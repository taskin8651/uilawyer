<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CareerApplicationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('career_application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $careerApplications = CareerApplication::latest()->get();

        return view('admin.careerApplications.index', compact('careerApplications'));
    }

    public function show(CareerApplication $careerApplication)
    {
        abort_if(Gate::denies('career_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.careerApplications.show', compact('careerApplication'));
    }

    public function updateStatus(Request $request, CareerApplication $careerApplication)
    {
        abort_if(Gate::denies('career_application_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'status' => 'required|in:new,reviewed,shortlisted,rejected',
        ]);

        $careerApplication->update([
            'status' => $request->status,
        ]);

        return back()->with('message', 'Application status updated successfully.');
    }

    public function destroy(CareerApplication $careerApplication)
    {
        abort_if(Gate::denies('career_application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $careerApplication->delete();

        return back()->with('message', 'Career application deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('career_application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CareerApplication::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}