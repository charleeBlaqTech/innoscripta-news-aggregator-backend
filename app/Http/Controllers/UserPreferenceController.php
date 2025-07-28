<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Source;
use App\Models\Category;
use App\Models\Author;

class UserPreferenceController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $preference = $user->preference;

        if (!$preference) {
            // MADE SURE I RETURN EMPTY ARRAY TO AVOID 404 error new user without existing preferences
            return response()->json([]);
        }

        return response()->json([
            'preferred_source' => $preference->source()->select('id', 'name')->first(),
            'preferred_category' => $preference->category()->select('id', 'name')->first(),
            'preferred_author' => $preference->author()->select('id', 'name')->first(),
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'preferred_source_id' => 'nullable|exists:sources,id',
            'preferred_category_id' => 'nullable|exists:categories,id',
            'preferred_author_id' => 'nullable|exists:authors,id',
        ]);

        $user = auth()->user();

        $user->preference()->updateOrCreate(
            [],
            array_merge(
                $request->only('preferred_source_id', 'preferred_category_id', 'preferred_author_id'),
                ['user_id' => $user->id]
            )
        );

        return response()->json(['message' => 'Preferences saved.']);
    }

    public function options()
    {
        return response()->json([
            'sources' => \App\Models\Source::select('id', 'name')->get(),
            'categories' => \App\Models\Category::select('id', 'name')->get(),
            'authors' => \App\Models\Author::select('id', 'name')->get()
        ]);
    }
}