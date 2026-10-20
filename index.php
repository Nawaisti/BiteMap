<?php
/**
 * BiteMap - Homepage
 * Sprint 04 PHP Server-Side Adaptation
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'BiteMap — Find your next favorite place.';
$pageDescription = 'BiteMap — Find your next favorite place. Discover, explore, and reserve at the best restaurants near you.';
$basePath = '';
$currentPage = 'home';

$allRestaurants = getRestaurants();
// Featured in Malang: up to 5 curated restaurants
$featuredRestaurants = array_slice($allRestaurants, 0, 5);

// Category rails
$cafeRestaurants = array_values(array_filter($allRestaurants, fn(Restaurant $r) => $r->getCategory() === 'Cafe & Coffee'));
$curatedRestaurants = $cafeRestaurants; // matches JS logic

require_once __DIR__ . '/includes/header.php';
?>

  <!-- ===== MAIN CONTENT ===== -->
  <main id="main-content">

    <!-- 1 & 2: HERO -->
    <section class="hero py-6 md:py-12" aria-labelledby="hero-heading">
      <div class="container hero-inner max-w-[1200px] mx-auto px-4 md:px-6 grid grid-cols-1 items-center gap-6 text-center py-0">
        <div class="hero-content max-w-[760px] mx-auto w-full">
          <h1 id="hero-heading" class="text-3xl sm:text-4xl lg:text-[48px] font-bold tracking-tight text-dark leading-tight">What are you craving?</h1>
          <p class="hero-subtitle text-lead text-muted text-base sm:text-xl text-dark/65 max-w-[620px] mx-auto mt-2">Discover the best places to eat, drink, and gather around you.</p>

          <form action="pages/explore.php" method="GET" class="search-bar flex flex-col sm:flex-row gap-2 w-full max-w-[720px] mx-auto mt-5 sm:mt-6 justify-center" role="search" aria-label="Restaurant discovery search">
            <label for="hero-search" class="visually-hidden">What are you craving?</label>
            <input
              type="search"
              id="hero-search"
              name="q"
              class="form-control search-input flex-[2] min-w-0" placeholder="Sushi, coffee, pasta..."
            />
            <label for="hero-location" class="visually-hidden">Location</label>
            <input
              type="text"
              id="hero-location"
              name="loc"
              value="Malang"
              class="form-control location-input flex-1 min-w-0"
              placeholder="Malang"
            />
            <button type="submit" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] focus-visible:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer w-full sm:w-auto">Discover</button>
          </form>
        </div>
      </div>
    </section>

    <!-- 3: DISCOVERY CATEGORIES -->
    <section class="discovery-categories py-3 md:py-5" aria-label="Browse by category">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <div class="content-rail flex gap-3 sm:gap-4 overflow-x-auto pb-2 min-h-auto">
          <a href="pages/explore.php?category=Jajanan" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127854;</span> Jajanan</a>
          <a href="pages/explore.php?category=Local%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127835;</span> Local Food</a>
          <a href="pages/explore.php?category=Asian%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127836;</span> Asian Food</a>
          <a href="pages/explore.php?category=Fast%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127828;</span> Fast Food</a>
          <a href="pages/explore.php?category=Restaurant" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127869;</span> Restaurant</a>
          <a href="pages/explore.php?category=Cafe%20%26%20Coffee" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#9749;</span> Cafe &amp; Coffee</a>
          <a href="pages/explore.php?category=Drinks" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127865;</span> Drinks</a>
          <a href="pages/explore.php?category=Dessert%20%26%20Bakery" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127856;</span> Dessert &amp; Bakery</a>
          <a href="pages/explore.php?category=Healthy%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#129367;</span> Healthy Food</a>
        </div>
      </div>
    </section>

    <!-- 4: FEATURED IN MALANG -->
    <section class="section-rail py-5 md:py-7" aria-labelledby="popular-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <header class="section-header flex flex-col sm:flex-row sm:items-end justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
          <div class="flex items-start justify-between gap-2 w-full sm:w-auto">
            <div>
              <h2 id="popular-heading" class="text-xl sm:text-2xl font-semibold text-dark mb-0.5 sm:mb-1">Featured in Malang</h2>
              <p id="popular-subtitle" class="text-xs sm:text-sm text-dark/65">Curated dining in the heart of Malang.</p>
            </div>
            <a href="pages/explore.php" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150 sm:hidden">Lihat semua &rarr;</a>
          </div>
          <div class="section-actions flex items-center justify-between sm:justify-start gap-4">
            <a href="pages/explore.php" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150 hidden sm:inline-block">Lihat semua &rarr;</a>
          </div>
        </header>
        <div class="content-rail flex gap-4 overflow-x-auto min-h-12">
          <?php if (empty($featuredRestaurants)): ?>
            <div class="rail-empty-state w-full py-8 px-4 text-center bg-white rounded-2xl border border-dashed border-dark/15 flex flex-col items-center justify-center gap-1.5" role="status">
              <p class="text-sm font-semibold text-dark">No places listed yet</p>
              <p class="text-xs text-dark/65">We are currently curating verified spots in this category.</p>
            </div>
          <?php else: ?>
            <?php foreach ($featuredRestaurants as $restaurant): ?>
              <?= $restaurant->renderCard('pages/restaurant.php', '') ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 5: CATEGORY DISCOVERY RAIL -->
    <section class="section-rail py-5 md:py-7" aria-labelledby="cafe-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <header class="section-header flex items-end justify-between gap-2 sm:gap-4 mb-4 sm:mb-6">
          <div>
            <h2 id="cafe-heading" class="text-xl sm:text-2xl font-semibold text-dark mb-0.5 sm:mb-1">Cafe &amp; Coffee</h2>
            <p class="text-xs sm:text-sm text-dark/65">Your next favorite spot to sit and sip.</p>
          </div>
          <a href="pages/explore.php" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150">Lihat semua &rarr;</a>
        </header>
        <div class="content-rail flex gap-4 overflow-x-auto min-h-12">
          <?php if (empty($cafeRestaurants)): ?>
            <div class="rail-empty-state w-full py-8 px-4 text-center bg-white rounded-2xl border border-dashed border-dark/15 flex flex-col items-center justify-center gap-1.5" role="status">
              <p class="text-sm font-semibold text-dark">No places listed yet</p>
              <p class="text-xs text-dark/65">We are currently curating verified spots in this category.</p>
            </div>
          <?php else: ?>
            <?php foreach ($cafeRestaurants as $restaurant): ?>
              <?= $restaurant->renderCard('pages/restaurant.php', '') ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 6: CURATED DISCOVERY RAIL -->
    <section class="section-rail py-5 md:py-7" aria-labelledby="curated-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <header class="section-header flex items-end justify-between gap-2 sm:gap-4 mb-4 sm:mb-6">
          <div>
            <h2 id="curated-heading" class="text-xl sm:text-2xl font-semibold text-dark mb-0.5 sm:mb-1">Good Places for Study</h2>
            <p class="text-xs sm:text-sm text-dark/65">Wi-Fi, good vibes, and great coffee.</p>
          </div>
          <a href="pages/explore.php" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150">Lihat semua &rarr;</a>
        </header>
        <div class="content-rail flex gap-4 overflow-x-auto min-h-12">
          <?php if (empty($curatedRestaurants)): ?>
            <div class="rail-empty-state w-full py-8 px-4 text-center bg-white rounded-2xl border border-dashed border-dark/15 flex flex-col items-center justify-center gap-1.5" role="status">
              <p class="text-sm font-semibold text-dark">No places listed yet</p>
              <p class="text-xs text-dark/65">We are currently curating verified spots in this category.</p>
            </div>
          <?php else: ?>
            <?php foreach ($curatedRestaurants as $restaurant): ?>
              <?= $restaurant->renderCard('pages/restaurant.php', '') ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 7: DISCOVERY CTA -->
    <section class="section-cta py-8 md:py-14 text-center" aria-labelledby="cta-heading">
      <div class="container cta-inner max-w-[1200px] mx-auto px-4 md:px-6 flex flex-col items-center gap-3 sm:gap-4">
        <h2 id="cta-heading" class="text-xl sm:text-2xl font-semibold text-dark">Still looking?</h2>
        <p class="cta-text text-lead text-muted text-base sm:text-xl text-dark/65 max-w-[500px]">Explore more places around you. Discover hundreds of hidden gems, cafes, and restaurants.</p>
        <a href="pages/explore.php" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] focus-visible:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer w-full sm:w-auto mt-1 sm:mt-0">Explore more places</a>
      </div>
    </section>

  </main>

<?php
require_once __DIR__ . '/includes/footer.php';
