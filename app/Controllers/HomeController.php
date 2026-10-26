<?php
/**
 * BiteMap — HomeController (app/Controllers/HomeController.php)
 * Week 7 (Vanilla PHP MVC — Controller Layer)
 *
 * Orchestrates the Homepage request:
 *   User -> Request (index.php) -> HomeController::index() -> Restaurant::all() -> app/Views/home/index.php
 */

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/functions.php';

class HomeController
{
    /**
     * Renders the BiteMap Homepage with curated discovery rails.
     */
    public function index(): void
    {
        $pageTitle = 'BiteMap — Find your next favorite place.';
        $pageDescription = 'BiteMap — Find your next favorite place. Discover, explore, and reserve at the best restaurants near you.';
        $basePath = '';
        $currentPage = 'home';

        // Fetch domain objects from the Model layer
        $allRestaurants = Restaurant::all();

        // Rail 1: Featured in Malang (up to 5 verified spots)
        $featuredRestaurants = array_slice($allRestaurants, 0, 5);

        // Rail 2: Asian Dining & Specialties
        $asianRestaurants = array_values(array_filter(
            $allRestaurants,
            static fn(Restaurant $r): bool => in_array($r->getCategory(), ['Asian Food', 'Restaurant'], true)
        ));

        // Rail 3: Late Night & Quick Cravings
        $quickRestaurants = array_values(array_filter(
            $allRestaurants,
            static fn(Restaurant $r): bool => $r->getCategory() === 'Fast Food'
        ));

        // Render the Homepage View
        require dirname(__DIR__) . '/Views/home/index.php';
    }
}
