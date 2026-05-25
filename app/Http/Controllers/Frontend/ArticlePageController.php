<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\PracticeArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticlePageController extends Controller
{
    private const FALLBACK_IMAGE = 'https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=900&q=80';

    public function index(Request $request)
    {
        $activeCategory = $request->get('category');
        $search = trim((string) $request->get('search'));

        $articleCategories = ArticleCategory::where('status', 1)
            ->withCount(['articles' => function ($query) {
                $query->where('status', 1);
            }])
            ->orderBy('sort_order')
            ->get();

        $articles = Article::with('category')
            ->where('status', 1)
            ->when($activeCategory, function ($query) use ($activeCategory) {
                $query->whereHas('category', function ($catQuery) use ($activeCategory) {
                    $catQuery->where('slug', $activeCategory);
                });
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('author_name', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $latestArticles = Article::with('category')
            ->where('status', 1)
            ->where('is_latest', 1)
            ->latest('published_date')
            ->take(3)
            ->get();

              $relatedPractices = PracticeArea::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.articles', compact(
            'articleCategories',
            'articles',
            'latestArticles',
            'activeCategory',
            'search',
            'relatedPractices'

        ));
    }

    public function show(Article $article)
    {
        abort_unless($article->status, 404);

        $article->load('category');

        $articleCategories = ArticleCategory::where('status', 1)
            ->withCount(['articles' => function ($query) {
                $query->where('status', 1);
            }])
            ->orderBy('sort_order')
            ->get();

        $latestArticles = Article::with('category')
            ->where('status', 1)
            ->where('id', '!=', $article->id)
            ->latest('published_date')
            ->latest()
            ->take(3)
            ->get();

        $relatedArticles = Article::with('category')
            ->where('status', 1)
            ->where('id', '!=', $article->id)
            ->when($article->article_category_id, function ($query) use ($article) {
                $query->where('article_category_id', $article->article_category_id);
            })
            ->latest('published_date')
            ->latest()
            ->take(3)
            ->get();

        if ($relatedArticles->count() < 3) {
            $extraArticles = Article::with('category')
                ->where('status', 1)
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->latest('published_date')
                ->latest()
                ->take(3 - $relatedArticles->count())
                ->get();

            $relatedArticles = $relatedArticles->concat($extraArticles);
        }

        return view('frontend.article-details', [
            'article' => $article,
            'articleCategories' => $articleCategories,
            'latestArticles' => $latestArticles,
            'relatedArticles' => $relatedArticles,
            'fallbackImage' => self::FALLBACK_IMAGE,
        ]);
    }

    public function create()
    {
        $articleCategories = ArticleCategory::where('status', 1)
            ->orderBy('sort_order')
            ->pluck('name', 'id');

        return view('frontend.submit-article', compact('articleCategories'));
    }

    public function store(StorePublicArticleRequest $request)
    {
        $data = $request->validated();

        $article = Article::create([
            'article_category_id' => $data['article_category_id'] ?? null,
            'title' => $data['title'],
            'slug' => $this->uniqueSlug($data['title']),
            'author_name' => $data['author_name'],
            'submitter_email' => $data['submitter_email'],
            'submitter_phone' => $data['submitter_phone'],
            'published_date' => now()->toDateString(),
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'is_public_submission' => 1,
            'is_latest' => 0,
            'status' => 0,
            'sort_order' => 0,
            'meta_title' => $data['title'],
            'meta_description' => Str::limit(strip_tags($data['short_description']), 160),
        ]);

        if ($request->hasFile('article_image')) {
            $article
                ->addMediaFromRequest('article_image')
                ->toMediaCollection('article_image');
        }

        if ($request->hasFile('article_document')) {
            $article
                ->addMediaFromRequest('article_document')
                ->toMediaCollection('article_document');
        }

        if ($request->hasFile('payment_screenshot')) {
            $article
                ->addMediaFromRequest('payment_screenshot')
                ->toMediaCollection('payment_screenshot');
        }

        return back()->with('message', 'Thank you. Your article has been submitted successfully and will be published after admin approval.');
    }

    private function uniqueSlug(string $value): string
    {
        $baseSlug = Str::slug($value) ?: 'article';
        $slug = $baseSlug;
        $counter = 2;

        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
