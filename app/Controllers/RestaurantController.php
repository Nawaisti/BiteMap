<?php
/**
 * BiteMap — RestaurantController (app/Controllers/RestaurantController.php)
 * Week 7 (Vanilla PHP MVC — Controller Layer)
 *
 * Orchestrates the Restaurant Detail request:
 *   User -> Request (pages/restaurant.php?id=...) -> RestaurantController::show($id)
 *        -> Restaurant::findById($id) -> app/Views/restaurant/show.php (or not-found.php)
 */

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/functions.php';

class RestaurantController
{
    /**
     * Displays a single restaurant detail page or a 404 Not Found view.
     */
    public function show(?string $id): void
    {
        $basePath = '../';
        $currentPage = 'restaurant';
        $requestedId = $id !== null ? trim($id) : null;

        // Query the Model layer for the requested restaurant
        $restaurant = Restaurant::findById($requestedId);

        if ($restaurant === null) {
            http_response_code(404);
            $pageTitle = 'Restaurant Not Found — BiteMap';
            $pageDescription = 'The restaurant you are looking for does not exist or may have been removed.';
            require dirname(__DIR__) . '/Views/restaurant/not-found.php';
            return;
        }

        $pageTitle = $restaurant->getName() . ' — BiteMap';
        $pageDescription = $restaurant->getDescription()
            ?? ('View menu, location, opening hours, and details for ' . $restaurant->getName() . ' on BiteMap.');

        // Leaflet CSS & JS for interactive map rendering
        $extraHead = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />';
        $extraScripts = '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>';

        // Evaluate operating hours status via Model domain method
        $todayStatus = $restaurant->getTodayStatus();
        $daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Render the Restaurant Detail View
        require dirname(__DIR__) . '/Views/restaurant/show.php';
    }
}
