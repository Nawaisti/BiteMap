# BiteMap

**Find your next favorite place.**

BiteMap is a culinary discovery and reservation platform where users discover restaurants, explore menus, make reservations, and receive a digital reservation token.

---

## Development Roadmap

| Phase | Focus              | Status      |
|-------|--------------------|-------------|
| 01    | HTML / CSS         | 🟡 In Progress |
| 02    | JavaScript         | ⚪ Pending  |
| 03    | API                | ⚪ Pending  |
| 04    | PHP                | ⚪ Pending  |
| 05    | OOP + MVC          | ⚪ Pending  |
| 06    | Laravel            | ⚪ Pending  |
| 07    | CRUD + Auth        | ⚪ Pending  |
| 08    | Frontend Integration | ⚪ Pending |
| 09    | Deployment         | ⚪ Pending  |

---

## Project Structure

```
bitemap/
│
├── index.html                  # Homepage — hero, categories, featured
│
├── pages/
│   ├── explore.html            # Restaurant browse & filter
│   ├── restaurant.html         # Restaurant detail (menu, gallery, location)
│   ├── login.html              # Sign in
│   ├── register.html           # Create account
│   ├── reservation.html        # Reservation form
│   ├── reservation-ticket.html # Booking confirmation & QR ticket
│   ├── dashboard.html          # Customer — reservations, favorites, profile
│   └── admin.html              # Platform admin panel
│
├── css/
│   ├── style.css               # Design tokens, base styles, components
│   └── responsive.css          # Mobile-first breakpoint overrides
│
├── js/
│   └── main.js                 # Phase 02 JavaScript (placeholder)
│
├── assets/
│   ├── images/                 # Restaurant & food photography
│   ├── icons/                  # UI icons (SVG preferred)
│   └── logo/                   # BiteMap logo variants
│
└── README.md
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

- **Filenames** — lowercase with hyphens (`reservation-ticket.html`)
- **CSS** — custom properties for all design tokens; mobile-first media queries
- **HTML** — semantic elements (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`)
- **JS** — no functionality in Phase 01; Phase 02 expands `main.js`
- **Assets** — real photography/icons added in the design step; no placeholder images committed

---

*BiteMap is NOT a food delivery platform.*
