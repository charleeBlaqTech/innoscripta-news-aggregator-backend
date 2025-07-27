<?php

namespace App\Services\Scrapers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use App\Models\Author;
use Carbon\Carbon;

class GuardianScraperService
{
    public function fetchAndStoreArticles()
    {
        $apiKey = env('GUARDIAN_API_KEY');
        $url = "https://content.guardianapis.com/search?api-key=$apiKey&show-fields=all&page-size=20";

        $response = Http::get($url);

        if ($response->ok()) {
            $data = $response->json();
            Log::info('Fetched guardian articles', $data['response']['results']);

            $source = Source::firstOrCreate(
            ['api_identifier' => 'guardian'],
            ['name' => 'The Guardian']
            );

            foreach ($data['response']['results'] as $item) {
                $title = $item['webTitle'];
                $url = $item['webUrl'];
                $publishedAt = Carbon::parse($item['webPublicationDate']);
                $content = $item['fields']['bodyText'] ?? '';
                $authorName = $item['fields']['byline'] ?? 'Unknown';
                $categoryName = $item['sectionName'] ?? 'general';

                $author = Author::firstOrCreate(['name' => $authorName]);
                $category = Category::firstOrCreate(['name' => strtolower($categoryName)]);
                Log::info('Saving article', ['title' => $title]);

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