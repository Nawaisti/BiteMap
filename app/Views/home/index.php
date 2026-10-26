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

    <!-- 1: MAP-FIRST DISCOVERY HERO -->
    <section class="hero relative py-6 md:py-10 border-b border-dark/10" aria-labelledby="hero-heading">
      <div class="container hero-inner max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

          <!-- Left Column (5 cols): Headline, Search, Filters, Compact Progress -->
          <div class="hero-content lg:col-span-5 flex flex-col items-start text-left">

            <h1 id="hero-heading" class="text-2xl sm:text-3xl lg:text-[34px] font-bold tracking-tight text-dark leading-[1.2] mb-2.5">
              Discover Malang's Culinary Spots
            </h1>

            <p class="hero-subtitle text-dark/65 text-sm leading-relaxed mb-5">
              Explore verified local restaurants on the interactive map, browse menus, and complete culinary quests around the city.
            </p>

            <!-- Search Form -->
            <form action="pages/explore.php" method="GET" class="hero-search-wrapper w-full bg-white rounded-xl sm:rounded-full border border-dark/15 p-1.5 flex flex-col sm:flex-row items-stretch sm:items-center gap-1.5 mb-3.5 focus-within:border-terracotta" role="search" aria-label="Restaurant discovery search">
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
                Search Map
              </button>
            </form>

            <!-- Essential Map Category Filters -->
            <div class="hero-quick-tags flex flex-wrap items-center gap-1.5 mb-5 text-xs">
              <button type="button" class="btn-home-map-filter is-active px-3 py-1 rounded-full bg-dark text-white border border-dark text-xs font-medium cursor-pointer transition-colors" data-map-category="all">All</button>
              <button type="button" class="btn-home-map-filter px-3 py-1 rounded-full bg-white hover:border-dark/30 text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Asian Food">Asian Food</button>
              <button type="button" class="btn-home-map-filter px-3 py-1 rounded-full bg-white hover:border-dark/30 text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Restaurant">Restaurant</button>
              <button type="button" class="btn-home-map-filter px-3 py-1 rounded-full bg-white hover:border-dark/30 text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Fast Food">Fast Food</button>
            </div>

            <!-- Compact Player Progress Summary -->
            <div class="w-full bg-white/80 rounded-xl border border-dark/10 p-3.5" id="home-player-hud">
              <div class="flex items-center justify-between gap-2 mb-2">
                <div class="flex items-center gap-2 text-xs">
                  <span class="font-semibold text-dark">Level <span data-hud="level-num">1</span></span>
                  <span class="text-dark/30" aria-hidden="true">&middot;</span>
                  <span class="text-dark/70 font-medium" data-hud="rank-title">Novice Taster</span>
                </div>
                <div class="flex items-center gap-2.5">
                  <span class="text-xs font-semibold text-terracotta" data-hud="xp-text">0 XP</span>
                  <button
                    type="button"
                    class="btn-reset-quest-progress text-[11px] font-medium text-dark/45 hover:text-terracotta bg-transparent border-0 p-0 cursor-pointer transition-colors"
                    title="Reset demo progress"
                  >
                    Reset
                  </button>
                </div>
              </div>

              <div class="w-full h-1.5 rounded-full bg-dark/8 overflow-hidden mb-2">
                <div class="h-full bg-terracotta transition-all duration-300 rounded-full" style="width: 0%;" data-hud="xp-bar"></div>
              </div>

              <div class="flex items-center justify-between gap-2 text-[11px] text-dark/55">
                <span data-hud="next-level-text">150 XP needed for Level 2 (Street Scout)</span>
                <span class="shrink-0">
                  <strong class="font-semibold text-dark/75" data-hud="quests-count">0/4</strong> quests &middot;
                  <strong class="font-semibold text-dark/75" data-hud="badges-count">0/4</strong> badges
                </span>
              </div>
            </div>

          </div>

          <!-- Right Column (7 cols): Primary Interactive Restaurant Map -->
          <div class="hero-visual lg:col-span-7 w-full">
            <div class="bg-white rounded-2xl border border-dark/12 shadow-sm overflow-hidden">

              <!-- Minimal Map Header Bar -->
              <div class="px-4 py-2.5 border-b border-dark/8 flex items-center justify-between gap-2">
                <span class="text-xs font-medium text-dark/70">Malang Discovery Map</span>
                <div class="flex items-center gap-3">
                  <button
                    type="button"
                    id="btn-home-reset-map"
                    class="text-xs font-medium text-dark/65 hover:text-dark bg-transparent border-0 p-0 cursor-pointer transition-colors"
                  >
                    Reset View
                  </button>
                  <a href="pages/explore.php" class="text-xs font-semibold text-terracotta hover:underline no-underline">
                    Full Map &rarr;
                  </a>
                </div>
              </div>

              <!-- Interactive Leaflet Map Container -->
              <div
                id="home-discovery-map"
                class="w-full h-[280px] sm:h-[360px] lg:h-[400px] bg-[#EDE6D8] relative z-10 flex items-center justify-center"
                aria-label="Interactive Malang Restaurant Map"
              >
                <span class="text-xs text-dark/55 font-medium">Loading interactive map...</span>
              </div>

              <!-- Concise Selected Restaurant Bar -->
              <div
                id="home-selected-inspector"
                class="px-4 py-3 bg-white border-t border-dark/8 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5"
                aria-live="polite"
              >
                <div class="min-w-0">
                  <div class="flex items-center gap-2">
                    <h3 class="text-sm font-semibold text-dark truncate" data-inspector="name">Okiru Ramen</h3>
                    <span class="text-[11px] text-dark/50 shrink-0" data-inspector="quest-tag"></span>
                  </div>
                  <p class="text-xs text-dark/60 truncate" data-inspector="meta">Asian Food &middot; Jl. Soekarno Hatta No.DR 17, Lowokwaru</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                  <button
                    type="button"
                    class="btn-quest-checkin px-3 py-1.5 rounded-full bg-dark/[0.04] hover:bg-terracotta text-dark/80 hover:text-white text-xs font-medium transition-colors cursor-pointer border border-dark/12 hover:border-terracotta"
                    data-inspector="checkin-btn"
                    data-checkin-restaurant="okiru-ramen"
                  >
                    Check In &middot; +25 XP
                  </button>
                  <a
                    href="pages/restaurant.php?id=okiru-ramen"
                    class="px-3.5 py-1.5 rounded-full bg-dark hover:bg-terracotta text-white text-xs font-medium transition-colors no-underline"
                    data-inspector="detail-link"
                  >
                    View Details
                  </a>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- 2: FEATURED RESTAURANTS -->
    <section class="py-8 md:py-10 border-b border-dark/10" aria-labelledby="popular-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-5">
          <div>
            <h2 id="popular-heading" class="text-xl sm:text-2xl font-semibold text-dark">Featured Malang Restaurants</h2>
            <p id="popular-subtitle" class="text-xs sm:text-sm text-dark/60">Select a restaurant to focus its location on the map or view its menu.</p>
          </div>
          <a href="pages/explore.php" class="text-xs sm:text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:underline no-underline">View all in Map Explorer &rarr;</a>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
          <?php foreach ($featuredRestaurants as $restaurant): ?>
            <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 3: CULINARY QUESTS -->
    <section id="quests-section" class="py-8 md:py-10 bg-white/50 border-b border-dark/10" aria-labelledby="quests-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-5">
          <div>
            <h2 id="quests-heading" class="text-xl sm:text-2xl font-semibold text-dark">Culinary Quests</h2>
            <p class="text-xs sm:text-sm text-dark/60 mt-0.5">
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

    <!-- 4: ACHIEVEMENT BADGES (Supporting Section) -->
    <section id="badges-section" class="py-8 md:py-10" aria-labelledby="badges-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex items-baseline justify-between gap-3 mb-4">
          <div>
            <h2 id="badges-heading" class="text-lg sm:text-xl font-semibold text-dark">Achievement Badges</h2>
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
              class="badge-showcase-card bg-white rounded-xl border border-dark/10 p-3.5 flex items-center gap-3 opacity-60 transition-opacity duration-200"
              data-badge-card="<?= e($badge['id']) ?>"
            >
              <div class="w-10 h-10 rounded-lg bg-cream/80 border border-dark/8 flex items-center justify-center text-lg shrink-0">
                <?= e($badge['icon']) ?>
              </div>
              <div class="min-w-0 flex-1">
                <div class="flex items-center justify-between gap-1.5">
                  <h3 class="text-xs font-semibold text-dark truncate"><?= e($badge['name']) ?></h3>
                  <span
                    class="text-[10px] font-medium text-dark/50 shrink-0"
                    data-badge-status="<?= e($badge['id']) ?>"
                  >Locked</span>
                </div>
                <p class="text-[11px] text-dark/60 truncate mt-0.5"><?= e($badge['description']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

<?php
require dirname(__DIR__) . '/layouts/footer.php';
