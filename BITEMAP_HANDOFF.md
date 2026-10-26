# BITEMAP — PROJECT HANDOFF DOCUMENT

Version: 1.0
Last Updated: 2026-10-06

This document is the authoritative project context for continuing
BiteMap development in a new AI conversation/account.

READ THIS DOCUMENT BEFORE MODIFYING THE PROJECT.

============================================================
01 — PRODUCT IDENTITY
============================================================

Product:
BiteMap

Product type:
Restaurant Discovery & Reservation Platform

Tagline:
"Find your next favorite place."

Core journey:

Discover
→ Explore
→ Reserve
→ Arrive

BiteMap is a culinary discovery platform.

BiteMap is NOT:
- a food delivery application
- an ecommerce food marketplace
- a Google Maps clone

The map/location layer is supportive.
BiteMap owns the restaurant discovery, restaurant information,
menu presentation, and reservation experience.

============================================================
02 — DESIGN DIRECTION — LOCKED
============================================================

Design direction:

WARM EDITORIAL + MODERN DISCOVERY

Personality:

- Warm
- Modern
- Discoverable
- Food-focused

Typography:

Poppins

Locked palette:

Cream:
#F7F3EA

Dark:
#24211D

Terracotta:
#C85C3A

Green:
#6F8064

White:
#FFFFFF

Visual characteristics:

- warm editorial appearance
- modern discovery experience
- generous whitespace
- strong typography
- large food/restaurant imagery
- clean rounded cards
- subtle shadows
- clear visual hierarchy
- mobile-first responsiveness
- mobile should feel like an app in a browser

DO NOT introduce a new visual language.

Do NOT redesign BiteMap into:
- SaaS dashboard style
- ecommerce style
- glassmorphism
- neon UI
- generic template design

============================================================
03 — PRODUCT ACTORS
============================================================

CUSTOMER

Customer can:

- browse without login
- search restaurants
- discover categories
- view restaurant detail
- view gallery
- view menu
- view location
- reserve
- receive reservation ticket
- check in
- view reservation history
- favorite restaurants

Login is required only for identity-dependent functionality.

RESTAURANT OWNER / STAFF

Restaurant staff can eventually:

- manage restaurant profile
- upload photos
- manage description
- manage categories/tags
- manage menu
- manage menu categories
- manage menu items
- manage hours
- manage tables
- manage reservations
- check in customers

Staff can only manage their own restaurant.

PLATFORM ADMIN

Admin eventually manages:

- users
- restaurants
- restaurant verification
- platform-level categories
- moderation
- monitoring

Admin does NOT manually manage every restaurant's menu/photo.

Restaurant owners maintain their own restaurant data.

============================================================
04 — LOGIN MODEL — LOCKED
============================================================

Browsing does NOT require login.

Customer:

Home
→ Explore
→ Restaurant
→ Menu / Gallery / Location
→ Reserve
→ Login if identity is required

pages/login.html
pages/register.html

are CUSTOMER authentication pages.

Do NOT rename them to STAFF.

Staff authentication is a separate future flow.

============================================================
05 — DISCOVERY CATEGORIES
============================================================

Primary discovery categories:

- Jajanan
- Local Food
- Asian Food
- Fast Food
- Restaurant
- Cafe & Coffee
- Drinks
- Dessert & Bakery
- Healthy Food

Secondary cuisine examples:

- Japanese
- Korean
- Chinese
- Thai
- Vietnamese
- Indian
- Indonesian
- Javanese
- Sundanese
- Padang
- Balinese

Mood / tags:

- Cozy
- Work & Study
- Romantic
- Family
- Hangout
- Late Night
- Celebration
- Instagrammable

Feature tags:

- WiFi
- Indoor
- Outdoor
- Quiet
- Study Friendly
- Family Friendly
- Halal

A category does NOT automatically imply a feature.

============================================================
06 — HOMEPAGE UX — LOCKED
============================================================

Homepage hierarchy:

Hero
→ Category Discovery
→ Popular Near You
→ Other Discovery Rails
→ Final CTA
→ Footer

Hero:

"What are you craving?"

Hero includes:
- search
- location
- discovery action

Discovery rails use:

Title
Subtitle
"Lihat semua →"
Horizontal restaurant cards

Each rail displays a maximum of 5 preview items.

IMPORTANT:
The target desktop experience is approximately FIVE visible preview cards.

Do NOT assume 280px is the final card width.

