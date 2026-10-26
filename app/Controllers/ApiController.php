<?php
/**
 * BiteMap — ApiController (app/Controllers/ApiController.php)
 * Week 4 (REST API & JSON) + Week 7 (Vanilla PHP MVC — Controller Layer)
 *
 * Orchestrates JSON REST API requests for restaurant discovery and location autocomplete:
 *   Client fetch() -> api/restaurants.php -> ApiController::restaurants($_GET) -> Restaurant Model -> JSON Response
 */

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/functions.php';

class ApiController
{
    /**
     * Handles GET requests to api/restaurants.php.
     *
     * @param array<string, mixed> $query Query parameters (typically $_GET)
     */
    public function restaurants(array $query = []): void
    {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
            http_response_code(204);
            return;
        }

        // 1. Optional simulated error state for Week 4 Error + Retry UI demonstration
        $simulateError = isset($query['simulate_error']) &&
            in_array(strtolower(trim((string) $query['simulate_error'])), ['1', 'true', 'yes'], true);
        if ($simulateError) {
            http_response_code(503);
            echo json_encode([
                'status' => 'error',
                'code' => 'SERVICE_TEMPORARILY_UNAVAILABLE',
                'message' => 'Simulated API service interruption (HTTP 503) for Week 4 error-handling and retry demonstration.',
                'timestamp' => gmdate('c'),
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        // 2. Location autocomplete endpoint (?autocomplete=...)
        if (isset($query['autocomplete'])) {
            $this->handleAutocomplete((string) $query['autocomplete']);
            return;
        }

        // 3. Single restaurant lookup (?id=...)
        if (isset($query['id']) && trim((string) $query['id']) !== '') {
            $id = trim((string) $query['id']);
            $restaurant = Restaurant::findById($id);
            if ($restaurant === null) {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'code' => 'RESTAURANT_NOT_FOUND',
                    'message' => "No restaurant found with ID '{$id}'.",
                    'timestamp' => gmdate('c'),
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                return;
            }

            echo json_encode([
                'status' => 'success',
                'source' => 'BiteMap REST API v1',
                'timestamp' => gmdate('c'),
                'data' => $restaurant->toArray(),
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        // 4. Collection filtering & sorting via Restaurant::filter()
        $filtered = Restaurant::filter($query);
        $serialized = array_map(static fn(Restaurant $r): array => $r->toArray(), $filtered);

        echo json_encode([
            'status' => 'success',
            'source' => 'BiteMap REST API v1',
            'timestamp' => gmdate('c'),
            'count' => count($serialized),
            'filters' => [
                'q' => isset($query['q']) ? trim((string) $query['q']) : '',
                'category' => isset($query['category']) ? trim((string) $query['category']) : '',
                'cuisine' => isset($query['cuisine']) ? trim((string) $query['cuisine']) : '',
                'min_rating' => isset($query['rating']) && is_numeric($query['rating']) ? (float) $query['rating'] : null,
                'max_distance_km' => isset($query['distance']) && is_numeric($query['distance']) ? (float) $query['distance'] : null,
                'open_now' => isset($query['open_now']) && in_array(strtolower(trim((string) $query['open_now'])), ['1', 'true', 'yes'], true),
                'sort' => isset($query['sort']) && trim((string) $query['sort']) !== '' ? trim((string) $query['sort']) : 'Recommended',
            ],
            'data' => $serialized,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Handles Malang culinary district location autocomplete queries.
     */
    private function handleAutocomplete(string $rawQuery): void
    {
        $locQuery = strtolower(trim($rawQuery));
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
            ],
            [
                'id' => 'loc-soekarno-hatta',
                'name' => 'Soekarno Hatta (Suhat), Malang',
                'label' => 'Jl. Soekarno Hatta, Lowokwaru, Malang',
                'formatted' => 'Soekarno Hatta, Malang',
                'address_line1' => 'Jl. Soekarno Hatta (Suhat)',
                'address_line2' => 'Lowokwaru, Kota Malang, Jawa Timur 65141',
                'city' => 'Malang',
                'state' => 'Jawa Timur',
                'postcode' => '65141',
                'lat' => -7.9438,
                'lon' => 112.6152,
            ],
            [
                'id' => 'loc-ijen',
                'name' => 'Ijen Boulevard, Malang',
                'label' => 'Jl. Besar Ijen, Klojen, Malang',
                'formatted' => 'Ijen, Malang',
                'address_line1' => 'Jl. Besar Ijen',
                'address_line2' => 'Klojen, Kota Malang, Jawa Timur 65119',
                'city' => 'Malang',
                'state' => 'Jawa Timur',
                'postcode' => '65119',
                'lat' => -7.9698,
                'lon' => 112.6253,
            ],
            [
                'id' => 'loc-bandung-street',
                'name' => 'Jl. Bandung, Malang',
                'label' => 'Jl. Bandung, Penanggungan, Klojen, Malang',
                'formatted' => 'Jl. Bandung, Malang',
                'address_line1' => 'Jl. Bandung',
                'address_line2' => 'Klojen, Kota Malang, Jawa Timur 65113',
                'city' => 'Malang',
                'state' => 'Jawa Timur',
                'postcode' => '65113',
                'lat' => -7.9614,
                'lon' => 112.6219,
            ],
            [
                'id' => 'loc-klojen',
                'name' => 'Klojen, Malang',
                'label' => 'Kec. Klojen, Kota Malang, East Java',
                'formatted' => 'Klojen, Malang',
                'address_line1' => 'Kecamatan Klojen',
                'address_line2' => 'Kota Malang, Jawa Timur',
                'city' => 'Malang',
                'state' => 'Jawa Timur',
                'postcode' => '65111',
                'lat' => -7.9730,
                'lon' => 112.6280,
            ],
            [
                'id' => 'loc-lowokwaru',
                'name' => 'Lowokwaru, Malang',
                'label' => 'Kec. Lowokwaru, Kota Malang, East Java',
                'formatted' => 'Lowokwaru, Malang',
                'address_line1' => 'Kecamatan Lowokwaru',
                'address_line2' => 'Kota Malang, Jawa Timur',
                'city' => 'Malang',
                'state' => 'Jawa Timur',
                'postcode' => '65141',
                'lat' => -7.9450,
                'lon' => 112.6150,
            ],
        ];

        $matched = array_values(array_filter($malangLocations, static function (array $loc) use ($locQuery): bool {
            if ($locQuery === '') {
                return true;
            }
            $haystack = strtolower($loc['name'] . ' ' . $loc['label'] . ' ' . $loc['address_line1'] . ' ' . $loc['address_line2']);
            return str_contains($haystack, $locQuery);
        }));

        echo json_encode([
            'status' => 'success',
            'source' => 'BiteMap Location Autocomplete API',
            'count' => count($matched),
            'results' => $matched,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
