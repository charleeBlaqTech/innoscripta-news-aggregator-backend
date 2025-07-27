# Innoscripta News Aggregator

This is a full-stack news aggregator application built with **Laravel** (PHP) for the backend and **React + TypeScript** for the frontend. 

It supports:
 user registration/login, 
 personalized article feeds, 
 advanced filtering and search, 
 and periodic scraping of news articles.

---

## 🔧 Tech Stack

### Backend (Laravel 10)

* Laravel Sanctum (Authentication)
* Eloquent ORM
* MySQL (via Docker)
* Scheduled commands for scraping articles

### Frontend (React + TypeScript)

* Vite + React + TypeScript
* Axios for HTTP requests
* TailwindCSS for styling
* Redux Toolkit (if needed)

### DevOps

* Docker
* Docker Compose

---

## Features

### User Management

* Register and login
* Authenticated sessions using Laravel Sanctum

### Article Scraping

* Scrapers run via Laravel Artisan schedule (e.g., `php artisan schedule:run`)
* Articles are saved locally into MySQL

### Personalized Feed

* Users can set preferences for:

  * Preferred source
  * Preferred category
  * Preferred author
* Personalized `/feed` endpoint returns articles based on user preference

### Article Search & Filtering

* Search by keyword
* Filter by:

  * Source
  * Category
  * Date range (from, to)

### Preferences

* `/preferences/options`: returns all available authors, sources, and categories
* `/preferences`: save user preferences

### Fully Dockerized

* MySQL DB
* Laravel backend
* React frontend

---



===================================================================================================

# INNOSCRIPTA NEWS AGGREGATOR (Backend - Laravel)

This is the Laravel backend for the Innoscripta News Aggregator Task. It provides APIs for user authentication, article feeds, search, and user preferences.

---

## Features

- User authentication (register, login, logout)
- Personalized feed based on user preferences
- Article scraping from:
  - NewsAPI
  - The Guardian
  - The New York Times
- Full-text search with filters
- RESTful API structure
- Scheduler for periodic scraping

---


## Local Development Setup (Docker)

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- Git (optional)

### Step 1: Clone the Repository

### CMD || BASH
git clone https://github.com/charleeBlaqTech/innoscripta-news-aggregator-backend.git
cd innoscripta-news-aggregator-backend

### Step 2: Environment Setup
cp .env.example .env
php artisan key:generate
### fill just the values of the env details below after creating a .env file from the .env.example as stated above.

# app key with the key:generated above
APP_KEY= 
# ========================SCRAPPERS API=========================
NEWSAPI_KEY=
GUARDIAN_API_KEY=
NYT_API_KEY=



### Step 3: Build Containers

```bash
docker-compose build
```

### Step 4: Run the Containers

```bash
docker-compose up -d
```

### Step 5: Backend Setup

```bash
docker exec -it laravel_app bash
composer install
php artisan migrate --seed
php artisan storage:link
```

---


## Schedule Scrapers (Optional)

If not using cronjob in production, run manually:

```bash
docker exec -it laravel_app 
php artisan news:scrape
```

Or add to crontab (in container):

```bash
* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1
```

---


## Endpoints Overview

### Auth

* `POST /api/register`
* `POST /api/login`
* `POST /api/logout`

### Articles

* `GET /api/feed`: personalized feed (auth required)
* `GET /api/feed/id`: Get single feed (auth required)
* `GET /api/articles/search?q=term&source_id=1&category_id=2&from_date=2024-01-01&to_date=2025-01-01` (auth required)

### Preferences

* `GET /api/preferences/options ` (auth required)
* `GET /api/preferences` (auth required)
* `POST /api/preferences` (auth required)

---

## Best Practices Followed

* DRY and KISS principles
* SOLID architecture in backend
* Proper use of Laravel validation, relationships, and service layers

---

## 🧪 Testing

* Test accounts can be registered manually
* Sample scraping runs populate sources, authors, and categories automatically

---

## Project Status

* MVP Complete
* Fully Dockerized
* Meets all required features
* Ready for deployment and testing

---

## Author

Charles Daudu – [GitHub](https://github.com/charleeBlaqTech)

---

## License

MIT
