<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Article;

class FeedController extends Controller
{
    //
   public function index(Request $request)
    {
        // $user = $request->user();

        // $query = Article::query();
        $user = auth()->user()->load('preference');
        $query = Article::with(['source', 'category', 'author']);

        if ($user->preference) {
            if ($user->preference->preferred_source_id) {
                $query->where('source_id', $user->preference->preferred_source_id);
            }
            if ($user->preference->preferred_category_id) {
                $query->where('category_id', $user->preference->preferred_category_id);
            }
            if ($user->preference->preferred_author_id) {
                $query->where('author_id', $user->preference->preferred_author_id);
            }
        }

        $articles = $query->latest('published_at')->paginate(10);

        return response()->json($articles);
    }

    public function show($id): JsonResponse
    {
        $article = Article::with(['source', 'category', 'author'])->find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

}