<?php
/**
 * BiteMap — Restaurant Card View Partial (app/Views/partials/restaurant-card.php)
 * Week 6 (Object -> View -> HTML) & Week 7 (MVC View Partial)
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
$cardHref = $cardLinkBase . '?id=' . urlencode($cardId);
$cardHeroUrl = $restaurant->getHeroImageUrl($cardAssetPrefix);
$cardRatingNumber = $restaurant->getFormattedRatingNumber();
$cardDistanceText = $restaurant->getFormattedDistance();
$favClass = $isFav ? 'btn-favorite is-active' : 'btn-favorite';
$favLabel = $isFav ? "Remove {$cardName} from favorites" : "Save {$cardName} to favorites";
$favPressed = $isFav ? 'true' : 'false';
?>
<article class="restaurant-card" data-id="<?= e($cardId) ?>" data-restaurant-id="<?= e($cardId) ?>">
  <button type="button" class="<?= e($favClass) ?>" aria-label="<?= e($favLabel) ?>" aria-pressed="<?= e($favPressed) ?>">
    <span aria-hidden="true">&hearts;</span>
  </button>
  <a href="<?= e($cardHref) ?>" class="card-link-wrapper" aria-label="View <?= e($cardName) ?>">
    <div
      class="restaurant-card-image"
      aria-hidden="true"
      <?php if ($cardHeroUrl !== ''): ?>
        style="background-image: url('<?= e($cardHeroUrl) ?>'); background-size: cover; background-position: center;"
      <?php endif; ?>
    ></div>
    <div class="restaurant-card-content">
      <h3 class="text-lead"><?= e($cardName) ?></h3>
      <p class="text-small text-muted" style="margin-bottom: var(--space-1);"><?= e($cardCategory) ?></p>
      <p class="text-meta text-muted">
        <?php if ($cardRatingNumber !== null): ?>
          <span class="rating-icon" aria-hidden="true">&#9733;</span> <?= e($cardRatingNumber) ?>
        <?php else: ?>
          <span>New &middot; No reviews yet</span>
        <?php endif; ?>
        <?php if ($cardDistanceText !== null): ?>
          &bull; <?= e($cardDistanceText) ?>
        <?php endif; ?>
      </p>
    </div>
  </a>
</article>
