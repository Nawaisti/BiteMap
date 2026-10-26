# BiteMap

**Find your next favorite place.**

BiteMap is a Malang culinary discovery and table reservation web application where diners discover verified local restaurants, browse categorized menus with real Rupiah pricing, inspect live operating hours and interactive maps, save favorites, and preview digital reservation tokens.

---

## 1. Week 1–7 Curriculum Implementation Status

| Week | Sprint | Course Topic | BiteMap Implementation | Status |
| :--- | :--- | :--- | :--- | :--- |
| **Week 1** | Orientation | Product Canvas & Git Workflow | Problem-solution framing, 3 verified Malang culinary profiles, canonical GitHub repository (`Nawaisti/BiteMap`) | **VERIFIED COMPLETE** |
| **Week 2** | Sprint 01 | Semantic HTML5, CSS & Responsive Design | Semantic landmarks (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`), design tokens (`css/style.css`), mobile-first responsive rules (`css/responsive.css`) | **VERIFIED COMPLETE** |
| **Week 3** | Sprint 02 | JavaScript DOM, Events & Tailwind CSS | Tailwind CSS v4 CLI build (`src/input.css` -> `src/output.css`), DOM manipulation, live search/filter/sort, mobile nav drawer, favorites (`localStorage`), gallery lightbox, reservation preview flow | **VERIFIED COMPLETE** |
| **Week 4** | Sprint 03 | REST API, JSON, `fetch()` & Async UI | JSON REST API endpoint (`api/restaurants.php`) + static fallback (`api/restaurants.json`), `async`/`await` `fetch()` on Homepage & Explore, Loading spinner, Empty state, and Error + Retry state | **VERIFIED COMPLETE** |
| **Week 5** | Sprint 04 | Procedural Server-Side PHP | Server-rendered `.php` entry points, shared header/footer layouts, canonical array dataset (`data/restaurants.php`), `foreach` loops, `if/else` status badges, XSS escaping (`e()` / `htmlspecialchars()`) | **VERIFIED COMPLETE** |
| **Week 6** | Sprint 05 | Object-Oriented PHP (OOP) | Encapsulated `Restaurant` and `MenuItem` classes (`app/Models/`) with `private` properties, `__construct()`, public getters/setters, object composition, and domain behavior methods | **VERIFIED COMPLETE** |
| **Week 7** | Sprint 06 | Vanilla PHP MVC Architecture | Strict separation of **Models** (`app/Models/` — zero HTML markup), **Views** (`app/Views/` — layouts, partials, page templates), and **Controllers** (`app/Controllers/` — request handling & view orchestration) | **VERIFIED COMPLETE** |

---

## 2. Core Features

1. **Curated Malang Culinary Dataset (`data/restaurants.php`)**
   - **Okiru Ramen (`okiru-ramen`)**: Authentic halal Japanese ramen bar in Lowokwaru (Rating `4.8`, Distance `0.8 km`, 10 menu categories, table reservation enabled).
   - **Dialoogi Signature (`dialogi-signature-malang`)**: Modern Asian Fusion & specialty coffee house on Jl. Bandung No. 40 (Rating `4.7`, Distance `1.1 km`, 17 menu categories, table reservation enabled).
   - **Burger King Ijen (`burger-king-ijen-besar-malang`)**: 24-hour flame-grilled burger & drive-thru destination on Jl. Besar Ijen (Rating `4.5`, Distance `1.4 km`, 24-hour status badge, online table reservation disabled to demonstrate conditional availability).
2. **Dual Server-Side MVC + Progressive Client-Side Enhancement**
   - Server-side PHP MVC renders full semantic HTML on `index.php`, `pages/explore.php`, and `pages/restaurant.php`.
   - Client-side JavaScript (`js/main.js`) enhances pages with live filtering, sorting (`Recommended`, `Rating`, `Distance`, `Name`), `localStorage` favorites synchronization, menu category pill highlighting, and gallery lightbox modal.
3. **Zero-Cost REST API & Interactive Map Integration**
   - Built-in JSON REST API (`api/restaurants.php`) supports `?q=`, `?category=`, `?cuisine=`, `?rating=`, `?distance=`, `?open_now=1`, `?sort=`, `?id=`, `?autocomplete=`, and `?simulate_error=1` (HTTP 503 for demonstrating Week 4 error + retry handling).
   - Interactive Leaflet restaurant maps automatically use free **OpenStreetMap raster tiles** when no paid Geoapify API key is configured.
4. **Interactive Reservation & Dashboard Preview**
   - Submitting the reservation form on `pages/reservation.html` validates guest inputs, stores a preview booking in `sessionStorage`, redirects to `pages/reservation-ticket.html` with a generated booking code (`#BM-...`), and displays the upcoming reservation on `pages/dashboard.html`.

---

## 3. Project Directory Structure

```text
BiteMap/
├── index.php                       # MVC Homepage entry point -> HomeController::index()
├── index.html                      # Static HTML homepage counterpart (Weeks 2–4)
│
├── app/                            # Week 6–7 Object-Oriented & Vanilla PHP MVC Layer
│   ├── Controllers/
│   │   ├── HomeController.php      # Homepage controller (rails & spotlight)
│   │   ├── ExploreController.php   # Explore controller (query filtering & sorting)
│   │   ├── RestaurantController.php# Detail controller (single lookup & 404 handling)
│   │   └── ApiController.php       # REST API controller (JSON endpoints & error simulation)
│   ├── Models/
│   │   ├── Restaurant.php          # Pure Restaurant domain model & static repository methods
│   │   └── MenuItem.php            # Pure MenuItem domain model (zero HTML markup)
│   └── Views/
│       ├── layouts/
│       │   ├── header.php          # Shared HTML5 head, navigation & mobile drawer
│       │   └── footer.php          # Shared site footer & script includes
│       ├── partials/
│       │   ├── restaurant-card.php # Reusable restaurant discovery card template
│       │   └── menu-item.php       # Reusable menu item row template
│       ├── home/
│       │   └── index.php           # Homepage view template
│       ├── explore/
│       │   └── index.php           # Explore & filter view template
│       └── restaurant/
│           ├── show.php            # Restaurant detail view template
│           └── not-found.php       # Graceful HTTP 404 Not Found view template
│
├── api/
│   ├── restaurants.php             # JSON REST API entry point -> ApiController::restaurants()
│   └── restaurants.json            # Static JSON fallback dataset
│
├── data/
│   └── restaurants.php             # Canonical Malang restaurant & menu PHP array dataset
│
├── includes/
│   ├── functions.php               # Procedural PHP helper functions (Week 5)
│   ├── header.php                  # Legacy include bridge -> app/Views/layouts/header.php
│   └── footer.php                  # Legacy include bridge -> app/Views/layouts/footer.php
│
├── classes/
│   ├── Restaurant.php              # Backward-compatible loader -> app/Models/Restaurant.php
│   └── MenuItem.php                # Backward-compatible loader -> app/Models/MenuItem.php
│
├── pages/
│   ├── explore.php                 # MVC Explore entry point -> ExploreController::index()
│   ├── restaurant.php              # MVC Detail entry point -> RestaurantController::show()
│   ├── explore.html                # Static HTML explore page
│   ├── restaurant.html             # Static HTML restaurant detail page
│   ├── reservation.html            # Interactive table reservation form (preview)
│   ├── reservation-ticket.html     # Digital reservation confirmation ticket (preview)
│   ├── dashboard.html              # User dashboard (saved favorites & preview bookings)
│   ├── login.html                  # Sign-in UI & validation preview
│   ├── register.html               # Account registration UI & validation preview
│   └── admin.html                  # Platform administration UI preview
│
├── src/
│   ├── input.css                   # Tailwind CSS v4 source & theme tokens
│   └── output.css                  # Compiled Tailwind CSS v4 stylesheet
│
├── css/
│   ├── style.css                   # Custom design tokens & editorial component styles
│   └── responsive.css              # Mobile-first responsive media queries
│
├── js/
│   ├── main.js                     # Client-side DOM, events, REST API fetch(), Leaflet map
│   └── config.local.example.js     # Optional Geoapify API key template
│
├── assets/                         # Verified restaurant photography, icons & logos
├── package.json                    # Node.js scripts for Tailwind CSS v4 compilation
└── README.md                       # Project documentation
```

---

## 4. Local Setup & Execution Instructions

### Prerequisites
- **PHP 8.1+** (e.g., XAMPP PHP at `C:\xampp\php\php.exe` or system `php` CLI)
- **Node.js 18+** & **npm** (for rebuilding Tailwind CSS utility classes when modifying markup)

### Step 1: Install Frontend Build Dependencies
```bash
npm install
```

### Step 2: Build or Watch Tailwind CSS
Compile `src/input.css` into `src/output.css`:
```bash
npm run build:css
```
Or watch for changes during development:
```bash
npm run watch:css
```

### Step 3: Start the Local PHP Server
From the project root (`E:\College\Web\BiteMap`), start PHP's built-in web server:
```bash
php -S localhost:8000
```
*(If using XAMPP on Windows without `php` in your system `PATH`, run `"C:\xampp\php\php.exe" -S localhost:8000`.)*

### Step 4: Open BiteMap in Your Browser
- **Homepage (MVC):** `http://localhost:8000/index.php`
- **Explore & Filter (MVC + REST API):** `http://localhost:8000/pages/explore.php`
- **Restaurant Detail — Okiru Ramen:** `http://localhost:8000/pages/restaurant.php?id=okiru-ramen`
- **Restaurant Detail — Dialoogi Signature:** `http://localhost:8000/pages/restaurant.php?id=dialogi-signature-malang`
- **Restaurant Detail — Burger King Ijen (24h):** `http://localhost:8000/pages/restaurant.php?id=burger-king-ijen-besar-malang`
- **Restaurant Detail — 404 Not Found Demo:** `http://localhost:8000/pages/restaurant.php?id=unknown-spot`
- **JSON REST API Endpoint:** `http://localhost:8000/api/restaurants.php`
- **Simulated API Error (HTTP 503):** `http://localhost:8000/api/restaurants.php?simulate_error=1`

---

## 5. Zero-Cost API & Map Configuration

By default, BiteMap runs **100% free and without external API keys**:
- **Restaurant Discovery & Filtering API:** Served locally by `api/restaurants.php` (with automatic fallback to `api/restaurants.json`).
- **Location Autocomplete:** Served locally by `api/restaurants.php?autocomplete=...` for Malang culinary districts (Soekarno Hatta, Ijen Boulevard, Jl. Bandung, Klojen, Lowokwaru).
- **Interactive Maps:** Rendered with **Leaflet.js** and free **OpenStreetMap** standard raster tiles (`https://tile.openstreetmap.org/{z}/{x}/{y}.png`).

### Optional Geoapify API Key
If you wish to test live third-party Geoapify Places / Geocoding / Map tiles:
1. Copy `js/config.local.example.js` to `js/config.local.js` (git-ignored).
2. Set `window.BITEMAP_CONFIG = { GEOAPIFY_API_KEY: "your_key_here" };`.
3. If the external key is omitted, invalid, or offline, BiteMap automatically falls back to its local REST API and OpenStreetMap tiles.

---

## 6. Known Boundaries & Academic Scope (Weeks 1–7)

- **Database Persistence (Upcoming Weeks 8+):** Through Week 7, the course curriculum covers Semantic HTML/CSS (Week 2), JS DOM & Tailwind (Week 3), REST API & `fetch()` (Week 4), Procedural PHP (Week 5), PHP OOP (Week 6), and Vanilla PHP MVC (Week 7). MySQL database persistence and server-side authentication are scheduled for later weeks.
- **Honest Preview Notices:**
  - `pages/login.html` and `pages/register.html` perform client-side validation and redirect to `pages/dashboard.html` as an interactive UI preview.
  - `pages/reservation.html` and `pages/reservation-ticket.html` generate a client-side preview ticket stored in `sessionStorage` and clearly display an **"Interactive Reservation Preview"** notice.
  - `pages/admin.html` clearly displays an **"Admin Interface Preview — Static UI Mock"** badge.
