<?php
/**
 * BiteMap — ExploreController (app/Controllers/ExploreController.php)
 * Week 7 (Vanilla PHP MVC — Controller Layer)
 *
 * Orchestrates the Map-First Explore request:
 *   User -> Request (pages/explore.php) -> ExploreController::index($_GET)
 *        -> Restaurant::filter() & Quest::all() -> app/Views/explore/index.php
 */

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/functions.php';

class ExploreController
{
    /**
     * Handles search, category, cuisine, rating, distance, open-now filtering, and sorting
     * for the Map-First Explore Workspace.
     *
     * @param array<string, mixed> $query Query parameters (typically $_GET)
     */
    public function index(array $query = []): void
    {
        $pageTitle = 'Explore Map & Quests — BiteMap Culinary Quest';
        $pageDescription = 'Explore Malang restaurants on an interactive map, filter by category, and track your Culinary Quest objectives.';
        $basePath = '../';
        $currentPage = 'explore';

        // Include Leaflet CSS & JS for the Map-First Explore Canvas
        $extraHead = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />';
        $extraScripts = '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>';

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
        $quests = Quest::all();

        // Render the Map-First Explore View
        require dirname(__DIR__) . '/Views/explore/index.php';
    }
}