The previous 280px value was only a temporary/foundation constraint.

Desktop should visually accommodate approximately:

[ CARD ][ CARD ][ CARD ][ CARD ][ CARD ]

Mobile remains horizontally scrollable.

============================================================
07 — LOCATION / NEARBY
============================================================

Nearby discovery uses Browser Geolocation API.

Permission must be explicitly requested by user action.

No silent location access.

If permission is denied:
BiteMap must continue working with manual location/search.

Do not persist location history just for nearby discovery.

Nearby distance calculation uses actual coordinates.

Do not fabricate coordinates.

============================================================
08 — RESTAURANT DETAIL
============================================================

Restaurant detail structure:

Hero
→ Identity
→ Actions
→ Tabs
→ About
→ Gallery
→ Menu
→ Location
→ Hours
→ Reservation CTA

Restaurant identity may contain:

- name
- category
- cuisine
- rating
- distance
- price
- description

Gallery:
editorial horizontal/grid presentation.

Menu:
restaurant-specific menu.

Location:
address/map/hours.

Reservation CTA appears only if reservation capability exists.

============================================================
09 — MENU MODEL
============================================================

Menu is dynamic per restaurant.

Conceptual structure:

menu_categories:
- id
- restaurant_id
- name
- sort_order

menu_items:
- id
- category_id
- name
- description
- price
- image
- is_available

Required:
- name
- category
- price

Optional:
- description
- image

Menu should feel like a restaurant menu.

NOT ecommerce product cards.

============================================================
10 — RESERVATION UX — LOCKED
============================================================

Reservation journey:

1 DATE
2 TIME
3 TABLE
4 CONFIRM

Then:

Digital ticket / QR
→ Arrival
→ Check-in

Current frontend implementation is static UX only.

Table selection is currently a visual UX boundary.

DO NOT invent real table availability.

DO NOT invent fake booking IDs.

DO NOT generate fake QR tokens.

Backend/database integration happens later.

Reservation must prevent double booking only after backend phase.

============================================================
11 — FALLBACK STATES — LOCKED
============================================================

No broken UI.

Missing image:
BiteMap visual placeholder.

Missing description:
"Description unavailable."

Missing menu:
"Menu isn't available at the moment."

No rating:
"New · No reviews yet"

Missing location:
"Location unavailable"

Missing hours:
"Hours not available"

Reservation unsupported:
Reserve feature should be hidden/disabled appropriately.

Do NOT invent fake restaurant photographs or fake data.

============================================================
12 — CANONICAL RESTAURANT DATA — LOCKED
============================================================

Exactly 13 canonical restaurant IDs:

ramenku
kopi-senja
warung-nusa
sora-coffee
burger-house
dapur-lokal
miso-corner
taman-rasa
bean-roasters
morning-brew
the-library-cafe
quiet-space
work-and-brew

DO NOT add/remove/rename IDs.

Default demo favorites:

kopi-senja
sora-coffee
dapur-lokal

============================================================
13 — CURRENT JAVASCRIPT STATUS
============================================================

Phase 02 JavaScript is COMPLETE + LOCKED.

js/main.js must NOT be modified during the current visual
refinement work.

Current architecture contains:

- unified discovery
- favorites
- nearby discovery
- restaurant detail
- reservation state
- dashboard state
- ticket flow
- global initialization

Do not rewrite or refactor JavaScript during visual work.

============================================================
14 — ROADMAP — LOCKED
============================================================

01 HTML/CSS
02 JavaScript
03 API
04 PHP
05 OOP + MVC
06 Laravel
07 CRUD + Auth
08 Frontend Integration
09 Deployment

CURRENT STATUS:

Phase 01 HTML/CSS
→ COMPLETE + LOCKED

Phase 02 JavaScript
→ COMPLETE + LOCKED

Pre-Phase 03 Tailwind Migration
→ IN PROGRESS / FINAL VISUAL REFINEMENT

Phase 03 API
→ NOT STARTED

DO NOT START API YET.

============================================================
15 — TAILWIND MIGRATION STATUS
============================================================

Tailwind CSS v4 is installed.

Version:
Tailwind CSS 4.3.3

The migration has already covered:

- Tailwind foundation
- Header
- Navigation
- Footer
- Buttons
- Badges
- Favorite button
- Shared states
- Homepage
- Explore
- Restaurant Detail
- Reservation
- Reservation Ticket
- Dashboard
- Customer Auth
- Admin
- Legacy CSS cleanup
- Visual regression repairs

