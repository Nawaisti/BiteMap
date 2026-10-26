<?php
/**
 * BiteMap — ExploreController (app/Controllers/ExploreController.php)
 * Week 7 (Vanilla PHP MVC — Controller Layer)
 *
 * Orchestrates the Explore page request:
 *   User -> Request (pages/explore.php) -> ExploreController::index($_GET) -> Restaurant::filter() -> app/Views/explore/index.php
 */

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/functions.php';

class ExploreController
{
    /**
     * Handles search, category, cuisine, rating, distance, open-now filtering, and sorting.
     *
     * @param array<string, mixed> $query Query parameters (typically $_GET)
     */
    public function index(array $query = []): void
    {
        $pageTitle = 'Explore — BiteMap';
        $pageDescription = 'Explore restaurants on BiteMap — search, filter by category, and discover your next favorite place.';
        $basePath = '../';
        $currentPage = 'explore';

        $filters = [
            'q' => isset($query['q']) ? trim((string) $query['q']) : '',
            'loc' => isset($query['loc']) && trim((string) $query['loc']) !== '' ? trim((string) $query['loc']) : 'Malang',
            'category' => isset($query['category']) ? trim((string) $query['category']) : '',
            'cuisine' => isset($query['cuisine']) ? trim((string) $query['cuisine']) : '',
            'distance' => isset($query['distance']) ? trim((string) $query['distance']) : '',
            'rating' => isset($query['rating']) ? trim((string) $query['rating']) : '',
            'open_now' => isset($query['open_now']) && in_array(strtolower(trim((string) $query['open_now'])), ['1', 'true', 'yes', 'on'], true),
            'sort' => isset($query['sort']) && trim((string) $query['sort']) !== '' ? trim((string) $query['sort']) : 'Recommended',
        ];

        // Query the Model layer with normalized filter parameters
        $restaurants = Restaurant::filter($filters);
        $restaurantCount = count($restaurants);

        // Render the Explore View
        require dirname(__DIR__) . '/Views/explore/index.php';
    }
}
