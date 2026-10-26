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

    <!-- 1: MAP-FIRST CULINARY QUEST HERO & PLAYER HUD -->
    <section class="hero relative py-5 md:py-8 lg:py-10 overflow-hidden border-b border-dark/10" aria-labelledby="hero-heading">
      <div class="container hero-inner max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

          <!-- Left Column (5 cols): Brand Pitch, Live Player XP Card, Search -->
          <div class="hero-content lg:col-span-5 flex flex-col items-start text-left">

            <!-- Eyebrow Pill -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-terracotta/10 border border-terracotta/20 text-terracotta text-[11px] font-bold uppercase tracking-wider mb-2.5">
              <span>&#129517;</span> Map-First Culinary Discovery &bull; Malang
            </div>

            <!-- Headline -->
            <h1 id="hero-heading" class="text-2xl sm:text-3xl lg:text-[36px] font-bold tracking-tight text-dark leading-[1.2] mb-2.5">
              Explore Malang on the map. <span class="text-terracotta">Complete Culinary Quests.</span>
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtitle text-dark/70 text-xs sm:text-sm leading-relaxed mb-4">
              Click interactive restaurant markers across Lowokwaru, Jl. Bandung, and Ijen Boulevard to inspect verified menus, log tasting check-ins, earn XP, and unlock Malang Explorer badges.
            </p>

            <!-- Live Player Progress HUD Card (Phase D) -->
            <div class="w-full bg-white rounded-2xl border border-dark/12 p-4 shadow-[0_6px_24px_rgba(36,33,29,0.06)] mb-4" id="home-player-hud">
              <div class="flex items-center justify-between gap-3 mb-2.5">
                <div class="flex items-center gap-3">
                  <div class="w-11 h-11 rounded-2xl bg-terracotta text-white flex flex-col items-center justify-center font-bold leading-none shadow-xs">
                    <span class="text-[9px] uppercase opacity-85">Level</span>
                    <span class="text-lg" data-hud="level-num">1</span>
                  </div>
                  <div>
                    <div class="flex items-center gap-2">
                      <h2 class="text-sm font-bold text-dark" data-hud="rank-title">Novice Taster</h2>
                      <span class="px-2 py-0.5 rounded-full bg-[#6F8064]/12 text-[#6F8064] text-[10px] font-bold" data-hud="xp-text">0 XP</span>
                    </div>
                    <p class="text-[11px] text-dark/60" data-hud="next-level-text">150 XP needed for Level 2 (Street Scout)</p>
                  </div>
                </div>
                <button
                  type="button"
                  class="btn-reset-quest-progress px-2.5 py-1 rounded-full border border-dark/15 hover:border-terracotta text-[10px] font-semibold text-dark/60 hover:text-terracotta bg-cream/50 cursor-pointer transition-colors"
                  title="Reset demo XP, quests, and badges to 0"
                >
                  &#8635; Reset
                </button>
              </div>

              <!-- XP Progress Bar -->
              <div class="w-full h-2.5 rounded-full bg-dark/8 overflow-hidden mb-3">
                <div class="h-full bg-terracotta transition-all duration-300 rounded-full" style="width: 0%;" data-hud="xp-bar"></div>
              </div>

              <!-- Quick Stats Strip -->
              <div class="grid grid-cols-3 gap-2 pt-2.5 border-t border-dark/8 text-center">
                <a href="#quests-section" class="p-1.5 rounded-xl bg-cream/60 hover:bg-cream no-underline transition-colors">
                  <p class="text-xs font-bold text-dark" data-hud="quests-count">0/4</p>
                  <p class="text-[10px] text-dark/60">Quests Done</p>
                </a>
                <a href="#badges-section" class="p-1.5 rounded-xl bg-cream/60 hover:bg-cream no-underline transition-colors">
                  <p class="text-xs font-bold text-[#6F8064]" data-hud="badges-count">0/4</p>
                  <p class="text-[10px] text-dark/60">Badges Earned</p>
                </a>
                <a href="pages/explore.php" class="p-1.5 rounded-xl bg-cream/60 hover:bg-cream no-underline transition-colors">
                  <p class="text-xs font-bold text-terracotta">3 Spots</p>
                  <p class="text-[10px] text-dark/60">On Quest Map</p>
                </a>
              </div>
            </div>

            <!-- Search Form -->
            <form action="pages/explore.php" method="GET" class="hero-search-wrapper w-full bg-white rounded-2xl sm:rounded-full border border-dark/12 shadow-[0_4px_20px_rgba(36,33,29,0.06)] p-1.5 flex flex-col sm:flex-row items-stretch sm:items-center gap-1 sm:gap-1.5 transition-all focus-within:border-terracotta/40" role="search" aria-label="Restaurant discovery search">
              <div class="flex-1 min-w-0 flex items-center gap-2 px-3 py-1.5">
                <span class="text-dark/35 text-sm shrink-0" aria-hidden="true">&#128269;</span>
                <label for="hero-search" class="visually-hidden">Search Malang landmarks or dishes</label>
                <input
                  type="search"
                  id="hero-search"
                  name="q"
                  class="w-full bg-transparent text-sm text-dark placeholder:text-dark/45 focus:outline-none"
                  placeholder="Ramen, truffle, burger, coffee..."
                />
              </div>
              <input type="hidden" name="loc" value="Malang" />
              <button type="submit" class="btn btn-primary inline-flex items-center justify-center py-2 px-5 rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] transition-colors whitespace-nowrap cursor-pointer shrink-0 w-full sm:w-auto">
                Open Map &rarr;
              </button>
            </form>

            <!-- Quick Filter & Quest Chips -->
            <div class="hero-quick-tags flex flex-wrap items-center gap-1.5 mt-3 text-xs">
              <span class="text-dark/50 font-semibold mr-0.5">Filter Map:</span>
              <button type="button" class="btn-home-map-filter is-active px-2.5 py-1 rounded-full bg-terracotta text-white border border-terracotta text-xs font-semibold cursor-pointer transition-colors" data-map-category="all">All (3)</button>
              <button type="button" class="btn-home-map-filter px-2.5 py-1 rounded-full bg-white hover:border-terracotta text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Asian Food">&#127836; Ramen Bar</button>
              <button type="button" class="btn-home-map-filter px-2.5 py-1 rounded-full bg-white hover:border-terracotta text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Restaurant">&#9749; Asian Fusion</button>
              <button type="button" class="btn-home-map-filter px-2.5 py-1 rounded-full bg-white hover:border-terracotta text-dark/75 border border-dark/12 text-xs font-medium cursor-pointer transition-colors" data-map-category="Fast Food">&#127828; 24h Ijen</button>
            </div>

          </div>

          <!-- Right Column (7 cols): Interactive Malang Culinary Quest Map Surface -->
          <div class="hero-visual lg:col-span-7 w-full">
            <div class="bg-white rounded-3xl border border-dark/12 shadow-[0_14px_40px_rgba(36,33,29,0.08)] overflow-hidden">

              <!-- Map Header Strip -->
              <div class="px-4 py-3 border-b border-dark/10 flex flex-wrap items-center justify-between gap-2 bg-cream/40">
                <div class="flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-terracotta animate-pulse" aria-hidden="true"></span>
                  <span class="text-xs font-bold text-dark uppercase tracking-wider">Live Malang Culinary Quest Map</span>
                </div>
                <div class="flex items-center gap-2">
                  <button
                    type="button"
                    id="btn-home-reset-map"
                    class="px-2.5 py-1 rounded-full bg-white border border-dark/15 hover:border-terracotta text-dark text-[11px] font-semibold cursor-pointer transition-colors"
                  >
                    Fit All Pins
                  </button>
                  <a href="pages/explore.php" class="px-3 py-1 rounded-full bg-dark hover:bg-terracotta text-white text-[11px] font-semibold no-underline transition-colors">
                    Full Map Explorer &rarr;
                  </a>
                </div>
              </div>

              <!-- Interactive Leaflet Map Container -->
              <div
                id="home-discovery-map"
                class="w-full h-[320px] sm:h-[380px] lg:h-[400px] bg-[#EDE6D8] relative z-10 flex items-center justify-center"
                aria-label="Interactive Malang Culinary Quest Map"
              >
                <span class="text-sm text-dark/60 font-medium">Loading interactive Malang Quest Map...</span>
              </div>

              <!-- Selected Map Landmark Inspector Bar -->
              <div
                id="home-selected-inspector"
                class="p-4 bg-white border-t border-dark/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3"
                aria-live="polite"
              >
                <div class="min-w-0">
                  <div class="flex items-center gap-2 mb-0.5">
                    <span class="px-2 py-0.5 rounded-full bg-terracotta/12 text-terracotta text-[10px] font-bold uppercase tracking-wider" data-inspector="badge">Active Landmark</span>
                    <span class="text-[11px] font-semibold text-[#6F8064]" data-inspector="quest-tag">&#129517; Quest Target</span>
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
                    href="pages/restaurant.php?id=okiru-ramen"
                    class="px-4 py-2 rounded-full bg-dark hover:bg-terracotta text-white text-xs font-semibold transition-colors no-underline"
                    data-inspector="detail-link"
                  >
                    Inspect Menu &rarr;
                  </a>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- 2: CULINARY QUESTS BOARD (Phase C) -->
    <section id="quests-section" class="py-8 md:py-12 bg-white/55 border-b border-dark/10" aria-labelledby="quests-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
          <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-terracotta/10 text-terracotta text-[11px] font-bold uppercase tracking-wider mb-1">
              <span>&#127942;</span> Culinary Quest MVP &bull; Self-Reported / Demo Progress
            </div>
            <h2 id="quests-heading" class="text-2xl sm:text-3xl font-bold text-dark">Active Malang Culinary Quests</h2>
            <p class="text-xs sm:text-sm text-dark/65 max-w-[680px] mt-1">
              Complete unique exploration steps (+25 XP each) and full quest objectives (+120 to +200 XP bonus) to level up and unlock achievement badges. Duplicate clicks on completed steps do not farm extra XP.
            </p>
          </div>
          <div class="flex items-center gap-2 shrink-0">
            <a href="pages/explore.php" class="px-4 py-2 rounded-full bg-terracotta hover:bg-[#B25132] text-white text-xs font-semibold no-underline transition-colors">
              Open Split Map Explorer &rarr;
            </a>
          </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <?php foreach ($quests as $quest): ?>
            <?php require dirname(__DIR__) . '/partials/quest-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 3: ACHIEVEMENT BADGES & LEVEL PROGRESSION SHOWCASE (Phase D) -->
    <section id="badges-section" class="py-8 md:py-10 border-b border-dark/10" aria-labelledby="badges-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-5">
          <div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#6F8064]">&#127941; Explorer Achievements</span>
            <h2 id="badges-heading" class="text-xl sm:text-2xl font-bold text-dark">Malang Culinary Badges</h2>
            <p class="text-xs sm:text-sm text-dark/65">Unlock badges by completing the corresponding Culinary Quests above.</p>
          </div>
          <p class="text-xs font-semibold text-dark/60">
            Unlocked: <span class="text-terracotta font-bold" data-hud="badges-count">0/4</span> Badges
          </p>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <?php foreach ($quests as $quest): ?>
            <?php $badge = $quest->getBadge(); ?>
            <div
              class="badge-showcase-card bg-white rounded-2xl border border-dark/12 p-4 flex items-start gap-3.5 opacity-60 transition-all duration-200"
              data-badge-card="<?= e($badge['id']) ?>"
            >
              <div class="w-12 h-12 rounded-2xl bg-cream border border-dark/10 flex items-center justify-center text-2xl shrink-0">
                <?= e($badge['icon']) ?>
              </div>
              <div class="min-w-0">
                <div class="flex items-center gap-1.5 flex-wrap mb-0.5">
                  <h3 class="text-sm font-bold text-dark truncate"><?= e($badge['name']) ?></h3>
                  <span
                    class="px-2 py-0.2 rounded-full bg-dark/10 text-dark/60 text-[10px] font-bold uppercase"
                    data-badge-status="<?= e($badge['id']) ?>"
                  >Locked</span>
                </div>
                <p class="text-xs text-dark/65 leading-snug mb-1"><?= e($badge['description']) ?></p>
                <p class="text-[10px] font-semibold text-terracotta">Quest: <?= e($quest->getTitle()) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 4: CONNECTED MALANG LANDMARKS RAILS -->
    <section class="section-rail py-6 md:py-8" aria-labelledby="popular-heading">
      <div class="container max-w-[1280px] mx-auto px-4 md:px-6">
        <header class="section-header flex flex-col sm:flex-row sm:items-end justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
          <div>
            <h2 id="popular-heading" class="text-xl sm:text-2xl font-semibold text-dark mb-0.5 sm:mb-1">Verified Malang Quest Landmarks</h2>
            <p id="popular-subtitle" class="text-xs sm:text-sm text-dark/65">Click "Focus on Map" on any card to highlight its pin on the interactive map above, or click "Check In (+25 XP)" to advance your quests.</p>
          </div>
          <a href="pages/explore.php" class="section-link text-sm font-medium text-terracotta whitespace-nowrap shrink-0 hover:opacity-75 transition-opacity">Open Map Explorer &rarr;</a>
        </header>
        <div class="content-rail grid grid-cols-1 md:grid-cols-3 gap-5 pb-2">
          <?php foreach ($featuredRestaurants as $restaurant): ?>
            <?php require dirname(__DIR__) . '/partials/restaurant-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

<?php
require dirname(__DIR__) . '/layouts/footer.php';