However:

THE VISUAL RESULT IS NOT YET CONSIDERED FINAL.

Actual browser screenshots revealed remaining visual inconsistencies.

Therefore do NOT assume the Tailwind migration is visually complete
just because previous automated reports said PASS.

============================================================
16 — CURRENT VISUAL REFINEMENT TASK
============================================================

Current task:

TASK 07 — FULL VISUAL CONSISTENCY & LAYOUT REFINEMENT

Strategy:

Do NOT fix everything in one uncontrolled operation.

Use sequential steps.

Step 01:
Global Layout & CSS Cascade
→ PASS / completed

Step 02:
Homepage + Discovery Rails
→ CURRENT NEXT STEP

Step 03:
Explore + Restaurant Cards

Step 04:
Restaurant Detail

Step 05:
Reservation + Ticket

Step 06:
Dashboard + Auth + Admin

Step 07:
Responsive Visual QA

Step 08:
Final Cross-Page Audit

Each step must be reviewed before moving to the next.

============================================================
17 — TASK 07 STEP 01 RESULT
============================================================

Step 01 focused on:

- global CSS cascade
- Tailwind vs legacy CSS
- global containers
- global spacing foundation
- scrollbar foundation
- responsive foundation

Current cascade architecture:

@layer theme, base, legacy, components, utilities;

Legacy CSS is wrapped in:

@layer legacy

Shared component primitives are organized under:

@layer components

Tailwind utilities remain the final utility layer.

This allows Tailwind utilities to override legacy defaults without
requiring !important.

Step 01 also introduced subtle scrollbar styling.

Step 01 build:
PASS

Step 01 js/main.js:
0 diff

Step 01 data:
13 canonical restaurants intact

Step 01 forbidden architecture:
PASS

IMPORTANT:

Step 01 introduced:

.content-rail .restaurant-card {
    flex: 0 0 280px;
    width: 280px;
}

This is NOT a permanently locked design value.

It is only a foundation constraint.

Step 02 MUST review the actual card width and determine a better
responsive width so that desktop discovery rails visually
accommodate approximately FIVE preview cards.

============================================================
18 — CURRENT VISUAL FINDINGS
============================================================

Actual screenshots showed:

HOMEPAGE

1. Hero has excessive empty vertical space.
2. Restaurant cards in rails are too large/wide.
3. Desktop rails show roughly four cards instead of the desired
   five-card preview experience.
4. Native scrollbar appearance was visually too dominant.
5. Category rail looked too much like browser-default overflow.
6. Vertical spacing between discovery sections is too generous.
7. Placeholder images visually dominate the cards.

EXPLORE

Generally structurally good, but vertical rhythm and card sizing
still require refinement.

RESTAURANT DETAIL

Structurally good, needs visual refinement.

RESERVATION

Structurally good, needs visual polish rather than redesign.

LOGIN / REGISTER

Currently relatively good.

DASHBOARD

Needs visual consistency review.

ADMIN

Needs visual consistency review.

============================================================
19 — CRITICAL VISUAL TARGET
============================================================

Homepage discovery rail desktop target:

Approximately:

[ CARD ][ CARD ][ CARD ][ CARD ][ CARD ]

Do NOT lock card width at 280px if that prevents this.

Mobile:

approximately 1–1.5 cards visible,
with obvious horizontal continuation.

Tablet:

approximately 2–3 cards depending on width.

The cards must remain readable and not become too small.

============================================================
20 — CURRENT WORKING TREE WARNING
============================================================

The project contains uncommitted cumulative changes from the
Tailwind migration and visual refinement work.

DO NOT:

- git reset
- git restore
- git clean
- checkout
- discard changes

DO NOT assume every git diff line belongs to the latest task.

Inspect the current state before modifying it.

============================================================
21 — GIT STRATEGY
============================================================

The project has NOT yet been committed into final Tailwind milestones.

Do NOT commit automatically.

Do NOT push automatically.

Milestone commits will be created later after visual migration is
fully stable.

Potential future milestones:

feat: add Tailwind CSS foundation
refactor: migrate shared components to Tailwind
refactor: migrate page components to Tailwind
refactor: remove legacy CSS
chore: complete Tailwind migration QA

But DO NOT create them yet.

============================================================
22 — WORKING METHOD
============================================================

AI MUST act as implementation engineer.

Before each step:

