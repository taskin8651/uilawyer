<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\PracticeArea;
use Illuminate\Http\Request;

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
}
