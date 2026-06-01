<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalQa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class LegalQaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('legal_qa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legalQas = LegalQa::with('user')->latest()->get();

        return view('admin.legalQas.index', compact('legalQas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('legal_qa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->validate(['question' => 'required|string|max:5000']);
        $data['user_id'] = auth()->id();
        $data['answer'] = 'AI integration is not configured yet. This question has been saved for legal team review.';

        LegalQa::create($data);

        return back()->with('message', 'Question saved successfully.');
    }

    public function show(LegalQa $legalQa)
    {
        abort_if(Gate::denies('legal_qa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.legalQas.show', compact('legalQa'));
    }

    public function destroy(LegalQa $legalQa)
    {
        abort_if(Gate::denies('legal_qa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legalQa->delete();

        return back()->with('message', 'Q&A deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('legal_qa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        LegalQa::whereIn('id', (array) $request->input('ids', []))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
