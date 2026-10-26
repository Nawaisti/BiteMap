# BiteMap — Culinary Quest

**Explore Malang on the map. Complete Culinary Quests. Level up your palate.**

**BiteMap — Culinary Quest** is a map-first culinary discovery web application with lightweight gamification. Diners discover verified Malang restaurants on an interactive Leaflet/OpenStreetMap canvas, inspect official menus and live operating hours, complete exploration quests, earn deterministic XP, unlock Malang culinary achievement badges, and preview digital table reservations.

---

## 1. Week 1–7 Curriculum & Product Redirection Status

| Week / Phase | Course Topic / Milestone | BiteMap — Culinary Quest Implementation | Status |
| :--- | :--- | :--- | :--- |
| **Week 1** | Product Canvas & Git Workflow | Map-first culinary quest framing, 3 verified Malang culinary profiles, canonical GitHub repository (`Nawaisti/BiteMap`) | **VERIFIED COMPLETE** |
| **Week 2** | Semantic HTML5, CSS & Responsive Design | Semantic landmarks (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`), design tokens (`css/style.css`), mobile-first responsive rules (`css/responsive.css`) | **VERIFIED COMPLETE** |
| **Week 3** | JavaScript DOM, Events & Tailwind CSS | Tailwind CSS v4 CLI build (`src/input.css` -> `src/output.css`), bidirectional Map Marker <-> Card selection, live search/filter/sort, mobile nav drawer, favorites (`localStorage`), and Quest/XP HUD updates | **VERIFIED COMPLETE** |
| **Week 4** | REST API, JSON, `fetch()` & Async UI | JSON REST API endpoint (`api/restaurants.php`) returning restaurants & quests + static fallback (`api/restaurants.json`), `async`/`await` `fetch()`, Loading spinner, Empty state, and Error + Retry state | **VERIFIED COMPLETE** |
| **Week 5** | Procedural Server-Side PHP | Server-rendered `.php` entry points, shared header/footer layouts, canonical array datasets (`data/restaurants.php`, `data/quests.php`), `foreach` loops, `if/else` status badges, XSS escaping (`e()`) | **VERIFIED COMPLETE** |
| **Week 6** | Object-Oriented PHP (OOP) | Encapsulated `Restaurant`, `MenuItem`, and `Quest` classes (`app/Models/`) with `private` properties, `__construct()`, public getters/setters, object composition, and domain behavior methods | **VERIFIED COMPLETE** |
| **Week 7** | Vanilla PHP MVC Architecture | Strict separation of **Models** (`app/Models/` — zero HTML markup), **Views** (`app/Views/` — layouts, partials, page templates), and **Controllers** (`app/Controllers/` — request handling & view orchestration) | **VERIFIED COMPLETE** |

---

## 2. Core Features of BiteMap — Culinary Quest

### A. Map-First Culinary Discovery (Phase B)
- **Split-Screen Map-First Explore (`pages/explore.php`) & Homepage Quest Map (`index.php`):**
  - Powered by **Leaflet.js 1.9.4** and free **OpenStreetMap** raster tiles (`© OpenStreetMap contributors`).
  - **Bidirectional Marker & Card Sync:** Clicking a map marker highlights the corresponding restaurant card, updates the **Selected Landmark Inspector**, and records the `visit:<id>` quest objective; clicking `"Focus on Map"` on any restaurant card smoothly flies to and opens its map marker.
  - **Real-Time Filter Sync:** Searching or filtering by category, cuisine, distance, rating, or `Open Now` dynamically updates both the card list and the map markers.

### B. Culinary Quest MVP & Deterministic XP Engine (Phases C & D)
- **4 Malang Culinary Quests (`data/quests.php` & `app/Models/Quest.php`):**
  1. **Malang Culinary Scout (`quest-malang-scout`)** — *Starter (Lv. 1)*: Inspect all 3 Malang landmarks (`+150 XP Bonus` + `🧭 Malang Scout` Badge).
  2. **Ramen & Broth Connoisseur (`quest-noodle-connoisseur`)** — *Easy (Lv. 1)*: Inspect Okiru Ramen & log a tasting check-in (`+120 XP Bonus` + `🍜 Broth Master` Badge).
  3. **Bandung Street Artisan (`quest-bandung-artisan`)** — *Medium (Lv. 1)*: Save Dialoogi Signature to Favorites (`♥`) & log a check-in (`+130 XP Bonus` + `☕ Artisan Explorer` Badge).
  4. **Ijen 24-Hour Night Owl (`quest-midnight-ijen`)** — *Locked until Level 2 (`150+ XP`)*: Inspect & check in at 24-hour Burger King Ijen (`+200 XP Bonus` + `🦉 Ijen Night Owl` Badge).
- **Idempotent XP & Anti-Farming Rule:**
  - Each unique step (`visit:<id>`, `checkin:<id>`, `fav:<id>`) awards `+25 XP` **once** and is recorded by key in `localStorage['bitemap_quest_state']`. Repeatedly clicking the same button or marker cannot farm additional XP.
  - Every `150 XP` advances the player's Explorer Level (`Lv. 1 Novice Taster` -> `Lv. 2 Street Scout` -> `Lv. 3 Malang Pathfinder` -> `Lv. 4 Culinary Connoisseur` -> `Lv. 5 Grand Master of Malang`).
  - Includes a 1-click **"Reset Demo Progress"** button so evaluators can reset XP/Quests to `0 XP (Lv. 1)` during live grading.

### C. Verified Malang Restaurant Dataset & Data Honesty (`data/restaurants.php`)
- **Okiru Ramen (`okiru-ramen`)**: Verified address (Jl. Soekarno Hatta No.DR 17), coordinates, hours, and 10 authentic ramen/donburi menu categories.
- **Dialoogi Signature (`dialogi-signature-malang`)**: Verified address (Jl. Bandung No. 40), coordinates, hours, and 17 Asian fusion/coffee menu categories.
- **Burger King Ijen (`burger-king-ijen-besar-malang`)**: Verified address (Jl. Besar Ijen No.84), coordinates, 24-hour operating schedule, and Whopper menu category.
- **Transparency Labels:** Illustrative ratings (`(Demo)`) and estimated center distances (`(Est.)`) are explicitly labeled in the UI, and quest check-ins are clearly marked as **Self-Reported / Demo Progress**.

---

## 3. Project Directory Structure

```text
BiteMap/
├── index.php                       # MVC Homepage entry point -> HomeController::index()
├── index.html                      # Static HTML snapshot of Homepage
│
├── app/                            # Week 6–7 Object-Oriented & Vanilla PHP MVC Layer
│   ├── Controllers/
│   │   ├── HomeController.php      # Homepage controller (map, quests, badges & rails)
│   │   ├── ExploreController.php   # Map-First Explore controller (filtering, sorting & quests)
│   │   ├── RestaurantController.php# Detail controller (single lookup, quest banner & 404)
│   │   └── ApiController.php       # REST API controller (JSON restaurants, quests & error sim)
│   ├── Models/
│   │   ├── Restaurant.php          # Pure Restaurant domain model & static repository methods
│   │   ├── MenuItem.php            # Pure MenuItem domain model (zero HTML markup)
│   │   └── Quest.php               # Pure Quest domain model (zero HTML markup)
│   └── Views/
│       ├── layouts/
│       │   ├── header.php          # Shared header with Live Player XP HUD pill
│       │   └── footer.php          # Shared site footer & script includes
│       ├── partials/
│       │   ├── restaurant-card.php # Restaurant card with "Focus on Map" & "Check In (+25 XP)"
│       │   ├── quest-card.php      # Culinary Quest card with objective checklist & progress bar
│       │   └── menu-item.php       # Menu item row template
│       ├── home/
│       │   └── index.php           # Map-First Culinary Quest Homepage view
│       ├── explore/
│       │   └── index.php           # Split-Screen Map-First Explore view
│       └── restaurant/
│           ├── show.php            # Restaurant detail view with Quest Action Banner
│           └── not-found.php       # Graceful HTTP 404 Not Found view
│
├── api/
│   ├── restaurants.php             # JSON REST API entry point -> ApiController::restaurants()
│   └── restaurants.json            # Static JSON fallback dataset
│
├── data/
│   ├── restaurants.php             # Canonical Malang restaurant & menu PHP array dataset
│   └── quests.php                  # Canonical Malang Culinary Quests & Badges PHP dataset
│
├── includes/
│   ├── functions.php               # Procedural PHP helper functions (Week 5, zero HTML)
│   ├── header.php                  # Legacy include bridge -> app/Views/layouts/header.php
│   └── footer.php                  # Legacy include bridge -> app/Views/layouts/footer.php
│
├── classes/
│   ├── Restaurant.php              # Backward-compatible loader -> app/Models/Restaurant.php
│   └── MenuItem.php                # Backward-compatible loader -> app/Models/MenuItem.php
│
├── pages/
│   ├── explore.php                 # MVC Map-First Explore entry point
│   ├── restaurant.php              # MVC Detail entry point
│   ├── explore.html                # Static HTML snapshot of Explore page
│   ├── restaurant.html             # Static HTML restaurant detail page
│   ├── reservation.html            # Interactive table reservation form (preview)
│   ├── reservation-ticket.html     # Digital reservation confirmation ticket (preview)
│   ├── dashboard.html              # Explorer Profile (XP/Level/Badges, Favorites, Bookings)
│   ├── login.html                  # Sign-in UI & validation preview
│   ├── register.html               # Account registration UI & validation preview
│   └── admin.html                  # Platform administration UI preview
│
├── src/
│   ├── input.css                   # Tailwind CSS v4 source & theme tokens
│   └── output.css                  # Compiled Tailwind CSS v4 stylesheet
│
├── css/
│   ├── style.css                   # Custom design tokens & component styles
│   └── responsive.css              # Mobile-first responsive media queries
│
└── js/
    ├── main.js                     # Map-First Leaflet sync, Quest/XP engine, REST API fetch()
    └── config.local.example.js     # Optional Geoapify API key template
```

---

## 4. Local Setup & Execution Instructions

### Step 1: Install & Build Tailwind CSS
```bash
npm install
npm run build:css
```

### Step 2: Start the Local PHP Server
```bash
php -S localhost:8000
```
*(Or on Windows with XAMPP: `"C:\xampp\php\php.exe" -S localhost:8000`)*

### Step 3: Key Demonstration URLs
- **Culinary Quest Hub (Homepage MVC):** `http://localhost:8000/index.php`
- **Map-First Split Explorer (Explore MVC):** `http://localhost:8000/pages/explore.php`
- **Restaurant Detail + Quest Check-In (Okiru Ramen):** `http://localhost:8000/pages/restaurant.php?id=okiru-ramen`
- **Restaurant Detail (24h Burger King Ijen):** `http://localhost:8000/pages/restaurant.php?id=burger-king-ijen-besar-malang`
- **Explorer Profile & Badges Dashboard:** `http://localhost:8000/pages/dashboard.html`
- **JSON REST API (Restaurants + Quests):** `http://localhost:8000/api/restaurants.php`
