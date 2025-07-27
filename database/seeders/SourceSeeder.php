<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('sources')->insert([
            [
                'name' => 'NewsAPI',
                'base_url' => 'https://newsapi.org',
                'api_identifier' => 'newsapi'
            ],
            [
                'name' => 'The Guardian',
                'base_url' => 'https://theguardian.com',
                'api_identifier' => 'guardian'
            ],
            [
                'name' => 'New York Times',
                'base_url' => 'https://nytimes.com',
                'api_identifier' => 'nyt'
            ],
        ]); 
    }
}