1. Inspect current code.
2. Understand locked baseline.
3. Make only scoped changes.
4. Run build.
5. Run JS syntax validation.
6. Render actual browser output.
7. Report exact changes.
8. Wait for human review before proceeding.

Do NOT declare visual PASS based only on source inspection.

Actual rendered screenshots are the source of truth.

============================================================
23 — CURRENT NEXT ACTION
============================================================

NEXT:

TASK 07 — STEP 02
HOMEPAGE + DISCOVERY RAIL VISUAL REFINEMENT

Focus:

- hero vertical proportion
- category rail
- discovery rail
- restaurant card width
- restaurant card height
- image ratio
- scrollbar treatment
- section spacing
- placeholder treatment
- responsive homepage layout

Do NOT modify other pages unless a shared CSS rule directly causes
a regression.

Do NOT modify JavaScript.

Do NOT modify restaurant data.

Do NOT introduce API/backend.

============================================================
24 — IMPORTANT WARNING ABOUT PREVIOUS AI OUTPUT
============================================================

Previous AI agents sometimes reported PASS even when actual screenshots
still showed visual problems.

Therefore:

Never trust a PASS report without rendered visual verification.

Never declare the visual migration complete solely because:

- build passes
- JS syntax passes
- CSS selectors exist
- automated overflow checks pass

All of those are necessary but NOT sufficient.

============================================================
25 — HANDOFF RULE
============================================================

This document is the source of project context.

When starting a new AI conversation:

1. Read this document completely.
2. Inspect the current repository.
3. Confirm the current task/step.
4. Do not repeat already-locked work.
5. Do not redesign BiteMap.
6. Do not start API.
7. Continue from the current step.

# CHANGE LOG

## 2026-10-06

### Task 07 Step 01
Status: PASS + LOCKED

Changes:
- Established Tailwind cascade layers.
- Wrapped legacy CSS in @layer legacy.
- Added subtle scrollbar foundation.
- JS untouched.

### Task 07 Step 02

Status: IMPLEMENTATION COMPLETE — PENDING HUMAN VISUAL REVIEW

Changes:
- Homepage hero refined.
- Discovery rails refined.
- Desktop target approximately 5 cards.
- Tablet responsive behavior refined.
- Mobile card sizing and spacing refined.
- Category rail refined.
- CTA refined.
- JS untouched.

Verification:
- Build PASS.
- JS syntax PASS.
- JS diff 0.
- 13 canonical restaurants intact.
- 3 default favorites intact.
### Task 07 Step 03
Status: PASS + LOCKED

Changes:
- Explore filter controls aligned to subtle border, rounded-full.
- Mobile filter arrangement stabilized at 390px.
- Tablet Explore grid configured to 3 balanced columns at 820px.
- JS untouched.

### Task 07 Step 04
Status: PASS + LOCKED

Changes:
- Warm editorial image fallback placeholders implemented on Restaurant Detail.
- Mobile action buttons balanced and comfortable.
- Mobile tab navigation horizontal scrolling row (`flex-nowrap`, `shrink-0`, no wrapping) fixed.
- JS untouched.

### Task 07 Step 05
Status: PASS + LOCKED

Changes:
- Reservation summary image placeholder updated to warm editorial treatment.
- Reservation ticket QR placeholder updated to warm editorial treatment.
- Reservation stepper mobile wrapping fixed (`flex-nowrap`, `overflow-x-auto`).
- Redundant inline ticket heading styles removed.
- JS untouched.

### Task 07 Step 06
Status: IMPLEMENTATION COMPLETE — PENDING HUMAN VISUAL REVIEW

Changes:
- Customer Dashboard (`pages/dashboard.html`): cleaned redundant inline styles, standardized upcoming card border to `border border-dark/15`, preserved canonical favorites & history rendering.
- Customer Login (`pages/login.html`): cleaned inline styles, standardized form controls and rounded-full primary submit button.
- Customer Register (`pages/register.html`): cleaned inline styles, standardized form controls and rounded-full primary submit button.
- Restaurant Staff Dashboard / Platform Admin Shell (`pages/admin.html`): fixed character encoding in meta description, cleaned redundant inline styles across layout, topbar, cards, and buttons.
- Tailwind CSS recompiled cleanly (103ms).
- Verified zero horizontal overflow (`scrollWidth === innerWidth`) across all viewports (390px, 820px, 1440px).
- JS untouched (0 diff on `js/main.js`).

END OF HANDOFF DOCUMENT