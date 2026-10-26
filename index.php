<?php
/**
 * BiteMap — Homepage Entry Point (index.php)
 * Week 7 (Vanilla PHP MVC Architecture)
 *
 * Request Flow:
 *   User -> index.php -> HomeController::index() -> Restaurant::all() -> app/Views/home/index.php
 */

declare(strict_types=1);

require_once __DIR__ . '/app/Controllers/HomeController.php';

$controller = new HomeController();
$controller->index();
