<?php
/**
 * BiteMap — Explore Restaurants View (app/Views/explore/index.php)
 * Week 5 (Server-Side Filtering & Loops) + Week 6 (Domain Objects) + Week 7 (MVC View)
 *
 * Expected view variables from ExploreController:
 *   @var string                 $pageTitle
 *   @var string                 $pageDescription
 *   @var string                 $basePath
 *   @var string                 $currentPage
 *   @var array<int, Restaurant> $restaurants
 *   @var int                    $restaurantCount
 *   @var array<string, mixed>   $filters
 */

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

$cardLinkBase = 'restaurant.php';
$cardAssetPrefix = '../';

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
    ['label' => 'Jajanan', 'icon' => '&#127854;'],
    ['label' => 'Local Food', 'icon' => '&#127835;'],
    ['label' => 'Asian Food', 'icon' => '&#127836;'],
    ['label' => 'Fast Food', 'icon' => '&#127828;'],
    ['label' => 'Restaurant', 'icon' => '&#127869;'],
    ['label' => 'Cafe & Coffee', 'icon' => '&#9749;'],
    ['label' => 'Drinks', 'icon' => '&#127865;'],
    ['label' => 'Dessert & Bakery', 'icon' => '&#127856;'],
    ['label' => 'Healthy Food', 'icon' => '&#129367;'],
];
?>

  <!-- ===== MAIN CONTENT ===== -->
  <main id="main-content">

    <!-- 2: PAGE HEADER -->
    <section class="page-header pt-5 pb-2 sm:pt-6 sm:pb-4 md:py-8" aria-labelledby="explore-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6 text-center">
        <h1 id="explore-heading" class="text-3xl sm:text-4xl lg:text-[40px] font-bold tracking-tight text-dark leading-tight">Explore restaurants</h1>
        <p class="text-lead text-muted text-lg sm:text-xl text-dark/65 max-w-[600px] mx-auto mt-2">Discover places based on category, cuisine, mood, or location.</p>
      </div>
    </section>

    <!-- 3 & 4 & 5: SEARCH, CATEGORIES, & FILTERS -->
    <section class="explore-controls pt-1 pb-3 sm:pt-2 sm:pb-6 md:pb-8" aria-label="Search and filter options">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">

        <!-- Search UI -->
        <form action="explore.php" method="GET" class="search-bar flex flex-col sm:flex-row gap-2 w-full max-w-[800px] mx-auto mt-2 sm:mt-4 md:mt-6 mb-4 sm:mb-8" role="search" aria-label="Restaurant search">
          <label for="explore-search" class="visually-hidden">What are you craving?</label>
          <input
            type="search"
            id="explore-search"
            name="q"
            value="<?= e($qVal) ?>"
            class="form-control search-input flex-[2] min-w-0"
            placeholder="Search restaurants, cuisines, or places..."
          />
          <label for="explore-location" class="visually-hidden">Location</label>
          <input
            type="text"
            id="explore-location"
            name="loc"
            class="form-control location-input flex-1 min-w-0"
            placeholder="Malang"
            value="<?= e($locVal !== '' ? $locVal : 'Malang') ?>"
          />
          <button type="submit" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] focus-visible:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer w-full sm:w-auto">Search</button>
        </form>

        <!-- Discovery Categories -->
        <div class="content-rail flex gap-3 sm:gap-4 overflow-x-auto pb-1 mb-4 sm:mb-6 min-h-auto">
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

        <!-- Filter / Sort Controls -->
        <div class="filter-bar flex flex-col sm:flex-row gap-2.5 sm:gap-3 sm:items-center sm:justify-between mt-3.5 pt-3.5 sm:mt-6 sm:pt-6 border-t border-dark/[0.08]">
          <div class="filter-group-ui flex flex-wrap items-center gap-2 sm:gap-2.5 max-w-full" aria-label="Filter refinements">
            <select class="form-control !w-auto text-sm py-2 px-3 shrink-0" aria-label="Category filter">
              <option <?= $catVal === '' || strcasecmp($catVal, 'Category') === 0 ? 'selected' : '' ?>>Category</option>
              <option <?= strcasecmp($catVal, 'Restaurant') === 0 ? 'selected' : '' ?>>Restaurant</option>
              <option <?= strcasecmp($catVal, 'Cafe & Coffee') === 0 ? 'selected' : '' ?>>Cafe &amp; Coffee</option>
              <option <?= strcasecmp($catVal, 'Asian Food') === 0 ? 'selected' : '' ?>>Asian Food</option>
              <option <?= strcasecmp($catVal, 'Local Food') === 0 ? 'selected' : '' ?>>Local Food</option>
              <option <?= strcasecmp($catVal, 'Fast Food') === 0 ? 'selected' : '' ?>>Fast Food</option>
            </select>
            <select class="form-control !w-auto text-sm py-2 px-3 shrink-0" aria-label="Cuisine filter">
              <option <?= $cuiVal === '' || strcasecmp($cuiVal, 'Cuisine') === 0 ? 'selected' : '' ?>>Cuisine</option>
              <option <?= strcasecmp($cuiVal, 'Japanese') === 0 ? 'selected' : '' ?>>Japanese</option>
              <option <?= strcasecmp($cuiVal, 'American / Burger') === 0 ? 'selected' : '' ?>>American / Burger</option>
              <option <?= strcasecmp($cuiVal, 'Asian Fusion') === 0 ? 'selected' : '' ?>>Asian Fusion</option>
            </select>
            <select class="form-control !w-auto text-sm py-2 px-3 shrink-0" aria-label="Distance filter">
              <option <?= $distVal === '' || strcasecmp($distVal, 'Distance') === 0 ? 'selected' : '' ?>>Distance</option>
              <option <?= $distVal === '1' || $distVal === '< 1 km' ? 'selected' : '' ?>>&lt; 1 km</option>
              <option <?= $distVal === '2' || $distVal === '< 2 km' ? 'selected' : '' ?>>&lt; 2 km</option>
              <option <?= $distVal === '5' || $distVal === '< 5 km' ? 'selected' : '' ?>>&lt; 5 km</option>
              <option <?= $distVal === '10' || $distVal === '< 10 km' ? 'selected' : '' ?>>&lt; 10 km</option>
            </select>
            <select class="form-control !w-auto text-sm py-2 px-3 shrink-0" aria-label="Rating filter">
              <option <?= $rateVal === '' || strcasecmp($rateVal, 'Rating') === 0 ? 'selected' : '' ?>>Rating</option>
              <option <?= $rateVal === '4.5' || $rateVal === '4.5+' ? 'selected' : '' ?>>4.5+</option>
              <option <?= $rateVal === '4.0' || $rateVal === '4.0+' ? 'selected' : '' ?>>4.0+</option>
              <option <?= $rateVal === '3.5' || $rateVal === '3.5+' ? 'selected' : '' ?>>3.5+</option>
            </select>
            <button
              type="button"
              class="btn filter-btn-open-now inline-flex items-center justify-center py-2 px-4 border border-dark/20 rounded-full text-sm font-medium text-dark bg-transparent hover:bg-dark/5 focus-visible:bg-dark/5 transition-colors duration-200 whitespace-nowrap cursor-pointer shrink-0<?= $openNowVal ? ' is-active' : '' ?>"
              aria-pressed="<?= $openNowVal ? 'true' : 'false' ?>"
            >Open Now</button>
            <button
              type="button"
              id="btn-clear-filters"
              class="inline-flex items-center justify-center py-2 px-4 border border-dark/15 rounded-full text-sm font-medium text-dark/55 bg-transparent hover:text-dark hover:border-dark/30 transition-colors duration-200 whitespace-nowrap cursor-pointer shrink-0<?= $hasActiveFilters ? '' : ' hidden' ?>"
            >Clear filters</button>
          </div>
          <div class="filter-group-ui flex items-center justify-between sm:justify-start gap-2 mt-0.5 sm:mt-0" aria-label="Sorting options">
            <label for="sort-results" class="text-sm text-dark/55 whitespace-nowrap shrink-0">Sort by:</label>
            <select id="sort-results" class="form-control !w-auto text-sm py-2 px-3">
              <option <?= strcasecmp($sortVal, 'Recommended') === 0 ? 'selected' : '' ?>>Recommended</option>
              <option <?= strcasecmp($sortVal, 'Rating') === 0 ? 'selected' : '' ?>>Rating</option>
              <option <?= strcasecmp($sortVal, 'Distance') === 0 ? 'selected' : '' ?>>Distance</option>
              <option <?= strcasecmp($sortVal, 'Name') === 0 ? 'selected' : '' ?>>Name</option>
            </select>
          </div>
        </div>

      </div>
    </section>

    <!-- 6 & 7: RESTAURANT RESULTS -->
    <section class="restaurant-results pt-2 pb-8 sm:py-8 md:py-12" aria-labelledby="results-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">

        <header class="section-header flex items-end justify-between gap-4 mb-3 sm:mb-6">
          <h2 id="results-heading" class="visually-hidden">Restaurant Results</h2>
          <p id="results-count" class="text-meta text-muted text-xs font-medium uppercase tracking-wider text-dark/65" aria-live="polite">
            <?= $restaurantCount === 1 ? '1 restaurant' : e((string) $restaurantCount) . ' restaurants' ?>
          </p>
        </header>

        <div
          class="restaurant-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6"
          <?= $restaurantCount === 0 ? 'style="display: none;"' : '' ?>
        >
          <?php foreach ($restaurants as $restaurant): ?>
            <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
          <?php endforeach; ?>
        </div>

        <!-- Pagination / Load More -->
        <div class="load-more-container hidden flex justify-center mt-12 md:mt-16" style="display: none;" aria-hidden="true">
          <button type="button" class="btn btn-outline inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark bg-transparent hover:bg-dark hover:text-white focus-visible:bg-dark focus-visible:text-white transition-colors duration-250 whitespace-nowrap cursor-pointer">Lihat lebih banyak</button>
        </div>

        <!-- 8: EMPTY STATE -->
        <div
          class="empty-state <?= $restaurantCount === 0 ? 'flex' : 'hidden' ?> flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15"
          style="display: <?= $restaurantCount === 0 ? 'flex' : 'none' ?>;"
          aria-hidden="<?= $restaurantCount === 0 ? 'false' : 'true' ?>"
        >
          <h3 class="empty-state-title text-lg font-semibold text-dark">No restaurants found</h3>
          <p class="empty-state-desc text-dark/65 max-w-[400px]">You can try another search or adjust your filters.</p>
          <a href="explore.php" class="btn btn-outline inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark bg-transparent hover:bg-dark hover:text-white focus-visible:bg-dark focus-visible:text-white transition-colors duration-250 whitespace-nowrap cursor-pointer mt-4" id="btn-reset-filters">Clear all filters</a>
        </div>

      </div>
    </section>

  </main>

<?php
require dirname(__DIR__) . '/layouts/footer.php';
