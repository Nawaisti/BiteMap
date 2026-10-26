<?php
/**
 * BiteMap — Culinary Quest Map-First Explore View (app/Views/explore/index.php)
 * Week 5 (Server-Side Filtering & Loops) + Week 6 (Domain Objects) + Week 7 (MVC View)
 * + Phase B/C/D (Map-First Split Explorer, Synchronized Markers/Cards & Culinary Quests)
 *
 * Expected view variables from ExploreController:
 *   @var string                 $pageTitle
 *   @var string                 $pageDescription
 *   @var string                 $basePath
 *   @var string                 $currentPage
 *   @var array<int, Restaurant> $restaurants
 *   @var int                    $restaurantCount
 *   @var array<string, mixed>   $filters
 *   @var array<int, Quest>      $quests
 */

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

$cardLinkBase = 'restaurant.php';
$cardAssetPrefix = '../';
$questLinkPrefix = '';

$qVal = (string) ($filters['q'] ?? '');
$locVal = (string) ($filters['loc'] ?? 'Malang');
$catVal = (string) ($filters['category'] ?? '');
$cuiVal = (string) ($filters['cuisine'] ?? '');
$distVal = (string) ($filters['distance'] ?? '');
$rateVal = (string) ($filters['rating'] ?? '');
$openNowVal = !empty($filters['open_now']);
$sortVal = (string) ($filters['sort'] ?? 'Recommended');

$hasActiveFilters = (
    $qVal !== '' ||
    ($catVal !== '' && strcasecmp($catVal, 'Category') !== 0) ||
    ($cuiVal !== '' && strcasecmp($cuiVal, 'Cuisine') !== 0) ||
    ($distVal !== '' && strcasecmp($distVal, 'Distance') !== 0) ||
    ($rateVal !== '' && strcasecmp($rateVal, 'Rating') !== 0) ||
    $openNowVal ||
    strcasecmp($sortVal, 'Recommended') !== 0
);

