<?php
/**
 * BiteMap - Restaurant Detail
 * Sprint 05 Object-Oriented PHP Integration (Week 6)
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/functions.php';

$basePath = '../';
$currentPage = 'restaurant';

// Retrieve and validate requested ID
$id = isset($_GET['id']) ? trim((string)$_GET['id']) : null;
$restaurant = getRestaurantById($id);

// 404 Response if restaurant ID is missing or not found
if ($restaurant === null) {
    http_response_code(404);
    $pageTitle = 'Restaurant Not Found — BiteMap';
    $pageDescription = 'The restaurant you are looking for does not exist or may have been removed.';
    require_once __DIR__ . '/../includes/header.php';
?>
  <main id="main-content" class="py-16 md:py-24 text-center">
    <div class="container max-w-[600px] mx-auto px-4">
      <div class="restaurant-not-found p-8 bg-white rounded-2xl border border-dashed border-dark/20 flex flex-col items-center gap-4">
        <div class="text-4xl text-terracotta" aria-hidden="true">&#9888;</div>
        <h1 class="text-2xl sm:text-3xl font-bold text-dark">Restaurant Not Found</h1>
        <p class="text-dark/65">The restaurant you are looking for does not exist or may have been removed.</p>
        <a href="explore.php" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer mt-2">Back to Explore</a>
      </div>
    </div>
  </main>
<?php
    require_once __DIR__ . '/../includes/footer.php';
    exit;
}

// Canonical restaurant domain object found
$pageTitle = $restaurant->getName() . ' — BiteMap';
$pageDescription = $restaurant->getDescription() ?? ('View menu, location, opening hours, and details for ' . $restaurant->getName() . ' on BiteMap.');

// Extra head for Leaflet map styling
$extraHead = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />';

// Extra scripts for Leaflet map library
$extraScripts = '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>';

// Prepare category & cuisine string using domain method
$categoryString = $restaurant->getCategoryAndCuisine();

// Operating hours calculation using domain methods
$tz = new DateTimeZone('Asia/Jakarta');
$now = new DateTime('now', $tz);
$todayName = $now->format('l'); // 'Monday' through 'Sunday'
$daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$isOpenNow = $restaurant->isOpenNow($now);
$is24Hours = $restaurant->is24Hours($todayName);

// Hero image asset style via domain method
$heroStyle = $restaurant->getHeroStyle('../');

require_once __DIR__ . '/../includes/header.php';
?>

  <!-- ===== MAIN CONTENT ===== -->
  <main id="main-content">

    <!-- 1 & 2 & 3: RESTAURANT HERO & IDENTITY & ACTIONS -->
    <section class="restaurant-hero pb-6 md:pb-10" aria-labelledby="restaurant-name">
      <div class="restaurant-hero-image w-full h-[280px] sm:h-[340px] md:h-[400px] mb-8" aria-label="Restaurant exterior view" role="img" data-detail="hero-image"<?= $heroStyle ?>>
      </div>
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">

        <header class="restaurant-header flex flex-col md:flex-row justify-between items-start gap-4 flex-wrap">
          <div class="restaurant-info">
            <h1 id="restaurant-name" class="text-3xl sm:text-4xl lg:text-[40px] font-bold tracking-tight text-dark leading-tight" data-detail="name"><?= e($restaurant->getName()) ?></h1>
            <p class="text-lead text-muted text-lg sm:text-xl text-dark/65 mb-2 mt-1" data-detail="category"><?= $categoryString ?></p>
            <p class="text-meta text-muted text-xs font-medium uppercase tracking-wider text-dark/65" data-detail="meta"><?= $restaurant->getFormattedRating() ?></p>
          </div>
          <div class="restaurant-actions flex gap-3 flex-wrap w-full sm:w-auto">
            <?php if ($restaurant->hasReservationCapability()): ?>
              <a href="reservation.html?id=<?= urlencode($restaurant->getId()) ?>" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] focus-visible:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer flex-1 sm:flex-initial" data-detail="reserve-btn">Reserve a Table</a>
            <?php else: ?>
              <button type="button" class="btn btn-secondary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark/20 rounded-full text-sm font-semibold text-dark/40 bg-dark/5 cursor-not-allowed flex-1 sm:flex-initial" disabled aria-disabled="true" data-detail="reserve-btn">Reservations Unavailable</button>
            <?php endif; ?>
            <button type="button" class="btn btn-outline inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark bg-transparent hover:bg-dark hover:text-white focus-visible:bg-dark focus-visible:text-white transition-colors duration-250 whitespace-nowrap cursor-pointer flex-1 sm:flex-initial" aria-label="Save to favorites" data-detail="save-btn">
              Save
            </button>
          </div>
        </header>

        <!-- 4: SECTION NAVIGATION -->
        <nav class="restaurant-tabs mt-8 border-b border-dark/15" aria-label="Restaurant sections">
          <ul class="flex flex-nowrap gap-6 pb-4 overflow-x-auto whitespace-nowrap" role="list">
            <li class="shrink-0"><a href="#about" class="font-medium text-dark/65 hover:text-dark transition-colors duration-150">About</a></li>
            <li class="shrink-0"><a href="#menu" class="font-medium text-dark/65 hover:text-dark transition-colors duration-150">Menu</a></li>
            <li class="shrink-0"><a href="#gallery" class="font-medium text-dark/65 hover:text-dark transition-colors duration-150">Gallery</a></li>
            <li class="shrink-0"><a href="#location" class="font-medium text-dark/65 hover:text-dark transition-colors duration-150">Location</a></li>
            <li class="shrink-0"><a href="#hours" class="font-medium text-dark/65 hover:text-dark transition-colors duration-150">Hours</a></li>
          </ul>
        </nav>
      </div>
    </section>

    <!-- 5: ABOUT -->
    <section id="about" class="about py-6 md:py-10" aria-labelledby="about-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <h2 id="about-heading" class="text-2xl font-semibold text-dark mb-4">About</h2>
        <div class="max-w-[680px]" data-detail="about-content">
          <p class="text-lead text-lg text-dark leading-relaxed" data-detail="description"><?= e($restaurant->getDescription() ?? 'Description unavailable.') ?></p>
        </div>
        <div class="empty-state hidden flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15" data-detail="about-empty" style="display: none;" aria-hidden="true">
          <p class="empty-state-desc text-dark/65">Description unavailable.</p>
        </div>
      </div>
    </section>

    <!-- 6: GALLERY -->
    <section id="gallery" class="gallery py-6 md:py-10" aria-labelledby="gallery-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <h2 id="gallery-heading" class="text-2xl font-semibold text-dark mb-6">Gallery</h2>

        <?php if ($restaurant->hasGallery()): ?>
          <ul class="gallery-grid grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6" aria-label="Restaurant photo gallery" role="list" data-detail="gallery-grid">
            <?php foreach ($restaurant->getGallery() as $item): ?>
              <li>
                <figure class="gallery-image-wrapper overflow-hidden relative cursor-pointer" aria-label="<?= e($item['alt'] ?? 'Gallery photo') ?>" tabindex="0" role="button">
                  <img src="<?= e(getAssetPath($item['src'] ?? ($item['image'] ?? ''), '../')) ?>" alt="<?= e($item['alt'] ?? 'Gallery photo') ?>" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" loading="lazy" />
                </figure>
              </li>
            <?php endforeach; ?>
          </ul>
          <div class="empty-state hidden flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15" data-detail="gallery-empty" style="display: none;" aria-hidden="true">
            <p class="empty-state-desc text-dark/65">Photos aren&#39;t available at the moment.</p>
          </div>
        <?php else: ?>
          <ul class="gallery-grid grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6" aria-label="Restaurant photo gallery" role="list" data-detail="gallery-grid" style="display: none;" aria-hidden="true"></ul>
          <div class="empty-state flex flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15" data-detail="gallery-empty">
            <p class="empty-state-desc text-dark/65">Photos aren&#39;t available at the moment.</p>
          </div>
        <?php endif; ?>

      </div>
    </section>

    <!-- 7: MENU -->
    <section id="menu" class="menu py-6 md:py-10" aria-labelledby="menu-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
        <h2 id="menu-heading" class="text-2xl font-semibold text-dark mb-6">Menu</h2>

        <?php if ($restaurant->hasMenu()): ?>
          <div class="empty-state hidden flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15" data-detail="menu-empty" style="display: none;" aria-hidden="true">
            <p class="empty-state-desc text-dark/65">Menu isn&#39;t available at the moment.</p>
          </div>

          <!-- Quick Navigation Pills for Categories -->
          <nav class="menu-category-nav" aria-label="Menu categories" data-detail="menu-category-nav">
            <ul class="menu-category-pills" role="list" data-detail="menu-category-pills">
              <?php foreach ($restaurant->getMenu() as $cIdx => $cat): ?>
                <?php
                if (empty($cat['items'])) continue;
                $secId = $cat['id'] ?? ('menu-' . preg_replace('/[^a-z0-9]+/i', '-', strtolower($cat['category'])));
                $conciseLabel = getConciseCategoryLabel($cat['category']);
                $pillClass = 'menu-category-pill';
                if ($secId === 'menu-upgrade-addon') {
                    $pillClass .= ' menu-category-pill--addon';
                } elseif ($secId === 'menu-promo') {
                    $pillClass .= ' menu-category-pill--promo';
                }
                if ($cIdx === 0) {
                    $pillClass .= ' is-active';
                }
                ?>
                <li class="menu-category-pill-item">
                  <a href="#<?= e($secId) ?>" data-target-id="<?= e($secId) ?>" class="<?= $pillClass ?>" <?= $cIdx === 0 ? 'aria-current="location"' : '' ?><?= $conciseLabel !== $cat['category'] ? ' title="' . e($cat['category']) . '"' : '' ?>>
                    <?= e($conciseLabel) ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>

          <!-- Menu Categories and Items Container -->
          <div class="max-w-[800px]" data-detail="menu-container">
            <?php foreach ($restaurant->getMenu() as $cat): ?>
              <?php
              if (empty($cat['items'])) continue;
              $secId = $cat['id'] ?? ('menu-' . preg_replace('/[^a-z0-9]+/i', '-', strtolower($cat['category'])));
              $headingId = $secId . '-title';
              $isAddon = ($secId === 'menu-upgrade-addon');
              $isPromo = ($secId === 'menu-promo');
              $secClass = 'menu-section' . ($isAddon ? ' menu-section--addon' : '') . ($isPromo ? ' menu-section--promo' : '');
              ?>
              <div class="<?= $secClass ?>" id="<?= e($secId) ?>" aria-labelledby="<?= e($headingId) ?>">
                <?php if ($isAddon): ?>
                  <span class="menu-section-badge menu-section-badge--addon">ADD-ONS &amp; TOPPINGS</span>
                <?php elseif ($isPromo): ?>
                  <span class="menu-section-badge menu-section-badge--promo">SPECIAL PROMO</span>
                <?php endif; ?>

                <h3 id="<?= e($headingId) ?>" class="menu-section-title"><?= e($cat['category']) ?></h3>

                <?php foreach ($cat['items'] as $item): ?>
                  <div class="menu-item">
                    <div class="menu-item-info">
                      <h4><?= e($item->getName()) ?></h4>
                      <?php if ($item->hasDescription()): ?>
                        <p class="text-small text-muted" style="margin-top: var(--space-1);"><?= e($item->getDescription()) ?></p>
                      <?php endif; ?>
                    </div>
                    <?php if ($item->getPrice() !== ''): ?>
                      <div class="menu-item-price">
                        <?= $item->renderPriceHtml() ?>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>

        <?php else: ?>
          <!-- Empty State when restaurant has no menu entries -->
          <div class="empty-state flex flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15" data-detail="menu-empty">
            <p class="empty-state-desc text-dark/65">Menu isn&#39;t available at the moment.</p>
          </div>
          <nav class="menu-category-nav" aria-label="Menu categories" data-detail="menu-category-nav" style="display: none;" aria-hidden="true">
            <ul class="menu-category-pills" role="list" data-detail="menu-category-pills"></ul>
          </nav>
          <div class="max-w-[800px]" data-detail="menu-container" style="display: none;" aria-hidden="true"></div>
        <?php endif; ?>

        <!-- External Menu Link CTA (if present) -->
        <?php if ($restaurant->getExternalMenuUrl()): ?>
          <div class="menu-external-cta mt-8 pt-6 border-t border-dark/10" data-detail="menu-external-cta">
            <a href="<?= e($restaurant->getExternalMenuUrl()) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark hover:bg-dark hover:text-white focus-visible:bg-dark focus-visible:text-white transition-colors duration-250 cursor-pointer" data-detail="menu-external-link">
              <span>Lihat Menu Lengkap</span>
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" width="16" height="16">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
              </svg>
            </a>
          </div>
        <?php else: ?>
          <div class="menu-external-cta mt-8 pt-6 border-t border-dark/10" data-detail="menu-external-cta" style="display: none;" aria-hidden="true">
            <a href="#" target="_blank" rel="noopener noreferrer" class="btn btn-outline inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark hover:bg-dark hover:text-white focus-visible:bg-dark focus-visible:text-white transition-colors duration-250 cursor-pointer" data-detail="menu-external-link">
              <span>Lihat Menu Lengkap</span>
            </a>
          </div>
        <?php endif; ?>

      </div>
    </section>

    <!-- 8: LOCATION & 9: HOURS -->
    <div class="location-hours-wrapper bg-white py-10 md:py-14 border-t border-dark/[0.08]">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6">

        <div class="location-hours-grid grid grid-cols-1 md:grid-cols-2 gap-10">

          <!-- Location -->
          <section id="location" class="location p-0" aria-labelledby="location-heading">
            <h2 id="location-heading" class="text-2xl font-semibold text-dark mb-6">Location</h2>
            <div class="location-map w-full h-[320px] rounded-[20px] mb-4 flex items-center justify-center relative overflow-hidden" aria-label="Restaurant location map" data-detail="location-map">
              <span class="text-muted text-dark/65">Map Placeholder</span>
            </div>
            <address class="location-address not-italic" data-detail="location-address">
              <p class="text-lead text-lg text-dark" data-detail="address-text"><?= e($restaurant->getLocation() !== '' ? $restaurant->getLocation() : 'Location unavailable.') ?></p>

              <?php if ($restaurant->getPhone() || !empty($restaurant->getExternalLinks()) || $restaurant->getWebsite()): ?>
                <div class="location-contact-info mt-3 pt-3 border-t border-dark/10 flex flex-col gap-1.5 text-sm text-dark/75 break-words">
                  <?php if ($restaurant->getPhone()): ?>
                    <p><strong>Phone:</strong> <a href="tel:<?= e($restaurant->getPhone()) ?>" class="hover:underline text-dark"><?= e($restaurant->getPhone()) ?></a></p>
                  <?php endif; ?>

                  <?php if (!empty($restaurant->getExternalLinks())): ?>
                    <?php foreach ($restaurant->getExternalLinks() as $link): ?>
                      <?php if (empty($link['url'])) continue; ?>
                      <p class="break-all" style="word-break: break-all; overflow-wrap: anywhere;">
                        <a href="<?= e($link['url']) ?>" target="_blank" rel="noopener noreferrer" class="external-link hover:underline text-terracotta font-medium inline-flex items-center gap-1.5 break-all" style="word-break: break-all; overflow-wrap: anywhere;">
                          <span><?= e($link['label'] ?? 'Tautan') ?></span>
                          <svg class="w-3.5 h-3.5 inline shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" width="14" height="14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                          </svg>
                        </a>
                      </p>
                    <?php endforeach; ?>
                  <?php elseif ($restaurant->getWebsite()): ?>
                    <p class="break-all" style="word-break: break-all; overflow-wrap: anywhere;">
                      <strong>Selengkapnya</strong>
                      <a href="<?= e($restaurant->getWebsite()) ?>" target="_blank" rel="noopener noreferrer" class="hover:underline text-terracotta break-all" style="word-break: break-all; overflow-wrap: anywhere;"><?= e($restaurant->getWebsite()) ?></a>
                    </p>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </address>
          </section>

          <!-- Hours -->
          <section id="hours" class="hours p-0" aria-labelledby="hours-heading">
            <h2 id="hours-heading" class="text-2xl font-semibold text-dark mb-6">
              Opening Hours
              <?php if ($is24Hours): ?>
                <span class="hours-status-badge badge badge-success" style="margin-left: var(--space-2); font-size: var(--font-size-xs); vertical-align: middle;">Open 24 hours</span>
              <?php elseif ($isOpenNow): ?>
                <span class="hours-status-badge badge badge-success" style="margin-left: var(--space-2); font-size: var(--font-size-xs); vertical-align: middle;">Open now</span>
              <?php else: ?>
                <span class="hours-status-badge badge badge-neutral" style="margin-left: var(--space-2); font-size: var(--font-size-xs); vertical-align: middle;">Closed</span>
              <?php endif; ?>
            </h2>

            <?php if (!empty($restaurant->getHours())): ?>
              <dl class="hours-list max-w-[400px] flex flex-col" data-detail="hours-list">
                <?php foreach ($daysOrder as $day): ?>
                  <?php
                  $timeStr = $restaurant->getHoursForDay($day);
                  if ($timeStr === null) continue;
                  $isToday = ($day === $todayName);
                  ?>
                  <div class="hours-row <?= $isToday ? 'hours-today' : '' ?>">
                    <dt><?= e($day . ($isToday ? ' (Today)' : '')) ?></dt>
                    <dd><?= e($timeStr) ?></dd>
                  </div>
                <?php endforeach; ?>
              </dl>
              <div class="empty-state hidden flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15" data-detail="hours-empty" style="display: none;" aria-hidden="true">
                <p class="empty-state-desc text-dark/65">Hours not available.</p>
              </div>
            <?php else: ?>
              <dl class="hours-list max-w-[400px] flex flex-col" data-detail="hours-list" style="display: none;" aria-hidden="true"></dl>
              <div class="empty-state flex flex-col items-center justify-center text-center py-16 px-4 gap-4 bg-white rounded-[20px] border border-dashed border-dark/15" data-detail="hours-empty">
                <p class="empty-state-desc text-dark/65">Hours not available.</p>
              </div>
            <?php endif; ?>
          </section>

        </div>

      </div>
    </div>

    <!-- 10: RESERVATION CTA -->
    <section class="section-cta py-10 md:py-16 text-center border-t border-dark/[0.08]" aria-labelledby="cta-heading">
      <div class="container max-w-[1200px] mx-auto px-4 md:px-6 flex flex-col items-center gap-4">
        <h2 id="cta-heading" class="text-2xl font-semibold text-dark">Ready to visit?</h2>
        <?php if ($restaurant->hasReservationCapability()): ?>
          <p class="text-lead text-muted text-lg sm:text-xl text-dark/65 max-w-[500px]" data-detail="reservation-cta-text">Reserve your table before you arrive.</p>
          <a href="reservation.html?id=<?= urlencode($restaurant->getId()) ?>" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] focus-visible:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer mt-2" data-detail="cta-reserve-btn">Reserve a Table</a>
        <?php else: ?>
          <p class="text-lead text-muted text-lg sm:text-xl text-dark/65 max-w-[500px]" data-detail="reservation-cta-text">Online reservations are currently unavailable for this restaurant.</p>
          <button type="button" class="btn btn-secondary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark/20 rounded-full text-sm font-semibold text-dark/40 bg-dark/5 cursor-not-allowed mt-2" disabled aria-disabled="true" data-detail="cta-reserve-btn">Reservations Unavailable</button>
        <?php endif; ?>
      </div>
    </section>

  </main>

  <!-- GALLERY LIGHTBOX -->
  <dialog id="gallery-lightbox" class="gallery-lightbox" aria-modal="true" aria-label="Image viewer">
    <div class="lightbox-content">
      <button type="button" class="btn btn-outline inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-dark rounded-full text-sm font-semibold text-dark bg-transparent hover:bg-dark hover:text-white focus-visible:bg-dark focus-visible:text-white transition-colors duration-250 whitespace-nowrap cursor-pointer lightbox-close" aria-label="Close image viewer">Close</button>
      <div id="lightbox-image-container" aria-live="polite"></div>
    </div>
  </dialog>

<?php
require_once __DIR__ . '/../includes/footer.php';
