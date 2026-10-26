<?php
/**
 * BiteMap — Restaurant Not Found (404) View (app/Views/restaurant/not-found.php)
 * Week 5 (Conditional Error Handling) & Week 7 (MVC View Layer)
 *
 * Expected view variables from RestaurantController:
 *   @var string      $pageTitle
 *   @var string      $pageDescription
 *   @var string      $basePath
 *   @var string      $currentPage
 *   @var string|null $requestedId
 */

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';
?>
  <main id="main-content" class="py-16 md:py-24 text-center">
    <div class="container max-w-[600px] mx-auto px-4">
      <div class="restaurant-not-found p-8 bg-white rounded-2xl border border-dashed border-dark/20 flex flex-col items-center gap-4">
        <div class="text-4xl text-terracotta" aria-hidden="true">&#9888;</div>
        <h1 class="text-2xl sm:text-3xl font-bold text-dark">Restaurant Not Found</h1>
        <p class="text-dark/65">
          The restaurant<?= !empty($requestedId) ? ' (' . e($requestedId) . ')' : '' ?> you are looking for does not exist or may have been removed.
        </p>
        <a href="explore.php" class="btn btn-primary inline-flex items-center justify-center gap-2 py-3 px-6 border-2 border-terracotta rounded-full text-sm font-semibold text-white bg-terracotta hover:bg-[#B25132] hover:border-[#B25132] transition-colors duration-250 whitespace-nowrap cursor-pointer mt-2">Back to Explore</a>
      </div>
    </div>
  </main>
<?php
require dirname(__DIR__) . '/layouts/footer.php';
