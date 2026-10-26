<?php
/**
 * BiteMap REST API Endpoint — api/restaurants.php
 * Week 4 (REST API & JSON) + Week 5–7 (Server-Side PHP & Domain Model Serialization)
 *
 * Supported Query Parameters:
 *   - id             : Return a single restaurant by slug ID (HTTP 404 if not found)
 *   - q              : Search keyword (matches name, category, cuisine, description, address)
 *   - category       : Filter by category (e.g. "Asian Food", "Restaurant", "Fast Food")
 *   - cuisine        : Filter by cuisine (e.g. "Japanese", "Asian Fusion")
 *   - rating         : Minimum rating threshold (e.g. 4.5)
 *   - distance       : Maximum distance in km (e.g. 1, 2, 5)
 *   - open_now       : "1" or "true" to filter restaurants open at the current time
 *   - sort           : "Recommended" | "Rating" | "Distance" | "Name"
 *   - autocomplete   : Location autocomplete query for Malang culinary corridors
 *   - simulate_error : "1" or "true" to return HTTP 503 for Week 4 Error State demonstration
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// 1. Optional simulated error state for Week 4 Error + Retry UI demonstration
$simulateError = isset($_GET['simulate_error']) && in_array((string) $_GET['simulate_error'], ['1', 'true', 'yes'], true);
if ($simulateError) {
    http_response_code(503);
    echo json_encode([
        'status' => 'error',
        'code' => 'SERVICE_TEMPORARILY_UNAVAILABLE',
        'message' => 'Simulated API service interruption (HTTP 503) for Week 4 error-handling and retry demonstration.',
        'timestamp' => gmdate('c'),
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

require_once __DIR__ . '/../includes/functions.php';

// 2. Location autocomplete endpoint (?autocomplete=...)
if (isset($_GET['autocomplete'])) {
    $locQuery = strtolower(trim((string) $_GET['autocomplete']));
    $malangLocations = [
        [
            'id' => 'loc-malang-city',
            'name' => 'Malang',
            'label' => 'Malang, East Java',
            'formatted' => 'Malang',
            'address_line1' => 'Kota Malang',
            'address_line2' => 'Jawa Timur, Indonesia',
            'city' => 'Malang',
            'state' => 'Jawa Timur',
            'postcode' => '65111',
            'lat' => -7.9666,
            'lon' => 112.6326,
            'result_type' => 'city',
            'confidence' => 1.0,
        ],
        [
            'id' => 'loc-jl-bandung',
            'name' => 'Jl. Bandung Culinary Corridor',
            'label' => 'Jl. Bandung, Klojen, Malang',
            'formatted' => 'Jl. Bandung, Malang',
            'address_line1' => 'Jl. Bandung, Penanggungan',
            'address_line2' => 'Kec. Klojen, Kota Malang 65113',
            'city' => 'Malang',
            'state' => 'Jawa Timur',
            'postcode' => '65113',
            'lat' => -7.9608,
            'lon' => 112.6229,
            'result_type' => 'street',
            'confidence' => 0.98,
        ],
        [
            'id' => 'loc-jl-ijen',
            'name' => 'Jl. Besar Ijen Boulevard',
            'label' => 'Jl. Besar Ijen, Klojen, Malang',
            'formatted' => 'Jl. Besar Ijen, Malang',
            'address_line1' => 'Jl. Besar Ijen, Oro-oro Dowo',
            'address_line2' => 'Kec. Klojen, Kota Malang 65119',
            'city' => 'Malang',
            'state' => 'Jawa Timur',
            'postcode' => '65119',
            'lat' => -7.9659,
            'lon' => 112.6250,
            'result_type' => 'street',
            'confidence' => 0.96,
        ],
        [
            'id' => 'loc-klojen',
            'name' => 'Klojen District',
            'label' => 'Kec. Klojen, Kota Malang',
            'formatted' => 'Klojen, Malang',
            'address_line1' => 'Kecamatan Klojen',
            'address_line2' => 'Kota Malang, Jawa Timur',
            'city' => 'Malang',
            'state' => 'Jawa Timur',
            'postcode' => '65111',
            'lat' => -7.9730,
            'lon' => 112.6280,
            'result_type' => 'district',
            'confidence' => 0.95,
        ],
    ];

    $matchedLocations = array_values(array_filter($malangLocations, static function (array $item) use ($locQuery): bool {
        if ($locQuery === '') {
            return true;
        }
        $haystack = strtolower($item['name'] . ' ' . $item['label'] . ' ' . $item['address_line1'] . ' ' . $item['address_line2']);
        return str_contains($haystack, $locQuery);
    }));

    echo json_encode([
        'status' => 'success',
        'source' => 'BiteMap Location Autocomplete API',
        'count' => count($matchedLocations),
        'results' => $matchedLocations,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Serializes a Restaurant object into an associative array for JSON output.
 *
 * @param Restaurant $r
 * @return array<string, mixed>
 */
