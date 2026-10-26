<?php
/**
 * BiteMap — Restaurant Detail Entry Point (pages/restaurant.php)
 * Week 7 (Vanilla PHP MVC Architecture)
 *
 * Request Flow:
 *   User -> pages/restaurant.php?id=... -> RestaurantController::show($id)
 *        -> Restaurant::findById($id) -> app/Views/restaurant/show.php (or not-found.php)
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/Controllers/RestaurantController.php';

$id = isset($_GET['id']) ? (string) $_GET['id'] : null;

$controller = new RestaurantController();
$controller->show($id);
