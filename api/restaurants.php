<?php
/**
 * BiteMap — REST API Entry Point (api/restaurants.php)
 * Week 4 (REST API & JSON) + Week 7 (Vanilla PHP MVC Architecture)
 *
 * Request Flow:
 *   Client fetch() -> api/restaurants.php -> ApiController::restaurants($_GET) -> Restaurant Model -> JSON Response
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/app/Controllers/ApiController.php';

$controller = new ApiController();
$controller->restaurants($_GET);