$categoryBadges = [
    ['label' => 'Asian Food', 'icon' => '&#127836;'],
    ['label' => 'Restaurant', 'icon' => '&#127869;'],
    ['label' => 'Fast Food', 'icon' => '&#127828;'],
    ['label' => 'Cafe & Coffee', 'icon' => '&#9749;'],
    ['label' => 'Local Food', 'icon' => '&#127835;'],
    ['label' => 'Jajanan', 'icon' => '&#127854;'],
    ['label' => 'Drinks', 'icon' => '&#127865;'],
    ['label' => 'Dessert & Bakery', 'icon' => '&#127856;'],
    ['label' => 'Healthy Food', 'icon' => '&#129367;'],
];
?>

  <!-- ===== MAIN CONTENT ===== -->
  <main id="main-content">

    <!-- 1: COMPACT MAP-FIRST EXPLORER HEADER & QUEST HUD -->
    <section class="page-header pt-4 pb-3 md:py-5 border-b border-dark/10 bg-white/60" aria-labelledby="explore-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-terracotta/10 text-terracotta text-[11px] font-bold uppercase tracking-wider mb-1">
              <span>&#128506;</span> Map-First Culinary Discovery
            </div>
            <h1 id="explore-heading" class="text-2xl sm:text-3xl font-bold tracking-tight text-dark leading-tight">
              Malang Culinary Quest Explorer
            </h1>
            <p class="text-xs sm:text-sm text-dark/65 mt-0.5">
              Select any marker on the map or restaurant card below to inspect verified menus, check operating hours, and advance your quests.
            </p>
          </div>

          <!-- Compact Player Progress Strip -->
          <div class="bg-white rounded-2xl border border-dark/12 p-3 shadow-2xs flex flex-wrap items-center gap-3 sm:gap-4 shrink-0" id="explore-player-hud">
            <div class="flex items-center gap-2.5">
              <div class="w-10 h-10 rounded-xl bg-terracotta text-white flex flex-col items-center justify-center font-bold leading-none shrink-0">
                <span class="text-[9px] uppercase opacity-80">Level</span>
                <span class="text-base" data-hud="level-num">1</span>
              </div>
              <div>
                <p class="text-xs font-bold text-dark leading-tight" data-hud="rank-title">Novice Taster</p>
                <p class="text-[11px] text-dark/65"><span data-hud="xp-text">0 XP</span> &bull; <span data-hud="next-level-text">150 XP to Lv. 2</span></p>
                <div class="w-32 h-1.5 rounded-full bg-dark/10 overflow-hidden mt-1">
                  <div class="h-full bg-terracotta transition-all duration-300" style="width: 0%;" data-hud="xp-bar"></div>
                </div>
              </div>
            </div>
            <div class="h-8 w-px bg-dark/10 hidden sm:block" aria-hidden="true"></div>
            <div class="flex items-center gap-2">
              <a href="#explore-quests-board" class="px-3 py-1.5 rounded-full bg-cream hover:bg-terracotta hover:text-white text-dark text-xs font-semibold transition-colors no-underline">
                &#127942; Quests (<span data-hud="quests-count">0/4</span>)
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 2: SEARCH, CATEGORIES, & FILTER BAR -->
    <section class="explore-controls py-3 sm:py-4 bg-cream border-b border-dark/10" aria-label="Search and filter options">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">

        <!-- Search Form + Category Chips Row -->
        <div class="flex flex-col lg:flex-row lg:items-center gap-3">
          <form action="explore.php" method="GET" class="search-bar flex flex-col sm:flex-row gap-2 w-full lg:max-w-[540px] shrink-0" role="search" aria-label="Restaurant search">
            <label for="explore-search" class="visually-hidden">What are you craving?</label>
            <input
              type="search"
              id="explore-search"
              name="q"
              value="<?= e($qVal) ?>"
              class="form-control search-input flex-[2] min-w-0 !py-2 !text-sm"
              placeholder="Search ramen, burger, coffee, Jl. Bandung..."
            />
            <label for="explore-location" class="visually-hidden">Location</label>
            <input
              type="text"
              id="explore-location"
              name="loc"
              class="form-control location-input flex-1 min-w-0 !py-2 !text-sm"
              placeholder="Malang"
              value="<?= e($locVal !== '' ? $locVal : 'Malang') ?>"
            />
            <button type="submit" class="btn btn-primary inline-flex items-center justify-center gap-1.5 py-2 px-5 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] transition-colors duration-200 whitespace-nowrap cursor-pointer w-full sm:w-auto">Search</button>
          </form>

          <!-- Discovery Category Chips -->
          <div class="content-rail flex gap-2 overflow-x-auto pb-1 min-h-auto flex-1">
            <?php foreach ($categoryBadges as $badge): ?>
              <?php
              $isActiveCat = strcasecmp($catVal, $badge['label']) === 0;
              $badgeHref = $isActiveCat ? 'explore.php' : ('explore.php?category=' . urlencode($badge['label']));
              $badgeClass = 'badge badge-neutral badge-category shrink-0' . ($isActiveCat ? ' is-active' : '');
              ?>
              <a href="<?= e($badgeHref) ?>" class="<?= e($badgeClass) ?>" <?= $isActiveCat ? 'aria-pressed="true"' : 'aria-pressed="false"' ?>>
                <span class="category-icon" aria-hidden="true"><?= $badge['icon'] ?></span> <?= e($badge['label']) ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Filter / Sort Controls -->
        <div class="filter-bar flex flex-col sm:flex-row gap-2.5 sm:items-center sm:justify-between mt-3 pt-3 border-t border-dark/[0.08]">
          <div class="filter-group-ui flex flex-wrap items-center gap-2 max-w-full" aria-label="Filter refinements">
            <select class="form-control !w-auto text-xs sm:text-sm py-1.5 px-3 shrink-0" aria-label="Category filter">
              <option <?= $catVal === '' || strcasecmp($catVal, 'Category') === 0 ? 'selected' : '' ?>>Category</option>
              <option <?= strcasecmp($catVal, 'Restaurant') === 0 ? 'selected' : '' ?>>Restaurant</option>
              <option <?= strcasecmp($catVal, 'Cafe & Coffee') === 0 ? 'selected' : '' ?>>Cafe &amp; Coffee</option>
              <option <?= strcasecmp($catVal, 'Asian Food') === 0 ? 'selected' : '' ?>>Asian Food</option>
              <option <?= strcasecmp($catVal, 'Local Food') === 0 ? 'selected' : '' ?>>Local Food</option>
              <option <?= strcasecmp($catVal, 'Fast Food') === 0 ? 'selected' : '' ?>>Fast Food</option>
            </select>
            <select class="form-control !w-auto text-xs sm:text-sm py-1.5 px-3 shrink-0" aria-label="Cuisine filter">
              <option <?= $cuiVal === '' || strcasecmp($cuiVal, 'Cuisine') === 0 ? 'selected' : '' ?>>Cuisine</option>
              <option <?= strcasecmp($cuiVal, 'Japanese') === 0 ? 'selected' : '' ?>>Japanese</option>
              <option <?= strcasecmp($cuiVal, 'American / Burger') === 0 ? 'selected' : '' ?>>American / Burger</option>
              <option <?= strcasecmp($cuiVal, 'Asian Fusion') === 0 ? 'selected' : '' ?>>Asian Fusion</option>
            </select>
            <select class="form-control !w-auto text-xs sm:text-sm py-1.5 px-3 shrink-0" aria-label="Distance filter">
              <option <?= $distVal === '' || strcasecmp($distVal, 'Distance') === 0 ? 'selected' : '' ?>>Distance</option>
              <option <?= $distVal === '1' || $distVal === '< 1 km' ? 'selected' : '' ?>>&lt; 1 km</option>
              <option <?= $distVal === '2' || $distVal === '< 2 km' ? 'selected' : '' ?>>&lt; 2 km</option>
              <option <?= $distVal === '5' || $distVal === '< 5 km' ? 'selected' : '' ?>>&lt; 5 km</option>
              <option <?= $distVal === '10' || $distVal === '< 10 km' ? 'selected' : '' ?>>&lt; 10 km</option>
            </select>
            <select class="form-control !w-auto text-xs sm:text-sm py-1.5 px-3 shrink-0" aria-label="Rating filter">
              <option <?= $rateVal === '' || strcasecmp($rateVal, 'Rating') === 0 ? 'selected' : '' ?>>Rating</option>
              <option <?= $rateVal === '4.5' || $rateVal === '4.5+' ? 'selected' : '' ?>>4.5+</option>
              <option <?= $rateVal === '4.0' || $rateVal === '4.0+' ? 'selected' : '' ?>>4.0+</option>
              <option <?= $rateVal === '3.5' || $rateVal === '3.5+' ? 'selected' : '' ?>>3.5+</option>
            </select>
            <button
              type="button"
              class="btn filter-btn-open-now inline-flex items-center justify-center py-1.5 px-3.5 border border-dark/20 rounded-full text-xs sm:text-sm font-medium text-dark bg-transparent hover:bg-dark/5 transition-colors duration-200 whitespace-nowrap cursor-pointer shrink-0<?= $openNowVal ? ' is-active' : '' ?>"
              aria-pressed="<?= $openNowVal ? 'true' : 'false' ?>"
            >Open Now</button>
            <button
              type="button"
              id="btn-clear-filters"
              class="inline-flex items-center justify-center py-1.5 px-3.5 border border-dark/15 rounded-full text-xs sm:text-sm font-medium text-dark/55 bg-transparent hover:text-dark hover:border-dark/30 transition-colors duration-200 whitespace-nowrap cursor-pointer shrink-0<?= $hasActiveFilters ? '' : ' hidden' ?>"
            >Clear filters</button>
          </div>
          <div class="filter-group-ui flex items-center justify-between sm:justify-start gap-2" aria-label="Sorting options">
            <label for="sort-results" class="text-xs sm:text-sm text-dark/55 whitespace-nowrap shrink-0">Sort by:</label>
            <select id="sort-results" class="form-control !w-auto text-xs sm:text-sm py-1.5 px-3">
              <option <?= strcasecmp($sortVal, 'Recommended') === 0 ? 'selected' : '' ?>>Recommended</option>
              <option <?= strcasecmp($sortVal, 'Rating') === 0 ? 'selected' : '' ?>>Rating</option>
              <option <?= strcasecmp($sortVal, 'Distance') === 0 ? 'selected' : '' ?>>Distance</option>
              <option <?= strcasecmp($sortVal, 'Name') === 0 ? 'selected' : '' ?>>Name</option>
            </select>
          </div>
        </div>

      </div>
    </section>

    <!-- 3: MAP-FIRST SPLIT WORKSPACE (Interactive Map + Synchronized Restaurant Results) -->
    <section class="restaurant-results py-5 md:py-8" aria-labelledby="results-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

          <!-- RIGHT COLUMN ON DESKTOP / TOP ON MOBILE: Interactive Discovery Map -->
          <div class="lg:col-span-7 lg:order-2 lg:sticky lg:top-[88px]">
            <div class="bg-white rounded-3xl border border-dark/12 shadow-[0_10px_32px_rgba(36,33,29,0.07)] overflow-hidden">

              <!-- Map Toolbar -->
              <div class="px-4 py-3 border-b border-dark/10 flex flex-wrap items-center justify-between gap-2 bg-cream/40">
                <div class="flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-[#6F8064]" aria-hidden="true"></span>
                  <span class="text-xs font-bold text-dark uppercase tracking-wider">Interactive Malang Quest Map</span>
                  <span class="text-[11px] text-dark/55 hidden sm:inline">&bull; Click any pin to sync card &amp; earn +25 XP</span>
                </div>
                <div class="flex items-center gap-2">
                  <button
                    type="button"
                    id="btn-reset-map-bounds"
                    class="px-2.5 py-1 rounded-full bg-white border border-dark/15 hover:border-terracotta text-dark hover:text-terracotta text-xs font-semibold cursor-pointer transition-colors"
                  >
                    &#128506; Fit All Markers
                  </button>
                </div>
              </div>

              <!-- Leaflet Map Canvas -->
              <div
                id="explore-discovery-map"
                class="w-full h-[340px] sm:h-[420px] lg:h-[480px] bg-[#EDE6D8] relative z-10 flex items-center justify-center"
                aria-label="Interactive Malang restaurant discovery map"
              >
                <span class="text-sm text-dark/60 font-medium">Loading interactive Malang map...</span>
              </div>

              <!-- Selected Restaurant Sync Inspector Drawer -->
              <div
                id="selected-marker-inspector"
                class="p-4 bg-white border-t border-dark/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3"
                aria-live="polite"
              >
                <div class="min-w-0">
                  <div class="flex items-center gap-2 mb-1">
                    <span class="px-2 py-0.5 rounded-full bg-terracotta/12 text-terracotta text-[10px] font-bold uppercase tracking-wider" data-inspector="badge">Selected Landmark</span>
                    <span class="text-[11px] font-semibold text-[#6F8064]" data-inspector="quest-tag">&#129517; Malang Culinary Scout</span>
                  </div>
                  <h3 class="text-base font-bold text-dark truncate" data-inspector="name">Okiru Ramen</h3>
                  <p class="text-xs text-dark/65 truncate" data-inspector="meta">Asian Food &bull; Jl. Soekarno Hatta No.DR 17, Lowokwaru</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                  <button
                    type="button"
                    class="btn-quest-checkin px-3 py-2 rounded-full bg-terracotta/12 hover:bg-terracotta text-terracotta hover:text-white text-xs font-semibold transition-colors cursor-pointer border border-terracotta/25"
                    data-inspector="checkin-btn"
                    data-checkin-restaurant="okiru-ramen"
                  >
                    &#10003; Check In (+25 XP)
                  </button>
                  <a
                    href="restaurant.php?id=okiru-ramen"
                    class="px-4 py-2 rounded-full bg-dark hover:bg-terracotta text-white text-xs font-semibold transition-colors no-underline"
                    data-inspector="detail-link"
                  >
                    Full Menu &rarr;
                  </a>
                </div>
              </div>

            </div>
          </div>

          <!-- LEFT COLUMN ON DESKTOP / BOTTOM ON MOBILE: Connected Restaurant Cards -->
          <div class="lg:col-span-5 lg:order-1">
            <header class="section-header flex items-center justify-between gap-4 mb-3">
              <h2 id="results-heading" class="text-base font-bold text-dark">Connected Landmarks</h2>
              <p id="results-count" class="text-meta text-muted text-xs font-semibold uppercase tracking-wider text-dark/65" aria-live="polite">
                <?= $restaurantCount === 1 ? '1 restaurant' : e((string) $restaurantCount) . ' restaurants' ?>
              </p>
            </header>

            <div
              class="restaurant-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4"
              <?= $restaurantCount === 0 ? 'style="display: none;"' : '' ?>
            >
              <?php foreach ($restaurants as $restaurant): ?>
                <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
              <?php endforeach; ?>
            </div>

            <!-- Pagination / Load More -->
            <div class="load-more-container hidden flex justify-center mt-8" style="display: none;" aria-hidden="true">
              <button type="button" class="btn btn-outline inline-flex items-center justify-center gap-2 py-2.5 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark bg-transparent hover:bg-dark hover:text-white transition-colors cursor-pointer">Lihat lebih banyak</button>
            </div>

            <!-- EMPTY STATE -->
            <div
              class="empty-state <?= $restaurantCount === 0 ? 'flex' : 'hidden' ?> flex-col items-center justify-center text-center py-12 px-4 gap-3 bg-white rounded-[20px] border border-dashed border-dark/15"
              style="display: <?= $restaurantCount === 0 ? 'flex' : 'none' ?>;"
              aria-hidden="<?= $restaurantCount === 0 ? 'false' : 'true' ?>"
            >
              <h3 class="empty-state-title text-lg font-semibold text-dark">No restaurants found</h3>
              <p class="empty-state-desc text-sm text-dark/65 max-w-[360px]">No Malang culinary landmarks match your current filter. Reset filters to restore all map pins.</p>
              <a href="explore.php" class="btn btn-outline inline-flex items-center justify-center gap-2 py-2.5 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark bg-transparent hover:bg-dark hover:text-white transition-colors cursor-pointer mt-2" id="btn-reset-filters">Clear all filters</a>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- 4: CULINARY QUESTS BOARD ON EXPLORE PAGE -->
    <section id="explore-quests-board" class="py-8 md:py-12 border-t border-dark/10 bg-white/50" aria-labelledby="explore-quests-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-6">
          <div>
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-terracotta/10 text-terracotta text-[11px] font-bold uppercase tracking-wider mb-1">&#127942; Active Missions</span>
            <h2 id="explore-quests-heading" class="text-2xl font-bold text-dark">Malang Culinary Quests</h2>
            <p class="text-xs sm:text-sm text-dark/65">Complete exploration objectives above to earn deterministic XP, level up, and unlock Malang culinary badges.</p>
          </div>
          <button
            type="button"
            class="btn-reset-quest-progress self-start sm:self-auto px-3.5 py-1.5 rounded-full border border-dark/20 hover:border-terracotta text-xs font-semibold text-dark/70 hover:text-terracotta bg-white cursor-pointer transition-colors"
          >
            &#8635; Reset Demo Progress
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <?php foreach ($quests as $quest): ?>
            <?php require dirname(__DIR__) . '/partials/quest-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

<?php
require dirname(__DIR__) . '/layouts/footer.php';
