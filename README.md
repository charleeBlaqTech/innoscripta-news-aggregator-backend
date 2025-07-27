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

## Docker Setup (Dev Environment)

### Step 1: Clone the Repository

```bash
git clone https://github.com/your-username/innoscripta-news-aggregator.git
cd innoscripta-news-aggregator
```

### Step 2: Environment Setup

#### Laravel Backend

```bash
cd backend
cp .env.example .env
php artisan key:generate
```

#### React Frontend

```bash
cd frontend
cp .env.example .env
```

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

## Endpoints Overview

### Auth

* `POST /api/register`
* `POST /api/login`
* `POST /api/logout`

### Articles

* `GET /api/articles`: personalized feed (auth required)
* `GET /api/articles/search?q=term&source_id=1&category_id=2&from_date=2024-01-01&to_date=2025-01-01`

### Preferences

* `GET /api/preferences/options`
* `POST /api/preferences` (auth required)

---

## Folder Structure

```txt
root/
├── backend/       # Laravel app
│   ├── app/
│   ├── routes/
│   └── Dockerfile
├── frontend/      # React app
│   ├── src/
│   └── Dockerfile
├── docker-compose.yml
```

---

## UI Design

* UI design was adapted from a professional Dribbble mockup
* Mobile-responsive using Tailwind CSS

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

## Schedule Scrapers (Optional)

If not using Laravel scheduler in production Docker, run manually:

```bash
docker exec -it laravel_app php artisan scrape:run
```

Or add to crontab (in container):

```bash
* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1
```

---

## Project Status

* MVP Complete
* Fully Dockerized
* Meets all required features
* Ready for deployment and testing

---

## Author

Daudu Charles – [GitHub](https://github.com/charlesdaudu)

---

## License

MIT
