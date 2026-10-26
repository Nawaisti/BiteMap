<?php
/**
 * BiteMap — Culinary Quest Homepage View (app/Views/home/index.php)
 * Week 5 (Procedural Loops & Conditionals) + Week 6 (Restaurant & Quest Objects) + Week 7 (MVC View)
 * + Phase B/C/D (Map-First Hero, Culinary Quests Board, XP/Levels & Badges Showcase)
 *
 * Expected view variables from HomeController:
 *   @var string                 $pageTitle
 *   @var string                 $pageDescription
 *   @var string                 $basePath
 *   @var string                 $currentPage
 *   @var array<int, Restaurant> $featuredRestaurants
 *   @var array<int, Restaurant> $asianRestaurants
 *   @var array<int, Restaurant> $quickRestaurants
 *   @var array<int, Quest>      $quests
 */

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

$cardLinkBase = 'pages/restaurant.php';
$cardAssetPrefix = '';
$questLinkPrefix = 'pages/';
?>

  <!-- ===== MAIN CONTENT ===== -->
  <main id="main-content">

    <!-- 1: MAP-FIRST DISCOVERY HERO (CULINARY ATLAS) -->
    <section class="hero relative pt-5 pb-4 md:pt-8 md:pb-6" aria-labelledby="hero-heading">
      <div class="container hero-inner max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-8 items-start">

          <!-- Left Column (5 cols): Headline, Search, Filters, Compact Quest Progress -->
          <div class="hero-content lg:col-span-5 flex flex-col items-start text-left">

            <span class="inline-block text-[11px] font-bold text-terracotta tracking-[0.14em] uppercase mb-1.5">Malang Culinary Atlas</span>

            <h1 id="hero-heading" class="text-3xl sm:text-4xl lg:text-[42px] font-bold tracking-tight text-dark leading-[1.15] mb-2.5">
              Explore Malang, One Bite at a Time.
            </h1>

            <p class="hero-subtitle text-dark/70 text-sm leading-relaxed mb-4">
              Discover Malang's Culinary Spots across an interactive map atlas. Follow curated tasting trails, explore legendary eateries, and collect passport stamps along your journey.
            </p>

            <!-- Search Form -->
            <form action="pages/explore.php" method="GET" class="hero-search-wrapper w-full bg-white rounded-xl sm:rounded-full border border-dark/15 p-1.5 flex flex-col sm:flex-row items-stretch sm:items-center gap-1.5 mb-3 focus-within:border-terracotta" role="search" aria-label="Restaurant discovery search">
              <div class="flex-1 min-w-0 flex items-center gap-2 px-3 py-1.5">
                <label for="hero-search" class="visually-hidden">Search Malang restaurants or dishes</label>
                <input
                  type="search"
                  id="hero-search"
                  name="q"
                  class="w-full bg-transparent text-sm text-dark placeholder:text-dark/45 focus:outline-none"
                  placeholder="Search ramen, fusion, burgers, coffee..."
                />
              </div>
              <input type="hidden" name="loc" value="Malang" />
              <button type="submit" class="btn btn-primary inline-flex items-center justify-center py-2 px-5 rounded-lg sm:rounded-full text-xs sm:text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] transition-colors whitespace-nowrap cursor-pointer shrink-0 w-full sm:w-auto">
                Search Atlas
              </button>
            </form>

            <!-- Essential Map Category Filters -->
            <div class="hero-quick-tags flex flex-wrap items-center gap-1.5 mb-4 text-xs">
              <button type="button" class="btn-home-map-filter is-active px-3 py-1 rounded-full bg-dark text-white border border-dark text-xs font-medium cursor-pointer transition-colors" data-map-category="all">All</button>
              <button type="button" class="btn-home-map-filter px-3 py-1 rounded-full bg-white hover:border-dark/30 text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Asian Food">Asian Food</button>
              <button type="button" class="btn-home-map-filter px-3 py-1 rounded-full bg-white hover:border-dark/30 text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Restaurant">Restaurant</button>
              <button type="button" class="btn-home-map-filter px-3 py-1 rounded-full bg-white hover:border-dark/30 text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Fast Food">Fast Food</button>
            </div>

            <!-- Non-Redundant Quest Progress Summary (Complements Header Lv./XP Pill) -->
            <div class="w-full bg-white/80 rounded-xl border border-dark/10 p-3.5" id="home-player-hud">
              <div class="flex items-center justify-between gap-2 mb-1.5 text-xs">
                <span class="font-semibold text-dark" data-hud="rank-title">Novice Taster</span>
                <div class="flex items-center gap-2.5 text-[11px] text-dark/65">
                  <span>
                    <strong class="font-semibold text-dark" data-hud="quests-count">0/4</strong> quests &middot;
                    <strong class="font-semibold text-dark" data-hud="badges-count">0/4</strong> badges
                  </span>
                  <button
                    type="button"
                    class="btn-reset-quest-progress text-[11px] font-medium text-dark/45 hover:text-terracotta bg-transparent border-0 p-0 cursor-pointer transition-colors"
                    title="Reset demo progress"
                  >
                    Reset
                  </button>
                </div>
              </div>

              <div class="w-full h-1.5 rounded-full bg-dark/8 overflow-hidden mb-1.5">
                <div class="h-full bg-terracotta transition-all duration-300 rounded-full" style="width: 0%;" data-hud="xp-bar"></div>
              </div>

              <div class="flex items-center justify-between gap-2 text-[11px] text-dark/55">
                <span data-hud="next-level-text">150 XP needed for Level 2 (Street Scout)</span>
                <a href="#quests-section" class="font-medium text-terracotta hover:underline no-underline shrink-0">View trails &darr;</a>
              </div>
            </div>

          </div>

          <!-- Right Column (7 cols): Primary Interactive Restaurant Map & Selected Inspector -->
          <div class="hero-visual lg:col-span-7 w-full">
            <div class="bg-[#24211D] rounded-2xl border border-dark/20 shadow-md overflow-hidden text-cream">

              <!-- Atlas Board Header Bar -->
              <div class="px-4 py-2.5 bg-[#24211D] border-b border-cream/10 flex items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                  <span class="w-2 h-2 rounded-full bg-terracotta" aria-hidden="true"></span>
                  <span class="text-xs font-semibold tracking-wider uppercase text-cream/80">The Culinary Atlas &middot; Klojen</span>
                </div>
                <div class="flex items-center gap-3">
                  <button
                    type="button"
                    id="btn-home-reset-map"
                    class="text-xs font-medium text-cream/65 hover:text-cream bg-transparent border-0 p-0 cursor-pointer transition-colors"
                  >
                    Reset View
                  </button>
                  <a href="pages/explore.php" class="text-xs font-semibold text-terracotta hover:underline no-underline">
                    Full Atlas &rarr;
                  </a>
                </div>
              </div>

              <!-- Interactive Leaflet Map Container -->
              <div
                id="home-discovery-map"
                class="w-full h-[260px] sm:h-[360px] lg:h-[400px] bg-[#EDE6D8] relative z-10 flex items-center justify-center"
                aria-label="Interactive Malang Restaurant Map"
              >
                <span class="text-xs text-dark/55 font-medium">Loading interactive atlas...</span>
              </div>

              <!-- Selected Restaurant Inspector Bar (Dark Docked Atlas Panel) -->
              <div
                id="home-selected-inspector"
                class="px-4 py-3.5 bg-[#24211D] border-t border-cream/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-cream"
                aria-live="polite"
              >
                <div class="min-w-0">
                  <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-[10px] font-bold text-terracotta uppercase tracking-wider" data-inspector="stop-label">STOP 01 &middot; KLOJEN</span>
                    <span class="text-[10px] text-cream/40" aria-hidden="true">&bull;</span>
                    <span class="text-[11px] text-cream/50" data-inspector="quest-tag"></span>
                  </div>
                  <h3 class="text-base font-semibold text-cream leading-snug" data-inspector="name">Okiru Ramen</h3>
                  <p class="text-xs text-cream/65 leading-snug mt-0.5" data-inspector="meta">Asian Food &middot; Jl. Bandung No. 5, Klojen</p>
                </div>
                <div class="grid grid-cols-2 sm:flex items-center gap-2 w-full sm:w-auto shrink-0">
                  <button
                    type="button"
                    class="btn-quest-checkin inline-flex items-center justify-center px-3 py-1.5 rounded-full bg-cream/10 hover:bg-terracotta text-cream text-xs font-medium transition-colors cursor-pointer border border-cream/15 hover:border-terracotta"
                    data-inspector="checkin-btn"
                    data-checkin-restaurant="okiru-ramen"
                  >
                    Check In &middot; +25 XP
                  </button>
                  <a
                    href="pages/restaurant.php?id=okiru-ramen"
                    class="inline-flex items-center justify-center px-3.5 py-1.5 rounded-full bg-terracotta hover:bg-[#B25132] text-white text-xs font-semibold transition-colors no-underline"
                    data-inspector="detail-link"
                  >
                    View Details
                  </a>
                  <button
                    type="button"
                    id="btn-inspector-next"
                    data-inspector="next-stop-btn"
                    class="col-span-2 sm:col-auto inline-flex items-center justify-center px-3 py-1.5 rounded-full bg-cream/10 hover:bg-cream/20 text-cream text-xs font-medium transition-colors cursor-pointer border border-cream/15"
                    title="Focus next stop along the trail"
                  >
                    Next Stop &rarr;
                  </button>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- 2: FEATURED RESTAURANTS (Continuous Discovery Surface Below Map) -->
    <section class="pt-2 pb-8 md:pt-4 md:pb-10 border-b border-dark/10" aria-labelledby="popular-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-1.5 mb-4">
          <div>
            <h2 id="popular-heading" class="text-lg sm:text-xl font-semibold text-dark">Featured Malang Restaurants</h2>
            <p id="popular-subtitle" class="text-xs text-dark/60">Select a restaurant card to focus its pin on the map above or view its full menu.</p>
          </div>
          <a href="pages/explore.php" class="text-xs font-medium text-terracotta whitespace-nowrap shrink-0 hover:underline no-underline">View all in Map Explorer &rarr;</a>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5">
          <?php foreach ($featuredRestaurants as $restaurant): ?>
            <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 3: CULINARY TRAILS & QUESTS (Dark Section) -->
    <section id="quests-section" class="py-10 md:py-14 bg-[#24211D] text-cream border-b border-dark/20" aria-labelledby="quests-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-6">
          <div>
            <span class="inline-block text-[11px] font-bold text-terracotta tracking-[0.14em] uppercase mb-1">Curated Trails</span>
            <h2 id="quests-heading" class="text-xl sm:text-2xl font-bold text-cream">Culinary Quests</h2>
            <p class="text-xs text-cream/65 mt-1 max-w-[65ch]">
              Complete exploration objectives around Malang to earn XP and unlock badges. Progress is self-reported and stored locally for this demo.
            </p>
          </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <?php foreach ($quests as $quest): ?>
            <?php require dirname(__DIR__) . '/partials/quest-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 4: ACHIEVEMENT BADGES (Explorer Passport Stamps) -->
    <section id="badges-section" class="py-10 md:py-12 bg-cream" aria-labelledby="badges-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex items-baseline justify-between gap-3 mb-5">
          <div>
            <span class="inline-block text-[11px] font-bold text-terracotta tracking-[0.14em] uppercase mb-1">Traveler Passport</span>
            <h2 id="badges-heading" class="text-lg sm:text-xl font-bold text-dark">Achievement Badges</h2>
            <p class="text-xs text-dark/60">Earned by completing culinary quests.</p>
          </div>
          <span class="text-xs font-medium text-dark/60 shrink-0">
            <strong class="font-semibold text-dark" data-hud="badges-count">0/4</strong> unlocked
          </span>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
          <?php foreach ($quests as $quest): ?>
            <?php $badge = $quest->getBadge(); ?>
            <div
              class="badge-showcase-card bg-white rounded-xl border border-dark/10 p-3.5 flex items-start gap-3 opacity-80 transition-opacity duration-200"
              data-badge-card="<?= e($badge['id']) ?>"
            >
              <div class="w-11 h-11 rounded-full border-2 border-dashed border-dark/25 bg-cream/80 flex items-center justify-center text-lg shrink-0 shadow-2xs" data-badge-icon-box="<?= e($badge['id']) ?>">
                <?= e($badge['icon']) ?>
              </div>
              <div class="min-w-0 flex-1">
                <div class="flex items-center justify-between gap-1.5">
                  <h3 class="text-xs font-semibold text-dark leading-snug"><?= e($badge['name']) ?></h3>
                  <span
                    class="text-[10px] font-medium text-dark/55 shrink-0"
                    data-badge-status="<?= e($badge['id']) ?>"
                  >Locked</span>
                </div>
                <p class="text-xs text-dark/70 leading-snug mt-0.5"><?= e($badge['description']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

<?php
require dirname(__DIR__) . '/layouts/footer.php';
