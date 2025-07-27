<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Scrapers\NewsApiScraperService;
use App\Services\Scrapers\GuardianScraperService;
use App\Services\Scrapers\NytScraperService;

class ScrapeNewsArticles extends Command
{
    protected $signature = 'news:scrape';

    protected $description = 'Scrape news articles from all integrated sources';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(
        NewsApiScraperService $newsApi,
        GuardianScraperService $guardian,
        NytScraperService $nyt
    ) {
        $this->info('Scraping NewsAPI...');
        $newsApi->fetchAndStoreArticles();

        $this->info('Scraping The Guardian...');
        $guardian->fetchAndStoreArticles();

        $this->info('Scraping NYT...');
        $nyt->fetchAndStoreArticles();

        $this->info('All scrapers completed.');
    }
}