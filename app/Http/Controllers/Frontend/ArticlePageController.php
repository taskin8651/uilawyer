<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticlePageController extends Controller
{
    public function index(Request $request)
    {
        $activeCategory = $request->get('category');

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
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $latestArticles = Article::with('category')
            ->where('status', 1)
            ->where('is_latest', 1)
            ->latest('published_date')
            ->take(3)
            ->get();

        return view('frontend.articles', compact(
            'articleCategories',
            'articles',
            'latestArticles',
            'activeCategory'
        ));
    }
}