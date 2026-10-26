<?php
/**
 * BiteMap — Culinary Quest Card View Partial (app/Views/partials/quest-card.php)
 * Week 6 (Quest Object -> View -> HTML) & Week 7 (MVC View Partial) + Phase C (Culinary Quest MVP)
 *
 * Expected view variables:
 *   @var Quest  $quest           Domain object instance
 *   @var string $questLinkPrefix Prefix for restaurant detail links (e.g. 'pages/' or '')
 */

declare(strict_types=1);

$questLinkPrefix = $questLinkPrefix ?? 'pages/';
$questId = $quest->getId();
$isLockedDefault = $quest->isLockedByDefault();
$objectives = $quest->getObjectives();
$objCount = $quest->getObjectiveCount();
?>
<article
  class="quest-card bg-white rounded-xl border border-dark/10 p-5 flex flex-col justify-between gap-3 transition-colors duration-200 hover:border-dark/20"
  data-quest-card="<?= e($questId) ?>"
  data-quest-min-xp="<?= e((string) $quest->getMinXp()) ?>"
  data-quest-req-level="<?= e((string) $quest->getRequiredLevel()) ?>"
  data-quest-xp-reward="<?= e((string) $quest->getXpReward()) ?>"
  data-quest-badge-id="<?= e($quest->getBadgeId()) ?>"
>
  <div>
    <!-- Status & XP Reward -->
    <div class="flex items-center justify-between gap-2 mb-2.5">
      <span
        class="quest-state-badge inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium <?= $isLockedDefault ? 'bg-dark/6 text-dark/55' : 'bg-terracotta/10 text-terracotta' ?>"
        data-quest-state="<?= e($questId) ?>"
      >
        <?= $isLockedDefault ? 'Locked &middot; Lv. ' . e((string) $quest->getRequiredLevel()) : 'Available' ?>
      </span>

      <span class="text-xs font-semibold text-dark/65">
        +<?= e((string) $quest->getXpReward()) ?> XP
      </span>
    </div>

    <!-- Title & Description -->
    <h3 class="text-base font-semibold text-dark leading-snug mb-1"><?= e($quest->getTitle()) ?></h3>
    <p class="text-xs text-dark/65 leading-relaxed mb-3.5"><?= e($quest->getDescription()) ?></p>

    <!-- Progress Indicator -->
    <div class="mb-3.5">
      <div class="flex items-center justify-between text-[11px] font-medium text-dark/60 mb-1">
        <span>Progress</span>
        <span data-quest-progress-text="<?= e($questId) ?>">0 / <?= e((string) $objCount) ?></span>
      </div>
      <div class="w-full h-1.5 rounded-full bg-dark/8 overflow-hidden">
        <div
          class="h-full bg-terracotta transition-all duration-300 rounded-full"
          style="width: 0%;"
          data-quest-progress-bar="<?= e($questId) ?>"
        ></div>
      </div>
    </div>

    <!-- Compact Objective List -->
    <ul class="flex flex-col divide-y divide-dark/6 border-t border-dark/8 pt-1" role="list">
      <?php foreach ($objectives as $obj): ?>
        <?php
        $objId = $obj['id'];
        $targetRestId = $obj['restaurant_id'];
        $actionType = $obj['action_type'];
        ?>
        <li
          class="quest-objective-item flex items-center justify-between gap-3 text-xs py-2"
          data-objective-item="<?= e($objId) ?>"
        >
          <div class="flex items-center gap-2 min-w-0">
            <span
              class="objective-status-icon w-4 h-4 rounded-full border border-dark/25 flex items-center justify-center text-[10px] font-semibold text-dark/40 shrink-0"
              data-objective-icon="<?= e($objId) ?>"
            >&#9675;</span>
            <span class="text-dark/85 truncate" data-objective-label="<?= e($objId) ?>"><?= e($obj['label']) ?></span>
          </div>
          <div class="shrink-0">
            <?php if ($actionType === 'checkin'): ?>
              <button
                type="button"
                class="btn-quest-checkin text-[11px] font-medium text-terracotta hover:underline cursor-pointer bg-transparent border-0 p-0"
                data-checkin-restaurant="<?= e($targetRestId) ?>"
              >Check in</button>
            <?php elseif ($actionType === 'favorite'): ?>
              <button
                type="button"
                class="btn-quest-fav text-[11px] font-medium text-terracotta hover:underline cursor-pointer bg-transparent border-0 p-0"
                data-fav-restaurant="<?= e($targetRestId) ?>"
              >Save</button>
            <?php else: ?>
              <a
                href="<?= e($questLinkPrefix) ?>restaurant.php?id=<?= urlencode($targetRestId) ?>"
                class="text-[11px] font-medium text-dark/65 hover:text-terracotta no-underline transition-colors"
              >View &rarr;</a>
            <?php endif; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</article>
