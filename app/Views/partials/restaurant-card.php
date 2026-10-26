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
$cardQuests = Quest::forRestaurant($cardId);
$primaryQuest = $cardQuests[0] ?? null;

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
  <button type="button" class="<?= e($favClass) ?>" aria-label="<?= e($favLabel) ?>" aria-pressed="<?= e($favPressed) ?>">
    <span aria-hidden="true">&hearts;</span>
  </button>

  <a href="<?= e($cardHref) ?>" class="card-link-wrapper" aria-label="View <?= e($cardName) ?>">
    <div
      class="restaurant-card-image relative"
      aria-hidden="true"
      <?php if ($cardHeroUrl !== ''): ?>
        style="background-image: url('<?= e($cardHeroUrl) ?>'); background-size: cover; background-position: center;"
      <?php endif; ?>
    >
      <!-- Live Hours Badge (Verified Hours) -->
      <span class="absolute top-3 left-3 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold shadow-xs <?= $cardStatus['is_open'] ? 'bg-[#6F8064] text-white' : 'bg-dark/80 text-cream' ?>">
        <?= e($cardStatus['label']) ?>
      </span>

      <?php if ($primaryQuest !== null): ?>
        <span class="absolute bottom-2.5 left-3 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/95 backdrop-blur-xs text-dark text-[10px] font-bold shadow-xs border border-terracotta/25">
          <span><?= e($primaryQuest->getBadgeIcon()) ?></span>
          <span>Quest: <?= e($primaryQuest->getTitle()) ?></span>
        </span>
      <?php endif; ?>
    </div>

    <div class="restaurant-card-content">
      <h3 class="text-lead"><?= e($cardName) ?></h3>
      <p class="text-small text-muted" style="margin-bottom: var(--space-1);">
        <?= e($cardCategory) ?><?= $cardCuisine !== null ? ' &bull; ' . e($cardCuisine) : '' ?>
      </p>
      <p class="text-meta text-muted" title="Illustrative rating & estimated distance from Malang City Center">
        <?php if ($cardRatingNumber !== null): ?>
          <span class="rating-icon" aria-hidden="true">&#9733;</span> <?= e($cardRatingNumber) ?> <span class="text-[10px] opacity-75">(Demo)</span>
        <?php else: ?>
          <span>Verified Menu</span>
        <?php endif; ?>
        <?php if ($cardDistanceText !== null): ?>
          &bull; <?= e($cardDistanceText) ?> <span class="text-[10px] opacity-75">(Est.)</span>
        <?php endif; ?>
      </p>
    </div>
  </a>

  <!-- Map-First & Culinary Quest Action Bar -->
  <div class="px-4 pb-3.5 pt-2 border-t border-dark/8 flex items-center justify-between gap-2 bg-cream/35">
    <button
      type="button"
      class="btn-focus-map inline-flex items-center gap-1 text-xs font-semibold text-terracotta hover:underline cursor-pointer bg-transparent border-0 p-0"
      data-focus-restaurant="<?= e($cardId) ?>"
      aria-label="Locate <?= e($cardName) ?> on map"
    >
      <span aria-hidden="true">&#128205;</span> Focus on Map
    </button>

    <button
      type="button"
      class="btn-quest-checkin inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-terracotta/10 hover:bg-terracotta hover:text-white text-terracotta text-[11px] font-semibold transition-colors cursor-pointer border border-terracotta/20"
      data-checkin-restaurant="<?= e($cardId) ?>"
      data-restaurant-name="<?= e($cardName) ?>"
    >
      <span>&#10003; Check In (+25 XP)</span>
    </button>
  </div>
</article>
