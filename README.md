# BiteMap

**Find your next favorite place.**

BiteMap is a culinary discovery and reservation platform where users discover restaurants, explore menus, make reservations, and receive a digital reservation token.

---

## Development Roadmap

| Phase | Focus                | Status         |
|-------|----------------------|----------------|
| 01    | HTML / CSS           | 🟢 Completed   |
| 02    | JavaScript           | 🟢 Completed   |
| 03    | API                  | 🟡 In Progress |
| 04    | PHP                  | 🟡 In Progress |
| 05    | OOP + MVC            | ⚪ Pending     |
| 06    | Laravel              | ⚪ Pending     |
| 07    | CRUD + Auth          | ⚪ Pending     |
| 08    | Frontend Integration | ⚪ Pending     |
| 09    | Deployment           | ⚪ Pending     |

---

## Project Structure

```
bitemap/
│
├── index.html                  # Legacy homepage — static client-side rendering
├── index.php                   # Server-rendered homepage (procedural PHP, dynamic rails)
│
├── data/
│   └── restaurants.php         # Canonical server-side restaurant dataset
│
├── includes/
│   ├── header.php              # Shared site header, metadata & navigation
│   ├── footer.php              # Shared site footer & deferred scripts
│   └── functions.php           # Core procedural helpers (data, formatting, hours)
│
├── pages/
│   ├── explore.html            # Legacy browse & filter — client-rendered grid
│   ├── explore.php             # Server-rendered restaurant explore & filter page
│   ├── restaurant.html         # Legacy restaurant detail — client-rendered
│   ├── restaurant.php          # Server-rendered restaurant detail (menu, gallery, 404)
│   ├── reservation.html        # Reservation booking form UI
│   ├── reservation-ticket.html # Booking confirmation & mock ticket
│   ├── dashboard.html          # Customer dashboard (reservations & saved favorites)
│   ├── login.html              # Customer authentication — sign in UI
│   ├── register.html           # Customer authentication — create account UI
│   └── admin.html              # Platform administration preview panel
│
├── css/
│   ├── style.css               # Design tokens, base styles, components
│   └── responsive.css          # Mobile-first breakpoint overrides
│
├── src/
│   ├── input.css               # Tailwind CSS v4 source directives
│   └── output.css              # Compiled utility stylesheet
│
├── js/
│   ├── main.js                 # Application client logic (filters, favorites, map, API)
│   └── config.local.js         # Local environment configuration template
│
├── assets/
│   ├── restaurants/            # Canonical restaurant media (Okiru, BK, Dialogi)
│   ├── images/                 # Editorial & discovery imagery
│   ├── icons/                  # UI icons (SVG)
│   └── logo/                   # BiteMap logo variants
│
├── docs/                       # Project references, menus & research profiles
├── package.json                # Build tooling & Tailwind CSS scripts
└── README.md                   # Project overview, roadmap & documentation
```

---

## Design Direction

**Warm Editorial + Modern Discovery**

| Token      | Value     |
|------------|-----------|
| Cream      | `#F7F3EA` |
| Dark       | `#24211D` |
| Terracotta | `#C85C3A` |
| Green      | `#6F8064` |
| White      | `#FFFFFF` |
| Font       | Poppins   |
| Radius     | ~20px     |

---

## Platform Actors

| Actor             | Scope                                                  |
|-------------------|--------------------------------------------------------|
| Customer / User   | Browse, search, explore, reserve, favorites, dashboard |
| Restaurant Owner  | Manage profile, menu, hours, reservations *(future)*   |
| Platform Admin    | Users, restaurants, categories, moderation *(future)*  |

---

## Core User Journey

```
Discover → Explore → Reserve → Arrive
```

---

## Conventions

- **Filenames** — lowercase with hyphens (`reservation-ticket.html`, `restaurant.php`)
- **CSS** — custom properties for all design tokens; mobile-first media queries; Tailwind CSS v4 pipeline
- **HTML** — semantic elements (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`)
- **PHP** — procedural server-side rendering (Week 5 standards); XSS escaping with `htmlspecialchars()`; modular include components
- **JS** — DOM manipulation, local favorites synchronization, interactive filtering, and third-party map/geocoding API integration
- **Assets** — real photography/icons added in the design step; no placeholder images committed

---

*BiteMap is NOT a food delivery platform.*
