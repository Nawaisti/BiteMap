<?php
/**
 * BiteMap — Culinary Quest Shared Header Layout (app/Views/layouts/header.php)
 * Week 5 (Shared Includes) & Week 7 (MVC View Layer)
 *
 * Expected view variables:
 *   @var string $pageTitle
 *   @var string $pageDescription
 *   @var string $basePath
 *   @var string $currentPage
 *   @var string|null $extraHead
 */

declare(strict_types=1);

$basePath = $basePath ?? '';
$currentPage = $currentPage ?? '';
$pageTitle = $pageTitle ?? 'BiteMap — Culinary Quest | Map-First Malang Food Discovery';
$pageDescription = $pageDescription ?? 'BiteMap — Culinary Quest. Explore Malang restaurants on an interactive map, complete culinary quests, earn XP, and unlock badges.';
?>
<!DOCTYPE html>
<html lang="en" data-runtime="php">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= e($pageDescription) ?>" />
  <title><?= e($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= e($basePath) ?>src/output.css" />
  <link rel="stylesheet" href="<?= e($basePath) ?>css/style.css" />
  <link rel="stylesheet" href="<?= e($basePath) ?>css/responsive.css" />
  <?= $extraHead ?? '' ?>
</head>
<body>

  <!-- Skip to main content — keyboard accessibility -->
  <a class="skip-to-content" href="#main-content">Skip to content</a>

  <!-- ===== SITE HEADER ===== -->
  <header class="site-header sticky top-0 z-40 h-16 bg-cream/95 backdrop-blur-sm border-b border-dark/10">
    <nav class="nav-primary flex items-center justify-between h-full max-w-[1280px] mx-auto px-4 md:px-6 xl:px-8 gap-3 md:gap-6" aria-label="Primary navigation">
      <a href="<?= e($basePath) ?>index.php" class="nav-logo shrink-0 inline-flex items-baseline gap-2 no-underline" aria-label="BiteMap Culinary Quest home">
        <span class="logo-text text-lg sm:text-xl font-bold tracking-[0.08em] text-dark">BITEMAP</span>
        <span class="text-[11px] font-medium text-dark/55 tracking-wide">Culinary Quest</span>
      </a>

      <div class="flex items-center gap-3 md:gap-6">
        <ul class="nav-links hidden max-md:[&.nav-open]:flex max-md:absolute max-md:top-16 max-md:left-0 max-md:right-0 max-md:flex-col max-md:items-start max-md:gap-0 max-md:bg-cream max-md:border-b max-md:border-dark/10 max-md:py-3 max-md:px-4 max-md:shadow-md max-md:z-40 md:flex md:items-center md:gap-6" id="nav-links" role="list">
          <li class="w-full md:w-auto">
            <a href="<?= e($basePath) ?>pages/explore.php" <?= $currentPage === 'explore' ? 'aria-current="page"' : '' ?> class="block w-full py-2.5 text-sm text-dark/80 border-b border-dark/8 font-medium hover:text-dark aria-[current=page]:text-terracotta aria-[current=page]:font-semibold transition-colors md:inline md:w-auto md:p-0 md:border-b-0">Explore</a>
          </li>
          <li class="w-full md:w-auto">
            <a href="<?= e($basePath) ?>index.php#quests-section" class="block w-full py-2.5 text-sm text-dark/80 border-b border-dark/8 font-medium hover:text-dark transition-colors md:inline md:w-auto md:p-0 md:border-b-0">Quests</a>
          </li>
          <li class="w-full md:w-auto">
            <a href="<?= e($basePath) ?>pages/dashboard.html" <?= $currentPage === 'dashboard' ? 'aria-current="page"' : '' ?> class="block w-full py-2.5 text-sm text-dark/80 border-b border-dark/8 font-medium hover:text-dark aria-[current=page]:text-terracotta aria-[current=page]:font-semibold transition-colors md:inline md:w-auto md:p-0 md:border-b-0">Profile</a>
          </li>
          <li class="w-full md:w-auto">
            <a href="<?= e($basePath) ?>pages/login.html" <?= $currentPage === 'login' ? 'aria-current="page"' : '' ?> class="block w-full py-2.5 text-sm text-dark/80 font-medium hover:text-dark aria-[current=page]:text-terracotta aria-[current=page]:font-semibold transition-colors md:inline md:w-auto md:p-0">Sign In</a>
          </li>
        </ul>

        <!-- Understated Player Progress Indicator (Updated dynamically by js/main.js) -->
        <a
          href="<?= e($basePath) ?>index.php#quests-section"
          id="nav-player-hud"
          class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-dark/[0.04] border border-dark/10 text-xs font-medium text-dark/75 hover:text-dark hover:border-dark/25 transition-colors no-underline shrink-0"
          title="View quest progress"
        >
          <span class="font-semibold text-dark" data-hud="level-badge">Lv. 1</span>
          <span class="text-dark/30" aria-hidden="true">&middot;</span>
          <span data-hud="xp-text">0 XP</span>
        </a>

        <!-- Mobile menu toggle -->
        <button
          type="button"
          class="nav-toggle flex md:hidden flex-col gap-[5px] p-2 bg-transparent border-0 cursor-pointer shrink-0"
          aria-label="Open navigation menu"
          aria-expanded="false"
          aria-controls="nav-links"
        >
          <span class="block w-[20px] h-[2px] bg-dark rounded-full transition-transform duration-200" aria-hidden="true"></span>
          <span class="block w-[20px] h-[2px] bg-dark rounded-full transition-opacity duration-200" aria-hidden="true"></span>
          <span class="block w-[20px] h-[2px] bg-dark rounded-full transition-transform duration-200" aria-hidden="true"></span>
        </button>
      </div>
    </nav>
  </header>
