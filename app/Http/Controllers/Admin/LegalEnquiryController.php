<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class LegalEnquiryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('legal_enquiry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legalEnquiries = LegalEnquiry::latest()->get();

        return view('admin.legalEnquiries.index', compact('legalEnquiries'));
    }

    public function show(LegalEnquiry $legalEnquiry)
    {
        abort_if(Gate::denies('legal_enquiry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.legalEnquiries.show', compact('legalEnquiry'));
    }

    public function updateStatus(Request $request, LegalEnquiry $legalEnquiry)
    {
        abort_if(Gate::denies('legal_enquiry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]);

        $legalEnquiry->update([
            'status' => $request->status,
        ]);

        return back()->with('message', 'Enquiry status updated successfully.');
    }

    public function destroy(LegalEnquiry $legalEnquiry)
    {
        abort_if(Gate::denies('legal_enquiry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legalEnquiry->delete();

        return back()->with('message', 'Legal enquiry deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('legal_enquiry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        LegalEnquiry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}