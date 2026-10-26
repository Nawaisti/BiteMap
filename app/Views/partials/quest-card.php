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
  class="quest-card bg-white rounded-2xl border border-dark/12 p-5 shadow-[0_6px_24px_rgba(36,33,29,0.05)] flex flex-col justify-between gap-4 transition-all duration-200 hover:border-terracotta/40"
  data-quest-card="<?= e($questId) ?>"
  data-quest-min-xp="<?= e((string) $quest->getMinXp()) ?>"
  data-quest-req-level="<?= e((string) $quest->getRequiredLevel()) ?>"
  data-quest-xp-reward="<?= e((string) $quest->getXpReward()) ?>"
  data-quest-badge-id="<?= e($quest->getBadgeId()) ?>"
>
  <div>
    <!-- Top Meta Row: State Badge & XP Reward -->
    <div class="flex items-center justify-between gap-2 flex-wrap mb-3">
      <span
        class="quest-state-badge inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider <?= $isLockedDefault ? 'bg-dark/10 text-dark/60' : 'bg-terracotta/12 text-terracotta' ?>"
        data-quest-state="<?= e($questId) ?>"
      >
        <?= $isLockedDefault ? '&#128274; Locked (Req. Lv. ' . e((string) $quest->getRequiredLevel()) . ')' : '&#9733; Available Quest' ?>
      </span>

      <div class="inline-flex items-center gap-1.5">
        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-[#6F8064]/12 text-[#6F8064] text-xs font-bold">
          +<?= e((string) $quest->getXpReward()) ?> XP Bonus
        </span>
        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-cream border border-dark/10 text-dark text-xs font-semibold" title="Badge Reward: <?= e($quest->getBadgeDescription()) ?>">
          <span><?= e($quest->getBadgeIcon()) ?></span>
          <span><?= e($quest->getBadgeName()) ?></span>
        </span>
      </div>
    </div>

    <!-- Title & Description -->
    <h3 class="text-lg font-bold text-dark leading-snug mb-1.5"><?= e($quest->getTitle()) ?></h3>
    <p class="text-xs sm:text-sm text-dark/70 leading-relaxed mb-4"><?= e($quest->getDescription()) ?></p>

    <!-- Progress Bar -->
    <div class="mb-4">
      <div class="flex items-center justify-between text-xs font-semibold text-dark/75 mb-1.5">
        <span>Objective Progress</span>
        <span data-quest-progress-text="<?= e($questId) ?>">0 / <?= e((string) $objCount) ?> completed</span>
      </div>
      <div class="w-full h-2.5 rounded-full bg-dark/8 overflow-hidden">
        <div
          class="h-full bg-terracotta transition-all duration-300 rounded-full"
          style="width: 0%;"
          data-quest-progress-bar="<?= e($questId) ?>"
        ></div>
      </div>
    </div>

    <!-- Objective Checklist -->
    <ul class="flex flex-col gap-2 border-t border-dark/8 pt-3" role="list">
      <?php foreach ($objectives as $obj): ?>
        <?php
        $objId = $obj['id'];
        $targetRestId = $obj['restaurant_id'];
        $actionType = $obj['action_type'];
        $stepXp = $obj['step_xp'];
        ?>
        <li
          class="quest-objective-item flex items-center justify-between gap-2 text-xs py-1.5 px-2.5 rounded-xl bg-cream/55 border border-dark/6"
          data-objective-item="<?= e($objId) ?>"
        >
          <div class="flex items-center gap-2 min-w-0">
            <span
              class="objective-status-icon w-4 h-4 rounded-full border border-dark/25 flex items-center justify-center text-[10px] font-bold text-dark/40 shrink-0"
              data-objective-icon="<?= e($objId) ?>"
            >&#9675;</span>
            <span class="text-dark font-medium truncate" data-objective-label="<?= e($objId) ?>"><?= e($obj['label']) ?></span>
          </div>
          <div class="flex items-center gap-1.5 shrink-0">
            <span class="text-[10px] font-bold text-[#6F8064]">+<?= e((string) $stepXp) ?> XP</span>
            <?php if ($actionType === 'checkin'): ?>
              <button
                type="button"
                class="btn-quest-checkin px-2 py-0.5 rounded-full bg-terracotta text-white hover:bg-[#B25132] text-[10px] font-semibold cursor-pointer border-0 transition-colors"
                data-checkin-restaurant="<?= e($targetRestId) ?>"
              >Check In</button>
            <?php elseif ($actionType === 'favorite'): ?>
              <button
                type="button"
                class="btn-quest-fav px-2 py-0.5 rounded-full bg-dark text-white hover:bg-terracotta text-[10px] font-semibold cursor-pointer border-0 transition-colors"
                data-fav-restaurant="<?= e($targetRestId) ?>"
              >Save &hearts;</button>
            <?php else: ?>
              <a
                href="<?= e($questLinkPrefix) ?>restaurant.php?id=<?= urlencode($targetRestId) ?>"
                class="px-2 py-0.5 rounded-full bg-white border border-dark/15 hover:border-terracotta text-dark hover:text-terracotta text-[10px] font-semibold no-underline transition-colors"
              >Inspect &rarr;</a>
            <?php endif; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Footer: Verification Transparency Label -->
  <div class="pt-2.5 border-t border-dark/8 flex items-center justify-between gap-2 text-[11px] text-dark/55">
    <span>&#9432; <?= e($quest->getVerificationNote()) ?></span>
  </div>
</article>
