<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('article_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articleCategories = ArticleCategory::withCount('articles')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('admin.articleCategories.index', compact('articleCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('article_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articleCategories.create');
    }

    public function store(StoreArticleCategoryRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        ArticleCategory::create($data);

        return redirect()->route('admin.article-categories.index')
            ->with('message', 'Article category created successfully.');
    }

    public function show(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articleCategories.show', compact('articleCategory'));
    }

    public function edit(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articleCategories.edit', compact('articleCategory'));
    }

    public function update(UpdateArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        $data = $request->validated();

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        $articleCategory->update($data);

        return redirect()->route('admin.article-categories.index')
            ->with('message', 'Article category updated successfully.');
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articleCategory->delete();

        return back()->with('message', 'Article category deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('article_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ArticleCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}