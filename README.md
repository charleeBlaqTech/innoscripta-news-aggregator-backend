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

### 🐳 Step 3: Build Docker Containers

```bash
docker-compose build
```

---

### ▶️ Step 4: Start Containers

```bash
docker-compose up -d
```

---

### 🧱 Step 5: Initialize Laravel

```bash
docker exec -it laravel_app bash

# Inside container:
composer install
php artisan migrate --seed
php artisan storage:link
```

---

### 🔁 Scraping Articles

#### ▶️ Manual Scrape

```bash
docker exec -it laravel_app 
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

---

## 📄 License

MIT

---

---

## 💻 Frontend – React + TypeScript

Frontend for the **Innoscripta News Aggregator**, built with modern React, TypeScript, and Vite. It connects to the Laravel API for user auth, personalized feeds, and article search. Clean, responsive UI built with vanilla CSS.

---

### 🚀 Features

* 🔐 **User Authentication**
* 📰 **Personalized Article Feed**
* 🔎 **Search & Filter**
* ⚙️ **Preferences Page**
* 🎨 **Responsive UI**

---

## ⚙️ Frontend Setup Instructions

### 📦 Step 1: Clone the Repo

```bash
git clone https://github.com/charleeBlaqTech/innoscripta-news-aggregator-frontend.git
cd innoscripta-news-aggregator-frontend
```

---

### ⚙️ Step 2: Install Dependencies

```bash
npm install
```

---

### ▶️ Step 3: Start Development Server

```bash
npm run dev
```

The app will be available at `http://localhost:5173`.

---

### 💪 Dev Tools Used

* **Vite** – Lightning-fast build
* **Axios** – HTTP client
* **React Router** – Page navigation
* **Vanilla CSS** – Inputs, buttons, layout styling
* (Optional) **Redux Toolkit** – For global state

---

### 📂 Folder Structure

```
src/
├── api/              # Axios API logic
├── components/       # Reusable UI components (Toast, Loader, etc.)
├── pages/            # Feed, Preferences, Auth, Search
├── hooks/            # Custom hooks (e.g., useToast)
├── store/            # Redux tool kit
├── index.css         # CSS files
├── main.tsx          # Entry point
└── App.tsx           # Routing config
```

---

### 🔐 Auth Workflow

* Register or login
* Access token stored securely
* Authenticated requests attach token to headers

---

### 🗺️ Pages

* `/auth` – Login/Register
* `/feed` – Personalized article feed
* `/preferences` – Select preferred author, source, category
* `/search` – Filter/search across all articles
* `/` – Homepage with personal info + redirect to login

---

### 🌐 Environment Setup

Create a `.env` file and add:

```env
VITE_API_BASE_URL=http://localhost:8000/api
```

---

### 📝 Project Status

✅ MVP Complete
✅ Styled and responsive
✅ Works with Laravel backend
✅ Can be deployed via Vercel, Netlify, or Render

---

### 👨‍💻 Author

**Charles Daudu**
🔗 [GitHub](https://github.com/charleeBlaqTech)
🔗 [LinkedIn](https://linkedin.com/in/charleeblaqtech)

---

## 📄 License

MIT
