<?php
/**
 * BiteMap — HomeController (app/Controllers/HomeController.php)
 * Week 7 (Vanilla PHP MVC — Controller Layer)
 *
 * Orchestrates the BiteMap — Culinary Quest Homepage request:
 *   User -> Request (index.php) -> HomeController::index()
 *        -> Restaurant::all() & Quest::all() -> app/Views/home/index.php
 */

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/functions.php';

class HomeController
{
    /**
     * Renders the BiteMap — Culinary Quest Homepage with Map-First Hero, Quests Board,
     * Achievement Badges, and Curated Malang Discovery Rails.
     */
    public function index(): void
    {
        $pageTitle = 'BiteMap — Culinary Quest | Map-First Malang Food Discovery';
        $pageDescription = 'BiteMap — Culinary Quest. Explore Malang restaurants on an interactive map, complete culinary quests, earn XP, and unlock badges.';
        $basePath = '';
        $currentPage = 'home';

        // Include Leaflet CSS & JS for the interactive Hero Quest Map
        $extraHead = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />';
        $extraScripts = '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>';

        // Fetch domain objects from the Model layer
        $allRestaurants = Restaurant::all();
        $quests = Quest::all();

        // Rail 1: Featured in Malang (all verified spots)
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
