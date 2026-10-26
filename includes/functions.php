<?php
/**
 * BiteMap - Core Helper Functions (Sprint 05 Object-Oriented PHP Integration)
 * Bridges procedural templates with Week 6 OOP Domain Models.
 */

declare(strict_types=1);

require_once __DIR__ . '/../classes/MenuItem.php';
require_once __DIR__ . '/../classes/Restaurant.php';

/**
 * Escapes a string for safe HTML output (prevents XSS).
 */
function e(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

/**
 * Loads and returns all canonical restaurants from data/restaurants.php as domain objects.
 * Uses static caching to avoid repeated filesystem reads during a request.
 *
 * @return array<int, Restaurant>
 */
function getRestaurants(): array
{
    static $restaurants = null;

    if ($restaurants === null) {
        $dataFile = __DIR__ . '/../data/restaurants.php';
        if (file_exists($dataFile)) {
            $data = require $dataFile;
            $list = is_array($data) ? $data : [];
            $restaurants = [];
            foreach ($list as $item) {
                if ($item instanceof Restaurant) {
                    $restaurants[] = $item;
                } elseif (is_array($item)) {
                    $restaurants[] = Restaurant::fromArray($item);
                }
            }
        } else {
            $restaurants = [];
        }
    }

    return $restaurants;
}

/**
 * Finds a single canonical restaurant domain object by its unique ID.
 * Returns null if not found.
 *
 * @param string|null $id
 * @return Restaurant|null
 */
function getRestaurantById(?string $id): ?Restaurant
{
    if ($id === null || trim($id) === '') {
        return null;
    }

    $cleanId = trim($id);
    $restaurants = getRestaurants();

    foreach ($restaurants as $restaurant) {
        $rId = $restaurant instanceof Restaurant ? $restaurant->getId() : ($restaurant['id'] ?? null);
        if ($rId === $cleanId) {
            return $restaurant instanceof Restaurant ? $restaurant : Restaurant::fromArray($restaurant);
        }
    }

    return null;
}

/**
 * Formats restaurant rating as HTML.
 * Delegates to Restaurant::getFormattedRating() when given a domain model.
 *
 * @param Restaurant|array<string, mixed> $restaurant
 * @return string
 */
function formatRestaurantRating(Restaurant|array $restaurant): string
{
    if ($restaurant instanceof Restaurant) {
        return $restaurant->getFormattedRating();
    }

    if (isset($restaurant['rating']) && is_numeric($restaurant['rating'])) {
        $formatted = number_format((float)$restaurant['rating'], 1);
        return '<span class="rating-icon" aria-hidden="true">&#9733;</span> ' . $formatted;
    }

    return '<span>New &middot; No reviews yet</span>';
}

/**
 * Formats restaurant distance if available.
 * Delegates to Restaurant::getFormattedDistance() when given a domain model.
 *
 * @param Restaurant|array<string, mixed> $restaurant
 * @return string|null
 */
function formatRestaurantDistance(Restaurant|array $restaurant): ?string
{
    if ($restaurant instanceof Restaurant) {
        return $restaurant->getFormattedDistance();
    }

    if (isset($restaurant['distance']) && $restaurant['distance'] !== null) {
        if (is_numeric($restaurant['distance'])) {
            return number_format((float)$restaurant['distance'], 1) . ' km';
        }
        $str = trim((string)$restaurant['distance']);
        return $str !== '' ? $str : null;
    }

    return null;
}

/**
 * Checks if restaurant has reservation capability enabled.
 * Delegates to Restaurant::hasReservationCapability() when given a domain model.
 *
 * @param Restaurant|array<string, mixed> $restaurant
 * @return bool
 */
function hasReservationCapability(Restaurant|array $restaurant): bool
{
    if ($restaurant instanceof Restaurant) {
        return $restaurant->hasReservationCapability();
    }

    return !empty($restaurant['reservation_enabled']);
}

/**
 * Evaluates whether a restaurant is currently open based on operating hours.
 * Delegates to Restaurant::isOpenNow() when given a domain model.
 *
 * @param Restaurant|array<string, mixed> $restaurant
 * @param DateTimeInterface|null $now
 * @return bool
 */
function isRestaurantOpenNow(Restaurant|array $restaurant, ?DateTimeInterface $now = null): bool
{
    if ($restaurant instanceof Restaurant) {
        return $restaurant->isOpenNow($now);
    }

    if (empty($restaurant['hours']) || !is_array($restaurant['hours'])) {
        return false;
    }

    if ($now === null) {
        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    }

    $dayName = $now->format('l'); // 'Monday' through 'Sunday'
    if (empty($restaurant['hours'][$dayName]) || !is_string($restaurant['hours'][$dayName])) {
        return false;
    }

    $todayHours = $restaurant['hours'][$dayName];

    // Check for 24-hour service
    if (preg_match('/24\s*(jam|hours?)/i', $todayHours) ||
        str_contains($todayHours, '00:00 – 24:00') ||
        str_contains($todayHours, '00:00 - 24:00')) {
        return true;
    }

    // Match standard time ranges like "10:00 – 22:00" or "10:00 - 23:00"
    if (preg_match('/(\d{1,2}):(\d{2})\s*[–—-]\s*(\d{1,2}):(\d{2})/u', $todayHours, $matches)) {
        $currentMins = (int)$now->format('G') * 60 + (int)$now->format('i');
        $openMins = (int)$matches[1] * 60 + (int)$matches[2];
        $closeMins = (int)$matches[3] * 60 + (int)$matches[4];

        if ($closeMins < $openMins) {
            // Operates past midnight
            return $currentMins >= $openMins || $currentMins < $closeMins;
        }

        return $currentMins >= $openMins && $currentMins < $closeMins;
    }

    return false;
}

/**
 * Resolves an asset path with appropriate relative directory prefix.
 *
 * @param string|null $relativePath Path to asset (e.g. 'assets/restaurants/...')
 * @param string $basePath Base path prefix ('' at root, '../' in pages/)
 * @return string
 */
function getAssetPath(?string $relativePath, string $basePath = ''): string
{
    if ($relativePath === null || trim($relativePath) === '') {
        return '';
    }

    $clean = trim($relativePath);

    // Absolute URLs or data URIs remain untouched
    if (str_starts_with($clean, 'http://') ||
        str_starts_with($clean, 'https://') ||
        str_starts_with($clean, 'data:')) {
        return $clean;
    }

    // Strip leading ../ or /
    $normalized = preg_replace('/^(\.\.\/|\/)+/', '', $clean);
    return $basePath . $normalized;
}

/**
 * Returns a concise menu category label without parenthetical explanations.
 * e.g. "Paitan Soup Ramen (Rich and Creamy)" -> "Paitan Soup Ramen"
 *
 * @param string|null $categoryName
 * @return string
 */
function getConciseCategoryLabel(?string $categoryName): string
{
    return trim(preg_replace('/\s*\([^)]*\)\s*$/', '', (string)$categoryName));
}

/**
 * Renders a canonical restaurant card as semantic HTML.
 * Delegates to Restaurant::renderCard() when given a domain model.
 *
 * @param Restaurant|array<string, mixed> $restaurant
 * @param string $linkBase URL destination for card link (e.g. 'pages/restaurant.php' or 'restaurant.php')
 * @param string $assetPrefix Base path for asset URLs ('' or '../')
 * @param bool $isFav Initial favorite state
 * @param float|null $customDistance Custom distance in km if calculated
 * @return string
 */
function renderRestaurantCard(
    Restaurant|array $restaurant,
    string $linkBase = 'restaurant.php',
    string $assetPrefix = '',
    bool $isFav = false,
    ?float $customDistance = null
): string {
    if ($restaurant instanceof Restaurant) {
        return $restaurant->renderCard($linkBase, $assetPrefix, $isFav, $customDistance);
    }

    $id = e($restaurant['id'] ?? '');
    $name = e($restaurant['name'] ?? '');
    $category = e($restaurant['category'] ?? '');
    $href = e($linkBase . '?id=' . urlencode($restaurant['id'] ?? ''));

    // Rating & Distance metadata
    $metaParts = [formatRestaurantRating($restaurant)];
    $distText = null;
    if ($customDistance !== null) {
        $distText = number_format($customDistance, 1) . ' km';
    } else {
        $distText = formatRestaurantDistance($restaurant);
    }
    if ($distText !== null) {
        $metaParts[] = e($distText);
    }
    $metaHtml = implode(' &bull; ', $metaParts);

    // Favorite button attributes
    $favClass = $isFav ? 'btn-favorite is-active' : 'btn-favorite';
    $favLabel = $isFav ? "Remove {$name} from favorites" : "Save {$name} to favorites";
    $favPressed = $isFav ? 'true' : 'false';

    // Hero image styling
    $rawImage = $restaurant['hero_image'] ?? ($restaurant['image'] ?? '');
    $imgStyle = '';
    if ($rawImage) {
        $imgPath = e(getAssetPath($rawImage, $assetPrefix));
        $imgStyle = ' style="background-image: url(\'' . $imgPath . '\'); background-size: cover; background-position: center;"';
    }

    return <<<HTML
<article class="restaurant-card" data-id="{$id}" data-restaurant-id="{$id}">
  <button type="button" class="{$favClass}" aria-label="{$favLabel}" aria-pressed="{$favPressed}"><span aria-hidden="true">&hearts;</span></button>
  <a href="{$href}" class="card-link-wrapper" aria-label="View {$name}">
    <div class="restaurant-card-image" aria-hidden="true"{$imgStyle}></div>
    <div class="restaurant-card-content">
      <h3 class="text-lead">{$name}</h3>
      <p class="text-small text-muted" style="margin-bottom: var(--space-1);">{$category}</p>
      <p class="text-meta text-muted">{$metaHtml}</p>
    </div>
  </a>
</article>
HTML;
}
