<?php
/**
 * BiteMap — Explore Entry Point (pages/explore.php)
 * Week 7 (Vanilla PHP MVC Architecture)
 *
 * Request Flow:
 *   User -> pages/explore.php -> ExploreController::index($_GET) -> Restaurant::filter() -> app/Views/explore/index.php
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/Controllers/ExploreController.php';

$controller = new ExploreController();
$controller->index($_GET);
