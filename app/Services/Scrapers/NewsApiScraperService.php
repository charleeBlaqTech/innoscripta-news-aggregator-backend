<?php

namespace App\Services\Scrapers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use App\Models\Author;
use Carbon\Carbon;

class NewsApiScraperService
{
    public function fetchAndStoreArticles()
    {
        $apiKey = env('NEWSAPI_KEY');
        $url = "https://newsapi.org/v2/top-headlines?language=en&pageSize=20&apiKey=$apiKey";

        $response = Http::get($url);
        
        if ($response->ok()) {
            $data = $response->json();
             Log::info('Fetched NEWSAPI articles', $data['articles']);

            foreach ($data['articles'] as $articleData) {
                $source = Source::firstOrCreate([
                'api_identifier' => 'newsapi'
                ], [
                'name' => $articleData['source']['name']
                ]);

                $author = Author::firstOrCreate(['name' => $articleData['author'] ?? 'Unknown']);

                $category = Category::firstOrCreate(['name' => 'general']);

                Article::updateOrCreate(
                ['url' => $articleData['url']],
                [
                'title' => $articleData['title'],
                'content' => $articleData['content'] ?? '',
                'published_at' => new Carbon($articleData['publishedAt']),
                'source_id' => $source->id,
                'author_id' => $author->id,
                'category_id' => $category->id
                ]
                );
            }
        }
    }
}