<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    public function all(Request $request)
    {
        $perPage = $request->query('per_page', 10); 

        $articles = Article::with(['source', 'category', 'author'])
            ->latest('published_at')
            ->paginate($perPage);

        return response()->json($articles);
    }
    
    public function search(Request $request)
    {
        $queryParam = $request->input('q');
        $sourceId = $request->input('source_id');
        $categoryId = $request->input('category_id');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $perPage = $request->query('per_page', 10); 

        $query = Article::query()->with(['source', 'category', 'author']);

        if ($queryParam) {
            $query->where(function ($q) use ($queryParam) {
                $q->where('title', 'like', "%$queryParam%")
                ->orWhere('content', 'like', "%$queryParam%");
            });
        }

        if ($sourceId) {
            $query->where('source_id', $sourceId);
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($fromDate) {
            $query->whereDate('published_at', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('published_at', '<=', $toDate);
        }

        $articles = $query->latest('published_at')->paginate($perPage);

        return response()->json($articles);
    }

}