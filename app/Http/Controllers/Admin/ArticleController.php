<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('article_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articles = Article::with('category')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        abort_if(Gate::denies('article_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ArticleCategory::where('status', 1)
            ->orderBy('sort_order')
            ->pluck('name', 'id');

        return view('admin.articles.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['is_latest'] = $request->has('is_latest') ? 1 : 0;
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;
        $data['read_more_text'] = $data['read_more_text'] ?? 'Read More';
        $data['read_more_url'] = $this->cleanReadMoreUrl($data['read_more_url'] ?? null);

        unset($data['article_image']);

        $article = Article::create($data);

        if (blank($article->read_more_url)) {
            $article->update([
                'read_more_url' => route('frontend.articles.show', ['article' => $article->slug], false),
            ]);
        }

        if ($request->hasFile('article_image')) {
            $article
                ->addMediaFromRequest('article_image')
                ->toMediaCollection('article_image');
        }

        return redirect()->route('admin.articles.index')
            ->with('message', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        abort_if(Gate::denies('article_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->load('category');

        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        abort_if(Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ArticleCategory::where('status', 1)
            ->orderBy('sort_order')
            ->pluck('name', 'id');

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $article->id);
        $data['is_latest'] = $request->has('is_latest') ? 1 : 0;
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;
        $data['read_more_text'] = $data['read_more_text'] ?? 'Read More';
        $data['read_more_url'] = $this->cleanReadMoreUrl($data['read_more_url'] ?? null)
            ?: route('frontend.articles.show', ['article' => $data['slug']], false);

        unset($data['article_image']);

        $article->update($data);

        if ($request->hasFile('article_image')) {
            $article
                ->addMediaFromRequest('article_image')
                ->toMediaCollection('article_image');
        }

        return redirect()->route('admin.articles.index')
            ->with('message', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        abort_if(Gate::denies('article_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->delete();

        return back()->with('message', 'Article deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('article_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Article::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function cleanReadMoreUrl(?string $url): ?string
    {
        $url = trim((string) $url);

        return $url === '' || $url === '#' ? null : $url;
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value) ?: 'article';
        $slug = $baseSlug;
        $counter = 2;

        while (Article::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
