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
    ['label' => 'Asian Food'],
    ['label' => 'Restaurant'],
    ['label' => 'Fast Food'],
    ['label' => 'Cafe & Coffee'],
    ['label' => 'Local Food'],
];
?>

  <!-- ===== MAIN CONTENT ===== -->
  <main id="main-content">

    <!-- 1: COMPACT EXPLORER HEADER -->
    <section class="page-header py-4 border-b border-dark/10 bg-white/60" aria-labelledby="explore-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
          <div>
            <h1 id="explore-heading" class="text-xl sm:text-2xl font-bold tracking-tight text-dark">
              Malang Map Explorer
            </h1>
            <p class="text-xs text-dark/60">
              Select a marker or restaurant card to view details and track culinary quests.
            </p>
          </div>

          <!-- Non-Redundant Quest Progress Indicator (Complements Header Lv./XP Pill) -->
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border border-dark/10 text-xs self-start sm:self-auto shrink-0" id="explore-player-hud">
            <span class="font-medium text-dark" data-hud="rank-title">Novice Taster</span>
            <span class="text-dark/25" aria-hidden="true">&middot;</span>
            <a href="#explore-quests-board" class="text-terracotta hover:underline font-medium no-underline">
              <span data-hud="quests-count">0/4</span> quests completed
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- 2: SEARCH & ESSENTIAL FILTERS -->
    <section class="explore-controls py-3.5 bg-cream border-b border-dark/10" aria-label="Search and filter options">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">

        <!-- Search Form + Essential Category Filters -->
        <div class="flex flex-col lg:flex-row lg:items-center gap-3">
          <form action="explore.php" method="GET" class="search-bar flex flex-col sm:flex-row gap-2 w-full lg:max-w-[520px] shrink-0 !mt-0" role="search" aria-label="Restaurant search">
            <label for="explore-search" class="visually-hidden">Search restaurants or dishes</label>
            <input
              type="search"
              id="explore-search"
              name="q"
              value="<?= e($qVal) ?>"
              class="form-control search-input flex-[2] min-w-0 !py-1.5 !text-sm"
              placeholder="Search ramen, burger, coffee..."
            />
            <label for="explore-location" class="visually-hidden">Location</label>
            <input
              type="text"
              id="explore-location"
              name="loc"
              class="form-control location-input flex-1 min-w-0 !py-1.5 !text-sm"
              placeholder="Malang"
              value="<?= e($locVal !== '' ? $locVal : 'Malang') ?>"
            />
            <button type="submit" class="btn btn-primary inline-flex items-center justify-center py-1.5 px-4 border-2 border-terracotta rounded-full text-xs sm:text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] transition-colors whitespace-nowrap cursor-pointer w-full sm:w-auto">Search</button>
          </form>

          <!-- Essential Category Pills -->
          <div class="content-rail flex gap-1.5 overflow-x-auto pb-0.5 min-h-auto flex-1">
            <?php foreach ($categoryBadges as $badge): ?>
              <?php
              $isActiveCat = strcasecmp($catVal, $badge['label']) === 0;
              $badgeHref = $isActiveCat ? 'explore.php' : ('explore.php?category=' . urlencode($badge['label']));
              $badgeClass = 'badge badge-neutral badge-category !py-1.5 !px-3 !text-xs shrink-0' . ($isActiveCat ? ' is-active' : '');
              ?>
              <a href="<?= e($badgeHref) ?>" class="<?= e($badgeClass) ?>" <?= $isActiveCat ? 'aria-pressed="true"' : 'aria-pressed="false"' ?>>
                <?= e($badge['label']) ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Secondary Filter / Sort Controls -->
        <div class="filter-bar flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between !mt-2.5 !pt-2.5 border-t border-dark/[0.08]">
          <div class="filter-group-ui flex flex-wrap items-center gap-1.5 max-w-full" aria-label="Filter refinements">
            <select class="form-control !w-auto text-xs py-1 px-2.5 shrink-0" aria-label="Category filter">
              <option <?= $catVal === '' || strcasecmp($catVal, 'Category') === 0 ? 'selected' : '' ?>>Category</option>
              <option <?= strcasecmp($catVal, 'Restaurant') === 0 ? 'selected' : '' ?>>Restaurant</option>
              <option <?= strcasecmp($catVal, 'Cafe & Coffee') === 0 ? 'selected' : '' ?>>Cafe &amp; Coffee</option>
              <option <?= strcasecmp($catVal, 'Asian Food') === 0 ? 'selected' : '' ?>>Asian Food</option>
              <option <?= strcasecmp($catVal, 'Local Food') === 0 ? 'selected' : '' ?>>Local Food</option>
              <option <?= strcasecmp($catVal, 'Fast Food') === 0 ? 'selected' : '' ?>>Fast Food</option>
            </select>
            <select class="form-control !w-auto text-xs py-1 px-2.5 shrink-0" aria-label="Cuisine filter">
              <option <?= $cuiVal === '' || strcasecmp($cuiVal, 'Cuisine') === 0 ? 'selected' : '' ?>>Cuisine</option>
              <option <?= strcasecmp($cuiVal, 'Japanese') === 0 ? 'selected' : '' ?>>Japanese</option>
              <option <?= strcasecmp($cuiVal, 'American / Burger') === 0 ? 'selected' : '' ?>>American / Burger</option>
              <option <?= strcasecmp($cuiVal, 'Asian Fusion') === 0 ? 'selected' : '' ?>>Asian Fusion</option>
            </select>
            <select class="form-control !w-auto text-xs py-1 px-2.5 shrink-0" aria-label="Distance filter">
              <option <?= $distVal === '' || strcasecmp($distVal, 'Distance') === 0 ? 'selected' : '' ?>>Distance</option>
              <option <?= $distVal === '1' || $distVal === '< 1 km' ? 'selected' : '' ?>>&lt; 1 km</option>
              <option <?= $distVal === '2' || $distVal === '< 2 km' ? 'selected' : '' ?>>&lt; 2 km</option>
              <option <?= $distVal === '5' || $distVal === '< 5 km' ? 'selected' : '' ?>>&lt; 5 km</option>
              <option <?= $distVal === '10' || $distVal === '< 10 km' ? 'selected' : '' ?>>&lt; 10 km</option>
            </select>
            <select class="form-control !w-auto text-xs py-1 px-2.5 shrink-0" aria-label="Rating filter">
              <option <?= $rateVal === '' || strcasecmp($rateVal, 'Rating') === 0 ? 'selected' : '' ?>>Rating</option>
              <option <?= $rateVal === '4.5' || $rateVal === '4.5+' ? 'selected' : '' ?>>4.5+</option>
              <option <?= $rateVal === '4.0' || $rateVal === '4.0+' ? 'selected' : '' ?>>4.0+</option>
              <option <?= $rateVal === '3.5' || $rateVal === '3.5+' ? 'selected' : '' ?>>3.5+</option>
            </select>
            <button
              type="button"
              class="btn filter-btn-open-now inline-flex items-center justify-center py-1 px-3 border border-dark/20 rounded-full text-xs font-medium text-dark bg-transparent hover:bg-dark/5 transition-colors whitespace-nowrap cursor-pointer shrink-0<?= $openNowVal ? ' is-active' : '' ?>"
              aria-pressed="<?= $openNowVal ? 'true' : 'false' ?>"
            >Open Now</button>
            <button
              type="button"
              id="btn-clear-filters"
              class="inline-flex items-center justify-center py-1 px-3 border border-dark/15 rounded-full text-xs font-medium text-dark/55 bg-transparent hover:text-dark hover:border-dark/30 transition-colors whitespace-nowrap cursor-pointer shrink-0<?= $hasActiveFilters ? '' : ' hidden' ?>"
            >Clear</button>
          </div>
          <div class="filter-group-ui flex items-center justify-between sm:justify-start gap-2" aria-label="Sorting options">
            <label for="sort-results" class="text-xs text-dark/55 whitespace-nowrap shrink-0">Sort:</label>
            <select id="sort-results" class="form-control !w-auto text-xs py-1 px-2.5">
              <option <?= strcasecmp($sortVal, 'Recommended') === 0 ? 'selected' : '' ?>>Recommended</option>
              <option <?= strcasecmp($sortVal, 'Rating') === 0 ? 'selected' : '' ?>>Rating</option>
              <option <?= strcasecmp($sortVal, 'Distance') === 0 ? 'selected' : '' ?>>Distance</option>
              <option <?= strcasecmp($sortVal, 'Name') === 0 ? 'selected' : '' ?>>Name</option>
            </select>
          </div>
        </div>

      </div>
    </section>

    <!-- 3: MAP-FIRST SPLIT WORKSPACE -->
    <section class="restaurant-results py-5 md:py-7" aria-labelledby="results-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

          <!-- PRIMARY SURFACE (Right on Desktop / Top on Mobile): Interactive Map & Selected Restaurant -->
          <div class="lg:col-span-7 lg:order-2 lg:sticky lg:top-[80px]">
            <div class="bg-[#24211D] rounded-2xl border border-dark/20 shadow-md overflow-hidden text-cream">

              <!-- Atlas Toolbar -->
              <div class="px-4 py-2.5 bg-[#24211D] border-b border-cream/10 flex items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                  <span class="w-2 h-2 rounded-full bg-terracotta" aria-hidden="true"></span>
                  <span class="text-xs font-semibold tracking-wider uppercase text-cream/80">Malang Map &middot; Klojen</span>
                </div>
                <button
                  type="button"
                  id="btn-reset-map-bounds"
                  class="text-xs font-medium text-cream/65 hover:text-cream bg-transparent border-0 p-0 cursor-pointer transition-colors"
                >
                  Reset View
                </button>
              </div>

              <!-- Leaflet Map Canvas -->
              <div
                id="explore-discovery-map"
                class="w-full h-[260px] sm:h-[380px] lg:h-[450px] bg-[#EDE6D8] relative z-10 flex items-center justify-center"
                aria-label="Interactive Malang restaurant discovery map"
              >
                <span class="text-xs text-dark/55 font-medium">Loading interactive atlas...</span>
              </div>

              <!-- Concise Selected Restaurant Summary (Dark Docked Atlas Panel) -->
              <div
                id="selected-marker-inspector"
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
                    href="restaurant.php?id=okiru-ramen"
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

          <!-- SECONDARY SURFACE (Left on Desktop / Below Map on Mobile): Restaurant Cards -->
          <div class="lg:col-span-5 lg:order-1">
            <header class="section-header flex items-center justify-between gap-4 mb-3">
              <h2 id="results-heading" class="text-sm font-semibold text-dark">Restaurants</h2>
              <p id="results-count" class="text-meta text-muted text-xs font-medium text-dark/60" aria-live="polite">
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
            <div class="load-more-container hidden flex justify-center mt-6" style="display: none;" aria-hidden="true">
              <button type="button" class="btn btn-outline inline-flex items-center justify-center gap-2 py-2 px-5 border border-dark/25 rounded-full text-xs font-semibold text-dark bg-transparent hover:bg-dark hover:text-white transition-colors cursor-pointer">Load more</button>
            </div>

            <!-- EMPTY STATE -->
            <div
              class="empty-state <?= $restaurantCount === 0 ? 'flex' : 'hidden' ?> flex-col items-center justify-center text-center py-10 px-4 gap-2.5 bg-white rounded-xl border border-dashed border-dark/15"
              style="display: <?= $restaurantCount === 0 ? 'flex' : 'none' ?>;"
              aria-hidden="<?= $restaurantCount === 0 ? 'false' : 'true' ?>"
            >
              <h3 class="empty-state-title text-base font-semibold text-dark">No restaurants found</h3>
              <p class="empty-state-desc text-xs text-dark/60 max-w-[320px]">No restaurants match your current filters.</p>
              <a href="explore.php" class="btn btn-outline inline-flex items-center justify-center py-2 px-4 border border-dark/25 rounded-full text-xs font-semibold text-dark bg-transparent hover:bg-dark hover:text-white transition-colors cursor-pointer mt-1" id="btn-reset-filters">Clear filters</a>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- 4: TERTIARY SURFACE: CULINARY QUESTS & TRAILS -->
    <section id="explore-quests-board" class="py-10 md:py-12 border-t border-dark/20 bg-[#24211D] text-cream" aria-labelledby="explore-quests-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="flex items-baseline justify-between gap-3 mb-5">
          <div>
            <span class="inline-block text-[11px] font-bold text-terracotta tracking-[0.14em] uppercase mb-1">Curated Trails</span>
            <h2 id="explore-quests-heading" class="text-lg sm:text-xl font-bold text-cream">Culinary Quests</h2>
            <p class="text-xs text-cream/65 mt-0.5">Complete exploration objectives to earn XP and unlock badges.</p>
          </div>
          <button
            type="button"
            class="btn-reset-quest-progress text-xs font-medium text-cream/50 hover:text-terracotta bg-transparent border-0 p-0 cursor-pointer transition-colors shrink-0"
          >
            Reset progress
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <?php foreach ($quests as $quest): ?>
            <?php require dirname(__DIR__) . '/partials/quest-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

<?php
require dirname(__DIR__) . '/layouts/footer.php';
