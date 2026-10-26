<?php
/**
 * BiteMap — Procedural Helper Library
 * Week 5 (Procedural PHP Foundation) + Week 6–7 (Domain Model Bridge)
 *
 * Provides reusable procedural functions for output escaping, currency/category
 * formatting, asset path resolution, time-range evaluation, and repository lookups.
 *
 * Strictly free of HTML markup to maintain clean separation between business logic
 * and View templates.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/Models/MenuItem.php';
require_once dirname(__DIR__) . '/app/Models/Restaurant.php';
require_once dirname(__DIR__) . '/app/Models/Quest.php';

/**
 * Escapes a string for safe HTML output (prevents XSS — Week 5).
 */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Formats a numeric or string value as Indonesian Rupiah (e.g. 38000 -> "Rp 38.000").
 */
function formatRupiah(int|float|string $amount): string
{
    if (is_numeric($amount)) {
        return 'Rp ' . number_format((float) $amount, 0, ',', '.');
    }
    return trim((string) $amount);
}

/**
 * Converts a category label into a URL/DOM-safe slug (e.g. "Cafe & Coffee" -> "cafe-coffee").
 */
function slugifyCategory(string $text): string
{
    $slug = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($text)));
    return trim((string) $slug, '-');
}

/**
 * Returns the English weekday name in Asia/Jakarta timezone ('Monday'..'Sunday').
 */
function getTodayDayName(?DateTimeInterface $now = null): string
{
    if ($now === null) {
        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    }
    return $now->format('l');
}

/**
 * Evaluates whether a time range string (e.g. "09:00 – 23:00" or "24 jam") is currently open.
 */
function isTimeRangeOpenNow(string $hoursString, ?DateTimeInterface $now = null): bool
{
    $clean = trim($hoursString);
    if ($clean === '') {
        return false;
    }

    if (
        preg_match('/24\s*(jam|hours?)/i', $clean) ||
        str_contains($clean, '00:00 – 24:00') ||
        str_contains($clean, '00:00 - 24:00')
    ) {
        return true;
    }

    if ($now === null) {
        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    }

    if (preg_match('/(\d{1,2}):(\d{2})\s*[–—-]\s*(\d{1,2}):(\d{2})/u', $clean, $matches)) {
        $currentMins = (int) $now->format('G') * 60 + (int) $now->format('i');
        $openMins = (int) $matches[1] * 60 + (int) $matches[2];
        $closeMins = (int) $matches[3] * 60 + (int) $matches[4];

        if ($closeMins < $openMins) {
            return $currentMins >= $openMins || $currentMins < $closeMins;
        }
        return $currentMins >= $openMins && $currentMins < $closeMins;
    }

    return false;
}

/**
 * Returns all canonical restaurants as Restaurant domain objects.
 *
 * @return array<int, Restaurant>
 */
function getRestaurants(): array
{
    return Restaurant::all();
}

/**
 * Finds a single canonical restaurant domain object by its unique ID.
 */
function getRestaurantById(?string $id): ?Restaurant
{
    return Restaurant::findById($id);
}

/**
 * Filters and sorts restaurants by query parameters.
 *
 * @param array<string, mixed> $params
 * @return array<int, Restaurant>
 */
function filterRestaurants(array $params = []): array
{
    return Restaurant::filter($params);
}

/**
 * Formats restaurant distance if available (plain text, e.g. "0.8 km").
 *
 * @param Restaurant|array<string, mixed> $restaurant
 */
function formatRestaurantDistance(Restaurant|array $restaurant): ?string
{
    if ($restaurant instanceof Restaurant) {
        return $restaurant->getFormattedDistance();
    }

    if (isset($restaurant['distance']) && $restaurant['distance'] !== null) {
        if (is_numeric($restaurant['distance'])) {
            return number_format((float) $restaurant['distance'], 1) . ' km';
        }
        $str = trim((string) $restaurant['distance']);
        return $str !== '' ? $str : null;
    }

    return null;
}

/**
 * Checks if a restaurant has online table reservations enabled.
 *
 * @param Restaurant|array<string, mixed> $restaurant
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
 *
 * @param Restaurant|array<string, mixed> $restaurant
 */
function isRestaurantOpenNow(Restaurant|array $restaurant, ?DateTimeInterface $now = null): bool
{
    if ($restaurant instanceof Restaurant) {
        return $restaurant->isOpenNow($now);
    }

    if (empty($restaurant['hours']) || !is_array($restaurant['hours'])) {
        return false;
    }

    $dayName = getTodayDayName($now);
    if (empty($restaurant['hours'][$dayName]) || !is_string($restaurant['hours'][$dayName])) {
        return false;
    }

    return isTimeRangeOpenNow($restaurant['hours'][$dayName], $now);
}

/**
 * Resolves an asset path with an optional relative directory prefix.
 */
function getAssetPath(?string $relativePath, string $basePath = ''): string
{
    if ($relativePath === null || trim($relativePath) === '') {
        return '';
    }

    $clean = trim($relativePath);

    if (
        str_starts_with($clean, 'http://') ||
        str_starts_with($clean, 'https://') ||
        str_starts_with($clean, 'data:')
    ) {
        return $clean;
    }

    $normalized = preg_replace('/^(\.\.\/|\/)+/', '', $clean);
    return $basePath . $normalized;
}

/**
 * Returns a concise menu category label without parenthetical explanations.
 * Example: "Paitan Soup Ramen (Rich and Creamy)" -> "Paitan Soup Ramen"
 */
function getConciseCategoryLabel(?string $categoryName): string
{
    return trim((string) preg_replace('/\s*\([^)]*\)\s*$/', '', (string) $categoryName));
}

/**
 * Returns all canonical Culinary Quests as Quest domain objects.
 *
 * @return array<int, Quest>
 */
function getQuests(): array
{
    return Quest::all();
}

/**
 * Returns all Culinary Quests associated with a given restaurant ID.
 *
 * @return array<int, Quest>
 */
function getQuestsForRestaurant(string $restaurantId): array
{
    return Quest::forRestaurant($restaurantId);
}
