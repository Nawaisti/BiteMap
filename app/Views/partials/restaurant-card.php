<?php
/**
 * BiteMap — Culinary Quest Restaurant Card View Partial (app/Views/partials/restaurant-card.php)
 * Week 6 (Object -> View -> HTML) & Week 7 (MVC View Partial) + Phase B/C (Map-First & Quest Actions)
 *
 * Expected view variables:
 *   @var Restaurant $restaurant      Domain object instance
 *   @var string     $cardLinkBase    Detail route base (e.g. 'pages/restaurant.php' or 'restaurant.php')
 *   @var string     $cardAssetPrefix Relative asset prefix ('' or '../')
 *   @var bool       $isFav           Optional initial favorite state
 */

declare(strict_types=1);

$cardLinkBase = $cardLinkBase ?? 'restaurant.php';
$cardAssetPrefix = $cardAssetPrefix ?? '';
$isFav = $isFav ?? false;

$cardId = $restaurant->getId();
$cardName = $restaurant->getName();
$cardCategory = $restaurant->getCategory();
$cardCuisine = $restaurant->getCuisine();
$cardHref = $cardLinkBase . '?id=' . urlencode($cardId);
$cardHeroUrl = $restaurant->getHeroImageUrl($cardAssetPrefix);
$cardRatingNumber = $restaurant->getFormattedRatingNumber();
$cardDistanceText = $restaurant->getFormattedDistance();
$cardStatus = $restaurant->getTodayStatus();

$favClass = $isFav ? 'btn-favorite is-active' : 'btn-favorite';
$favLabel = $isFav ? "Remove {$cardName} from favorites" : "Save {$cardName} to favorites";
$favPressed = $isFav ? 'true' : 'false';
?>
<article
  class="restaurant-card group transition-all duration-200"
  data-id="<?= e($cardId) ?>"
  data-restaurant-id="<?= e($cardId) ?>"
  data-name="<?= e($cardName) ?>"
  data-category="<?= e($cardCategory) ?>"
  data-lat="<?= e((string) $restaurant->getLatitude()) ?>"
  data-lon="<?= e((string) $restaurant->getLongitude()) ?>"
>
  <div class="restaurant-card-media relative">
    <a href="<?= e($cardHref) ?>" class="block" aria-label="View <?= e($cardName) ?>" tabindex="-1">
      <div
        class="restaurant-card-image relative"
        aria-hidden="true"
        <?php if ($cardHeroUrl !== ''): ?>
          style="background-image: url('<?= e($cardHeroUrl) ?>'); background-size: cover; background-position: center;"
        <?php endif; ?>
      >
        <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-white/95 backdrop-blur-xs text-dark shadow-2xs">
          <span class="w-1.5 h-1.5 rounded-full <?= $cardStatus['is_open'] ? 'bg-[#6F8064]' : 'bg-dark/40' ?>"></span>
          <?= e($cardStatus['label']) ?>
        </span>
        <span class="absolute top-3 right-3 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold tracking-wider bg-dark/90 backdrop-blur-xs text-white uppercase shadow-2xs">
          <?= e($restaurant->getAtlasStopCode()) ?>
        </span>
      </div>
    </a>
    <button type="button" class="<?= e($favClass) ?>" aria-label="<?= e($favLabel) ?>" aria-pressed="<?= e($favPressed) ?>">
      <span aria-hidden="true">&hearts;</span>
    </button>
  </div>

  <a href="<?= e($cardHref) ?>" class="card-link-wrapper" aria-label="View <?= e($cardName) ?>">
    <div class="restaurant-card-content">
      <h3 class="text-lead"><?= e($cardName) ?></h3>
      <p class="text-xs text-dark/65 mb-1">
        <?= e($cardCategory) ?><?= $cardCuisine !== null ? ' &middot; ' . e($cardCuisine) : '' ?>
      </p>
      <p class="text-meta text-muted">
        <?php if ($cardRatingNumber !== null): ?>
          <span aria-hidden="true">&#9733;</span> <?= e($cardRatingNumber) ?>
        <?php else: ?>
          <span>Verified menu</span>
        <?php endif; ?>
        <?php if ($cardDistanceText !== null): ?>
          &middot; <?= e($cardDistanceText) ?>
        <?php endif; ?>
        <?php if ($cardRatingNumber !== null || $cardDistanceText !== null): ?>
          <span class="text-[11px] text-dark/45">&middot; Demo/Est.</span>
        <?php endif; ?>
      </p>
    </div>
  </a>

  <!-- Card Actions -->
  <div class="px-4 py-2.5 border-t border-dark/8 flex items-center justify-between gap-2">
    <button
      type="button"
      class="btn-focus-map text-xs font-medium text-dark/70 hover:text-terracotta transition-colors cursor-pointer bg-transparent border-0 p-0"
      data-focus-restaurant="<?= e($cardId) ?>"
      aria-label="Locate <?= e($cardName) ?> on map"
    >
      Focus on Map
    </button>

    <button
      type="button"
      class="btn-quest-checkin inline-flex items-center px-2.5 py-1 rounded-full bg-dark/[0.04] hover:bg-terracotta hover:text-white hover:border-terracotta text-dark/80 text-[11px] font-medium transition-colors cursor-pointer border border-dark/12"
      data-checkin-restaurant="<?= e($cardId) ?>"
      data-restaurant-name="<?= e($cardName) ?>"
    >
      <span>Check In &middot; +25 XP</span>
    </button>
  </div>
</article>
