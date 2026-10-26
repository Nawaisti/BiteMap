<?php
/**
 * BiteMap — Menu Item View Partial (app/Views/partials/menu-item.php)
 * Week 6 (MenuItem Object -> View -> HTML) & Week 7 (MVC View Partial)
 *
 * Expected view variables:
 *   @var MenuItem $item Domain object instance
 */

declare(strict_types=1);

$itemMainPrice = $item->getMainPrice();
$itemPriceNote = $item->getPriceNote();
?>
<div class="menu-item">
  <div class="menu-item-info">
    <h4><?= e($item->getName()) ?></h4>
    <?php if ($item->hasDescription()): ?>
      <p class="text-small text-muted" style="margin-top: var(--space-1);"><?= e($item->getDescription()) ?></p>
    <?php endif; ?>
  </div>
  <?php if ($item->hasPrice()): ?>
    <div class="menu-item-price">
      <?php if ($itemPriceNote !== null): ?>
        <span class="menu-item-price-main"><?= e($itemMainPrice) ?></span>
        <span class="menu-item-price-note"><?= e($itemPriceNote) ?></span>
      <?php else: ?>
        <?= e($itemMainPrice) ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
