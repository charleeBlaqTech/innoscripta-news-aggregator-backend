# Innoscripta News Aggregator – Fullstack Project Documentation

---

## 📳 Backend – Laravel API

A powerful Laravel-based API for a full-stack news aggregator. Supports user authentication, preferences, personalized article feeds, search/filtering, and scraping news from external APIs. Fully Dockerized.

---

### 🔧 Tech Stack

* **Laravel 10**
* **Sanctum** for authentication
* **MySQL 8** via Docker
* **Docker + Docker Compose**
* **Scheduled artisan command** for scraping articles

---

### 🚀 Features

* ✅ **User Auth** – Register, login, logout
* ✅ **Feed Personalization** – Based on source, category, and author
* ✅ **News Scraping** – From NewsAPI, The Guardian, and NYT
* ✅ **Search & Filters** – By keyword, source, category, date range
* ✅ **RESTful API** – Clean and well-structured
* ✅ **Dockerized** – Fast local setup

---

## 🧰 Backend Setup Instructions

### 📦 Step 1: Clone Repository

```bash
git clone https://github.com/charleeBlaqTech/innoscripta-news-aggregator-backend.git
cd innoscripta-news-aggregator-backend
```

---

### ⚙️ Step 2: Configure `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Update the following environment variables:

```env
APP_KEY= # paste generated key here

NEWSAPI_KEY=your_api_key
GUARDIAN_API_KEY=your_api_key
NYT_API_KEY=your_api_key
```

---

### 🐳 Step 3: Build Docker images and start Containers

```bash
docker-compose up --build
```

---

### 🧱 Step 5: Initialize Laravel

```bash
docker exec -it laravel_app bash

# Inside container:
php artisan migrate --seed
php artisan storage:link
```

---

### 🔁 Scraping Articles

#### ▶️ Manual Scrape

```bash
#still inside the container after running the previous commands above======
php artisan news:scrape
```

#### 🕒 Scheduled Scrape

To enable periodic scraping:

```bash
* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1
```

(Inside the container or use Laravel Forge/Render cron job setup)

---

### 📡 API Endpoints

#### 🔐 Auth

* `POST /api/register`
* `POST /api/login`
* `POST /api/logout`

#### 📰 Articles
*(auth required)*
* `GET /api/feed`
* `GET /api/feed/{id}`
* `GET /api/articles/search?q=term&source_id=1&category_id=2&from_date=2024-01-01&to_date=2025-01-01`

#### 🎯 Preferences
*(auth required)*
* `GET /api/preferences/options`
* `GET /api/preferences`
* `POST /api/preferences`

---

### ✅ Best Practices Used

* SOLID + DRY principles
* Modular scraping service classes
* Laravel validation + relationships
* Simple and secure auth via Sanctum

---

### 🧪 Testing

* Register new users
* Run scrapers
* Use `/feed` to view personalized content
* Search and filter articles

---

## 📜 Project Status

✅ MVP Complete
✅ Dockerized & ready for deployment
✅ All endpoints functioning as expected

---

### 👨‍💻 Author
**Charles Daudu**
🔗 [GitHub](https://github.com/charleeBlaqTech)
🔗 [LinkedIn](https://linkedin.com/in/charleeblaqtech)

---

## 📄 License

MIT

---