<?php
/**
 * BiteMap — Homepage View (app/Views/home/index.php)
 * Week 5 (Procedural Loops & Conditionals) + Week 6 (Domain Objects) + Week 7 (MVC View)
 *
 * Expected view variables from HomeController:
 *   @var string                 $pageTitle
 *   @var string                 $pageDescription
 *   @var string                 $basePath
 *   @var string                 $currentPage
 *   @var array<int, Restaurant> $featuredRestaurants
 *   @var array<int, Restaurant> $asianRestaurants
 *   @var array<int, Restaurant> $quickRestaurants
 */

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

$cardLinkBase = 'pages/restaurant.php';
$cardAssetPrefix = '';
?>

  <!-- ===== MAIN CONTENT ===== -->
  <main id="main-content">

    <!-- 1 & 2: HERO -->
    <section class="hero relative py-5 md:py-8 lg:py-10 overflow-hidden" aria-labelledby="hero-heading">
      <div class="container hero-inner max-w-[1200px] mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 md:gap-6 lg:gap-10 xl:gap-12 items-center">

          <!-- Left Column: Copy, Search, Craving Chips -->
          <div class="hero-content md:col-span-7 flex flex-col items-start text-left">

            <!-- Eyebrow Pill -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-terracotta/8 border border-terracotta/15 text-terracotta text-[11px] font-semibold uppercase tracking-wider mb-2.5">
              <span class="w-1.5 h-1.5 rounded-full bg-terracotta" aria-hidden="true"></span>
              Malang Culinary Discovery
            </div>

            <!-- Headline -->
            <h1 id="hero-heading" class="text-2xl sm:text-3xl md:text-[32px] lg:text-[36px] xl:text-[40px] font-bold tracking-tight text-dark leading-[1.22] max-w-[540px] mb-2 sm:mb-2.5">
              Find your next <span class="text-terracotta">favorite place</span> in Malang.
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtitle text-dark/70 text-sm sm:text-base leading-relaxed max-w-[480px] mb-4 sm:mb-5">
              Discover authentic ramen bars, artisan coffee roasteries, and late-night cravings &mdash; verified with official menus, real operating hours, and seamless table reservations.
            </p>

            <!-- Search Form -->
            <form action="pages/explore.php" method="GET" class="hero-search-wrapper w-full max-w-[540px] bg-white rounded-2xl sm:rounded-full border border-dark/12 shadow-[0_4px_20px_rgba(36,33,29,0.06)] p-1.5 flex flex-col sm:flex-row items-stretch sm:items-center gap-1 sm:gap-1.5 transition-all focus-within:border-terracotta/40 focus-within:shadow-[0_8px_24px_rgba(200,92,58,0.10)]" role="search" aria-label="Restaurant discovery search">
              <div class="flex-1 min-w-0 flex items-center gap-2.5 px-3 py-1.5">
                <span class="text-dark/35 text-sm shrink-0" aria-hidden="true">&#128269;</span>
                <label for="hero-search" class="visually-hidden">What are you craving?</label>
                <input
                  type="search"
                  id="hero-search"
                  name="q"
                  class="w-full bg-transparent text-sm text-dark placeholder:text-dark/45 focus:outline-none"
                  placeholder="Sushi, coffee, burger..."
                />
              </div>

              <div class="hidden sm:block w-px h-5 bg-dark/10 shrink-0" aria-hidden="true"></div>

              <div class="flex-none sm:w-28 flex items-center gap-1.5 px-3 py-1.5">
                <span class="text-terracotta text-sm shrink-0" aria-hidden="true">&#128205;</span>
                <label for="hero-location" class="visually-hidden">Location</label>
                <input
                  type="text"
                  id="hero-location"
                  name="loc"
                  value="Malang"
                  class="w-full bg-transparent text-sm font-medium text-dark placeholder:text-dark/45 focus:outline-none"
                  placeholder="Malang"
                />
              </div>

              <button type="submit" class="btn btn-primary inline-flex items-center justify-center py-2 px-5 rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] transition-colors duration-200 whitespace-nowrap cursor-pointer shadow-none shrink-0 w-full sm:w-auto">
                Discover
              </button>
            </form>

            <!-- Quick Craving Chips -->
            <div class="hero-quick-tags flex flex-wrap items-center gap-1.5 mt-3 text-xs">
              <span class="text-dark/45 font-medium mr-0.5">Popular:</span>
              <a href="pages/explore.php?q=Ramen" class="px-2.5 py-1 rounded-full bg-white border border-dark/10 hover:border-terracotta hover:text-terracotta text-dark/70 transition-colors font-medium shadow-2xs">&#127836; Ramen Bar</a>
              <a href="pages/explore.php?category=Restaurant" class="px-2.5 py-1 rounded-full bg-white border border-dark/10 hover:border-terracotta hover:text-terracotta text-dark/70 transition-colors font-medium shadow-2xs">&#10024; Asian Fusion</a>
              <a href="pages/explore.php?category=Fast%20Food" class="px-2.5 py-1 rounded-full bg-white border border-dark/10 hover:border-terracotta hover:text-terracotta text-dark/70 transition-colors font-medium shadow-2xs">&#127828; 24h Dining</a>
            </div>

            <!-- Trust Bar -->
            <div class="hero-trust-bar flex flex-wrap items-center gap-x-4 gap-y-1.5 mt-3.5 pt-2.5 border-t border-dark/8 text-[11px] sm:text-xs text-dark/60">
              <div class="inline-flex items-center gap-1.5 shrink-0">
                <span class="w-3.5 h-3.5 rounded-full bg-[#6F8064]/15 text-[#6F8064] flex items-center justify-center font-bold text-[9px]">&#10003;</span>
                <span>100% Verified Menus</span>
              </div>
              <div class="inline-flex items-center gap-1.5 shrink-0">
                <span class="w-3.5 h-3.5 rounded-full bg-[#6F8064]/15 text-[#6F8064] flex items-center justify-center font-bold text-[9px]">&#10003;</span>
                <span>Real Operating Hours</span>
              </div>
              <div class="inline-flex items-center gap-1.5 shrink-0">
                <span class="w-3.5 h-3.5 rounded-full bg-[#6F8064]/15 text-[#6F8064] flex items-center justify-center font-bold text-[9px]">&#10003;</span>
                <span>Direct Restaurant Contact</span>
              </div>
            </div>

          </div>

          <!-- Right Column: Warm Editorial Showcase Card -->
          <div class="hero-visual md:col-span-5 relative mt-4 md:mt-0 max-w-[420px] mx-auto md:max-w-none w-full md:pr-1 lg:pr-2">
            <div class="relative mx-auto">
              <!-- Decorative warm glow -->
              <div class="absolute -top-6 -right-6 w-52 h-52 bg-terracotta/8 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
              <div class="absolute -bottom-6 -left-6 w-44 h-44 bg-[#6F8064]/8 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

              <!-- Primary Hero Card (Dialoogi Signature) -->
              <div class="relative bg-white rounded-2xl sm:rounded-3xl p-2.5 sm:p-3 border border-dark/10 shadow-[0_12px_36px_rgba(36,33,29,0.07)] overflow-hidden transition-transform duration-300 hover:-translate-y-0.5">
                <a href="pages/restaurant.php?id=dialogi-signature-malang" class="block group text-inherit no-underline">
                  <div class="relative aspect-[4/3] rounded-xl sm:rounded-2xl overflow-hidden bg-[#EDE6D8]">
                    <img
                      src="assets/restaurants/dialogi-signature-malang/food/Food6.jpg"
                      alt="Dialoogi Signature Restaurant Malang signature dishes"
                      class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500 ease-out"
                      loading="eager"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-dark/85 via-dark/25 to-transparent"></div>

                    <!-- Floating badge top-left -->
                    <div class="absolute top-2.5 left-2.5 inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/92 backdrop-blur-md text-[11px] font-semibold text-dark shadow-xs">
                      <span class="text-terracotta text-xs">&#9733;</span> Curated Spotlight
                    </div>

                    <!-- Bottom caption inside image -->
                    <div class="absolute bottom-2.5 left-3 right-3 text-white">
                      <p class="text-[11px] font-medium text-white/80">Asian Fusion &bull; Jl. Bandung No. 40</p>
                      <h2 class="text-base sm:text-lg font-bold leading-tight drop-shadow-xs">Dialoogi Signature</h2>
                    </div>
                  </div>
                </a>

                <!-- Mini meta strip inside the card -->
                <div class="flex items-center justify-between px-2.5 py-2 mt-0.5 text-xs">
                  <span class="text-dark/60 font-medium text-[11px]">&#128337; 09:00 - 23:00 WIB</span>
                  <a href="pages/restaurant.php?id=dialogi-signature-malang" class="text-terracotta font-semibold hover:underline inline-flex items-center gap-1 text-[11px]">
                    View Menu &rarr;
                  </a>
                </div>
              </div>

              <!-- Secondary Floating Badge Card (Okiru Ramen) -->
              <div class="hidden sm:flex absolute -top-3 right-1 sm:-top-3.5 sm:right-2 bg-white/95 backdrop-blur-md rounded-xl p-2 sm:p-2.5 border border-dark/10 shadow-[0_8px_24px_rgba(36,33,29,0.10)] items-center gap-2.5 max-w-[200px] transition-transform duration-300 hover:scale-104">
                <img
                  src="assets/restaurants/okiru-ramen/source/Screenshot%202026-10-12%20234210.png"
                  alt="Okiru Ramen Salmon Truffle"
                  class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg object-cover shrink-0 border border-dark/5"
                />
                <div class="min-w-0">
                  <span class="inline-block px-1.5 py-0.2 rounded bg-[#6F8064]/12 text-[#6F8064] text-[9px] font-bold uppercase tracking-wider">Top Rated</span>
                  <p class="text-[11px] font-bold text-dark truncate leading-snug">Okiru Ramen</p>
                  <p class="text-[10px] text-dark/55 truncate">Japanese Ramen Bar</p>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- 3: DISCOVERY CATEGORIES -->
    <section class="discovery-categories py-3 md:py-4" aria-label="Browse by category">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-xs font-semibold uppercase tracking-wider text-dark/50">Explore by Category</h2>
          <a href="pages/explore.php" class="text-xs font-medium text-terracotta hover:underline">All categories &rarr;</a>
        </div>
        <div class="content-rail flex gap-2.5 sm:gap-3 overflow-x-auto pb-2 min-h-auto">
          <a href="pages/explore.php?category=Asian%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127836;</span> Asian Food</a>
          <a href="pages/explore.php?category=Restaurant" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127869;</span> Restaurant</a>
          <a href="pages/explore.php?category=Fast%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127828;</span> Fast Food</a>
          <a href="pages/explore.php?category=Cafe%20%26%20Coffee" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#9749;</span> Cafe &amp; Coffee</a>
          <a href="pages/explore.php?category=Local%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127835;</span> Local Food</a>
          <a href="pages/explore.php?category=Jajanan" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127854;</span> Jajanan</a>
          <a href="pages/explore.php?category=Drinks" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127865;</span> Drinks</a>
          <a href="pages/explore.php?category=Dessert%20%26%20Bakery" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#127856;</span> Dessert &amp; Bakery</a>
          <a href="pages/explore.php?category=Healthy%20Food" class="badge badge-neutral badge-category shrink-0"><span class="category-icon" aria-hidden="true">&#129367;</span> Healthy Food</a>
        </div>
      </div>
    </section>

    <!-- 4: FEATURED IN MALANG -->
    <section class="section-rail py-6 md:py-8" aria-labelledby="popular-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <header class="section-header flex flex-col sm:flex-row sm:items-end justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
          <div class="flex items-start justify-between gap-2 w-full sm:w-auto">
            <div>
              <h2 id="popular-heading" class="text-xl sm:text-2xl font-semibold text-dark mb-0.5 sm:mb-1">Featured in Malang</h2>
              <p id="popular-subtitle" class="text-xs sm:text-sm text-dark/65">Hand-picked spots with verified menus, artisan flavors, and top guest ratings.</p>
            </div>
            <a href="pages/explore.php" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150 sm:hidden">Lihat semua &rarr;</a>
          </div>
          <div class="section-actions flex items-center justify-between sm:justify-start gap-4">
            <a href="pages/explore.php" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150 hidden sm:inline-block">Lihat semua &rarr;</a>
          </div>
        </header>
        <div class="content-rail flex gap-4 overflow-x-auto min-h-12 pb-2">
          <?php if (empty($featuredRestaurants)): ?>
            <div class="rail-empty-state w-full py-6 px-4 text-center bg-white/80 rounded-2xl border border-dark/10 flex flex-col items-center justify-center gap-1.5 shadow-sm" role="status">
              <div class="w-8 h-8 rounded-full bg-terracotta/10 text-terracotta flex items-center justify-center text-sm font-semibold mb-0.5" aria-hidden="true">&#10022;</div>
              <p class="text-sm font-semibold text-dark">Curating New Spots</p>
              <p class="text-xs text-dark/65 max-w-[320px]">We are hand-verifying dining spots and authentic menus in this category.</p>
            </div>
          <?php else: ?>
            <?php foreach ($featuredRestaurants as $restaurant): ?>
              <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 5: ASIAN DINING & SPECIALTIES -->
    <section class="section-rail py-6 md:py-8" aria-labelledby="cafe-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <header class="section-header flex items-end justify-between gap-2 sm:gap-4 mb-4 sm:mb-6">
          <div>
            <h2 id="cafe-heading" class="text-xl sm:text-2xl font-semibold text-dark mb-0.5 sm:mb-1">Asian Dining &amp; Specialties</h2>
            <p class="text-xs sm:text-sm text-dark/65">Ramen bars, Japanese grills, and modern Asian fusion in Malang.</p>
          </div>
          <a href="pages/explore.php?category=Asian%20Food" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150">Lihat semua &rarr;</a>
        </header>
        <div class="content-rail flex gap-4 overflow-x-auto min-h-12 pb-2">
          <?php if (empty($asianRestaurants)): ?>
            <div class="rail-empty-state w-full py-6 px-4 text-center bg-white/80 rounded-2xl border border-dark/10 flex flex-col items-center justify-center gap-1.5 shadow-sm" role="status">
              <div class="w-8 h-8 rounded-full bg-terracotta/10 text-terracotta flex items-center justify-center text-sm font-semibold mb-0.5" aria-hidden="true">&#10022;</div>
              <p class="text-sm font-semibold text-dark">Curating New Spots</p>
              <p class="text-xs text-dark/65 max-w-[320px]">We are hand-verifying dining spots and authentic menus in this category.</p>
            </div>
          <?php else: ?>
            <?php foreach ($asianRestaurants as $restaurant): ?>
              <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 6: LATE NIGHT & QUICK CRAVINGS -->
    <section class="section-rail py-6 md:py-8" aria-labelledby="curated-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <header class="section-header flex items-end justify-between gap-2 sm:gap-4 mb-4 sm:mb-6">
          <div>
            <h2 id="curated-heading" class="text-xl sm:text-2xl font-semibold text-dark mb-0.5 sm:mb-1">Late Night &amp; Quick Cravings</h2>
            <p class="text-xs sm:text-sm text-dark/65">Satisfy your midnight cravings &mdash; 24-hour dining and fast casual spots.</p>
          </div>
          <a href="pages/explore.php?category=Fast%20Food" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity duration-150">Lihat semua &rarr;</a>
        </header>
        <div class="content-rail flex gap-4 overflow-x-auto min-h-12 pb-2">
          <?php if (empty($quickRestaurants)): ?>
            <div class="rail-empty-state w-full py-6 px-4 text-center bg-white/80 rounded-2xl border border-dark/10 flex flex-col items-center justify-center gap-1.5 shadow-sm" role="status">
              <div class="w-8 h-8 rounded-full bg-terracotta/10 text-terracotta flex items-center justify-center text-sm font-semibold mb-0.5" aria-hidden="true">&#10022;</div>
              <p class="text-sm font-semibold text-dark">Curating New Spots</p>
              <p class="text-xs text-dark/65 max-w-[320px]">We are hand-verifying dining spots and authentic menus in this category.</p>
            </div>
          <?php else: ?>
            <?php foreach ($quickRestaurants as $restaurant): ?>
              <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 7: DISCOVERY CTA -->
    <section class="section-cta py-12 md:py-16 text-center bg-dark/3 border-y border-dark/5" aria-labelledby="cta-heading">
      <div class="container cta-inner max-w-[1200px] mx-auto px-4 md:px-6 flex flex-col items-center gap-3 sm:gap-4">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-terracotta/10 text-terracotta text-xs font-semibold">
          <span>&#127869;</span> Explore Malang Food Scene
        </div>
        <h2 id="cta-heading" class="text-2xl sm:text-3xl font-bold text-dark">Ready to find your next meal?</h2>
        <p class="cta-text text-lead text-muted text-base sm:text-lg text-dark/70 max-w-[520px]">Discover authentic dishes, artisan coffee, and hidden gems across Malang with official menus and verified reviews.</p>
        <a href="pages/explore.php" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-8 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] focus-visible:border-[#B25132] transition-colors duration-200 whitespace-nowrap cursor-pointer shadow-sm mt-2">Explore All Restaurants &rarr;</a>
      </div>
    </section>

  </main>

<?php
require dirname(__DIR__) . '/layouts/footer.php';
