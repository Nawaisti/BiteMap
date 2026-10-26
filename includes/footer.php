<?php
/**
 * BiteMap - Shared Site Footer
 * Sprint 04 PHP Server-Side Adaptation
 *
 * Supported variables:
 * @var string $basePath (optional, '' for root or '../' for pages/)
 * @var string $extraScripts (optional extra script tags before closing body)
 */

if (!isset($basePath)) {
    $basePath = '';
}
?>
  <!-- ===== SITE FOOTER ===== -->
  <footer class="site-footer bg-dark text-cream pt-12 pb-8">
    <div class="container max-w-[1200px] mx-auto px-4 md:px-6">
      <div class="footer-inner grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr] gap-8 lg:gap-10 items-start pb-8 border-b border-cream/10">

        <!-- Brand column -->
        <div class="footer-brand col-span-1 md:col-span-2 lg:col-span-1">
          <a href="<?= e($basePath) ?>index.php" class="footer-logo inline-block mb-3" aria-label="BiteMap home">
            <span class="logo-text text-xl font-bold tracking-[0.08em] text-cream">BITEMAP</span>
          </a>
          <p class="text-sm leading-relaxed text-cream/60 max-w-[24ch]">Find your next favorite place.</p>
        </div>

        <!-- Discover navigation group -->
        <nav class="footer-nav-group" aria-label="Discover">
          <h3 class="text-xs font-semibold tracking-[0.1em] uppercase text-cream/45 mb-4">Discover</h3>
          <ul class="flex flex-col gap-3" role="list">
            <li><a href="<?= e($basePath) ?>pages/explore.php" class="text-sm text-cream/65 hover:text-cream hover:opacity-100 focus-visible:text-cream focus-visible:opacity-100 transition-opacity transition-colors duration-150">Explore Restaurants</a></li>
          </ul>
        </nav>

        <!-- Account navigation group -->
        <nav class="footer-nav-group" aria-label="Account">
          <h3 class="text-xs font-semibold tracking-[0.1em] uppercase text-cream/45 mb-4">Account</h3>
          <ul class="flex flex-col gap-3" role="list">
            <li><a href="<?= e($basePath) ?>pages/login.html" class="text-sm text-cream/65 hover:text-cream hover:opacity-100 focus-visible:text-cream focus-visible:opacity-100 transition-opacity transition-colors duration-150">Sign In</a></li>
            <li><a href="<?= e($basePath) ?>pages/register.html" class="text-sm text-cream/65 hover:text-cream hover:opacity-100 focus-visible:text-cream focus-visible:opacity-100 transition-opacity transition-colors duration-150">Join Free</a></li>
          </ul>
        </nav>

      </div>
      <div class="footer-bottom flex items-center justify-between flex-wrap gap-4 pt-6">
        <p class="footer-copy text-xs text-cream/40">&copy; 2026 BiteMap. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Local environment config (git-ignored, optional) -->
  <script src="<?= e($basePath) ?>js/config.local.js" onerror="this.remove()"></script>
  <script src="<?= e($basePath) ?>js/main.js" defer></script>
  <?= $extraScripts ?? '' ?>
</body>
</html>
