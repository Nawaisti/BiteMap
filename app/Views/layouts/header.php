<?php
/**
 * BiteMap — Shared Layout Header View (app/Views/layouts/header.php)
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
$pageTitle = $pageTitle ?? 'BiteMap — Find your next favorite place.';
$pageDescription = $pageDescription ?? 'BiteMap — Find your next favorite place. Discover, explore, and reserve at the best restaurants near you.';
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
  <header class="site-header sticky top-0 z-40 h-[72px] bg-cream/95 backdrop-blur-sm border-b border-dark/15">
    <nav class="nav-primary flex items-center justify-between h-full max-w-[1200px] mx-auto px-4 md:px-6 xl:px-8 gap-6 md:gap-8" aria-label="Primary navigation">
      <a href="<?= e($basePath) ?>index.php" class="nav-logo shrink-0" aria-label="BiteMap home">
        <span class="logo-text text-xl font-bold tracking-[0.08em] text-dark">BITEMAP</span>
      </a>

      <ul class="nav-links hidden max-md:[&.nav-open]:flex max-md:absolute max-md:top-[72px] max-md:left-0 max-md:right-0 max-md:flex-col max-md:items-start max-md:gap-0 max-md:bg-cream max-md:border-b max-md:border-dark/15 max-md:py-4 max-md:px-4 md:px-6 max-md:z-40 md:flex md:items-center md:gap-8" id="nav-links" role="list">
        <li class="w-full md:w-auto">
          <a href="<?= e($basePath) ?>pages/explore.php" <?= $currentPage === 'explore' ? 'aria-current="page"' : '' ?> class="block w-full py-3 text-base text-dark border-b border-dark/15 font-medium hover:text-terracotta aria-[current=page]:text-terracotta transition-colors duration-150 md:inline md:w-auto md:p-0 md:text-sm md:border-b-0">Explore</a>
        </li>
        <li class="w-full md:w-auto">
          <a href="<?= e($basePath) ?>pages/login.html" <?= $currentPage === 'login' ? 'aria-current="page"' : '' ?> class="block w-full py-3 text-base text-dark border-b border-dark/15 font-medium hover:text-terracotta aria-[current=page]:text-terracotta transition-colors duration-150 md:inline md:w-auto md:p-0 md:text-sm md:border-b-0">Sign In</a>
        </li>
        <li class="w-full md:w-auto">
          <a href="<?= e($basePath) ?>pages/register.html" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] focus-visible:bg-[#B25132] focus-visible:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer w-full mt-3 md:w-auto md:mt-0">Join Free</a>
        </li>
      </ul>

      <!-- Mobile menu toggle -->
      <button
        type="button"
        class="nav-toggle flex md:hidden flex-col gap-[5px] p-2 bg-transparent border-0 cursor-pointer"
        aria-label="Open navigation menu"
        aria-expanded="false"
        aria-controls="nav-links"
      >
        <span class="block w-[22px] h-[2px] bg-dark rounded-full transition-transform duration-250" aria-hidden="true"></span>
        <span class="block w-[22px] h-[2px] bg-dark rounded-full transition-opacity duration-250" aria-hidden="true"></span>
        <span class="block w-[22px] h-[2px] bg-dark rounded-full transition-transform duration-250" aria-hidden="true"></span>
      </button>
    </nav>
  </header>
