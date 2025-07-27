<?php

namespace App\Services\Scrapers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use App\Models\Author;
use Carbon\Carbon;

class NytScraperService
{
    public function fetchAndStoreArticles()
    {
        $apiKey = env('NYT_API_KEY');
        $url = "https://api.nytimes.com/svc/topstories/v2/home.json?api-key=$apiKey";

        $response = Http::get($url);

        if ($response->ok()) {
            $data = $response->json();

            $source = Source::firstOrCreate(
            ['api_identifier' => 'nyt'],
            ['name' => 'New York Times']
            );

            Log::info('Fetched NEW TIMES articles', $data['results']);

            foreach ($data['results'] as $item) {
                $title = $item['title'];
                $url = $item['url'];
                $publishedAt = Carbon::parse($item['published_date']);
                $content = $item['abstract'] ?? '';
                $authorName = $item['byline'] ?? 'Unknown';
                $categoryName = $item['section'] ?? 'general';

                $author = Author::firstOrCreate(['name' => trim(str_replace('By', '', $authorName))]);
                $category = Category::firstOrCreate(['name' => strtolower($categoryName)]);

                Article::updateOrCreate(
                ['url' => $url],
                [
                'title' => $title,
                'content' => $content,
                'published_at' => $publishedAt,
                'source_id' => $source->id,
                'author_id' => $author->id,
                'category_id' => $category->id,
                ]
                );
            }
        }
    }
}