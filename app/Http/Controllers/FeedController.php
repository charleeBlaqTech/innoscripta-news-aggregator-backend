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

        $user = auth()->user()->load('preference');
        $query = Article::with(['source', 'category', 'author']);

        // if ($user->preference) {
        //     if ($user->preference->preferred_source_id) {
        //         $query->where('source_id', $user->preference->preferred_source_id);
        //     }
        //     if ($user->preference->preferred_category_id) {
        //         $query->where('category_id', $user->preference->preferred_category_id);
        //     }
        //     if ($user->preference->preferred_author_id) {
        //         $query->where('author_id', $user->preference->preferred_author_id);
        //     }
        // }

        // =======Much flexible application of preferences to avoid strict checks on where article matches all three preferences===
        if ($user->preference &&
            ($user->preference->preferred_source_id ||
            $user->preference->preferred_category_id ||
            $user->preference->preferred_author_id)) {

            $query->where(function ($q) use ($user) {
                if ($user->preference->preferred_source_id) {
                    $q->orWhere('source_id', $user->preference->preferred_source_id);
                }
                if ($user->preference->preferred_category_id) {
                    $q->orWhere('category_id', $user->preference->preferred_category_id);
                }
                if ($user->preference->preferred_author_id) {
                    $q->orWhere('author_id', $user->preference->preferred_author_id);
                }
            });
        }

        // Allow frontend to set per_page via query param for pagination purpose
        $perPage = $request->query('per_page', 10);
        $articles = $query->latest('published_at')->paginate($perPage);

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