function serializeRestaurantForApi(Restaurant $r): array
{
    $arr = $r->toArray();
    $arr['open_now'] = $r->isOpenNow();
    return $arr;
}

// 3. Single restaurant lookup (?id=...)
if (isset($_GET['id']) && trim((string) $_GET['id']) !== '') {
    $id = trim((string) $_GET['id']);
    $restaurant = getRestaurantById($id);
    if ($restaurant === null) {
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'code' => 'RESTAURANT_NOT_FOUND',
            'message' => "No restaurant found matching ID '{$id}'.",
            'timestamp' => gmdate('c'),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode([
        'status' => 'success',
        'source' => 'BiteMap REST API v1',
        'timestamp' => gmdate('c'),
        'data' => serializeRestaurantForApi($restaurant),
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

// 4. Collection filtering & sorting
$query = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$category = isset($_GET['category']) ? trim((string) $_GET['category']) : '';
$cuisine = isset($_GET['cuisine']) ? trim((string) $_GET['cuisine']) : '';
$minRating = isset($_GET['rating']) && is_numeric($_GET['rating']) ? (float) $_GET['rating'] : 0.0;
$maxDistance = isset($_GET['distance']) && is_numeric($_GET['distance']) ? (float) $_GET['distance'] : 999.0;
$openNow = isset($_GET['open_now']) && in_array((string) $_GET['open_now'], ['1', 'true', 'yes'], true);
$sort = isset($_GET['sort']) ? trim((string) $_GET['sort']) : 'Recommended';

$restaurants = getRestaurants();

$filtered = array_values(array_filter($restaurants, static function (Restaurant $r) use (
    $query,
    $category,
    $cuisine,
    $minRating,
    $maxDistance,
    $openNow
): bool {
    if ($query !== '') {
        $qLower = strtolower($query);
        $menuParts = [];
        foreach ($r->getMenu() as $cat) {
            $menuParts[] = (string) ($cat['category'] ?? '');
            foreach (($cat['items'] ?? []) as $item) {
                if ($item instanceof MenuItem) {
                    $menuParts[] = $item->getName();
                } elseif (is_array($item) && isset($item['name'])) {
                    $menuParts[] = (string) $item['name'];
                }
            }
        }
        $haystack = strtolower(
            $r->getName() . ' ' .
            $r->getCategory() . ' ' .
            ($r->getCuisine() ?? '') . ' ' .
            ($r->getDescription() ?? '') . ' ' .
            $r->getLocation() . ' ' .
            implode(' ', $menuParts)
        );
        if (!str_contains($haystack, $qLower)) {
            return false;
        }
    }

    if ($category !== '' && strtolower($category) !== 'category') {
        if (!str_contains(strtolower($r->getCategory()), strtolower($category))) {
            return false;
        }
    }

    if ($cuisine !== '' && strtolower($cuisine) !== 'cuisine') {
        if (!str_contains(strtolower($r->getCuisine() ?? ''), strtolower($cuisine))) {
            return false;
        }
    }

    if ($minRating > 0.0) {
        if ($r->getRating() === null || $r->getRating() < $minRating) {
            return false;
        }
    }

    if ($maxDistance < 999.0) {
        if ($r->getDistance() === null || $r->getDistance() > $maxDistance) {
            return false;
        }
    }

    if ($openNow && !$r->isOpenNow()) {
        return false;
    }

    return true;
}));

if (strcasecmp($sort, 'Rating') === 0) {
    usort($filtered, static fn(Restaurant $a, Restaurant $b): int => ($b->getRating() ?? -1.0) <=> ($a->getRating() ?? -1.0));
} elseif (strcasecmp($sort, 'Distance') === 0) {
    usort($filtered, static fn(Restaurant $a, Restaurant $b): int => ($a->getDistance() ?? 999.0) <=> ($b->getDistance() ?? 999.0));
} elseif (strcasecmp($sort, 'Name') === 0) {
    usort($filtered, static fn(Restaurant $a, Restaurant $b): int => strcasecmp($a->getName(), $b->getName()));
}

$serialized = array_map('serializeRestaurantForApi', $filtered);

echo json_encode([
    'status' => 'success',
    'source' => 'BiteMap REST API v1',
    'timestamp' => gmdate('c'),
    'count' => count($serialized),
    'filters' => [
        'q' => $query,
        'category' => $category,
        'cuisine' => $cuisine,
        'min_rating' => $minRating > 0 ? $minRating : null,
        'max_distance_km' => $maxDistance < 999 ? $maxDistance : null,
        'open_now' => $openNow,
        'sort' => $sort,
    ],
    'data' => $serialized,
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
