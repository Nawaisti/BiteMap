<?php
/**
 * BiteMap — Restaurant Domain Model
 * Week 6 (PHP OOP) & Week 7 (Vanilla PHP MVC — Pure Model Layer)
 *
 * Represents a culinary destination in BiteMap and provides static repository
 * query methods for loading, finding, filtering, and sorting restaurants.
 *
 * Strictly adheres to Week 7 MVC separation: ZERO HTML markup inside the Model.
 *
 * Demonstrated Course Concepts:
 *   - Week 6: class, private properties, __construct(), encapsulation, getters/setters,
 *             object composition (MenuItem[]), domain behavior methods
 *   - Week 7: Model layer data access (all, findById, filter) & business logic without HTML
 */

declare(strict_types=1);

require_once __DIR__ . '/MenuItem.php';

class Restaurant implements \ArrayAccess, \JsonSerializable
{
    private string $id;
    private string $name;
    private string $category;
    private ?string $cuisine;
    private ?float $rating;
    private float|string|null $distance;
    private ?string $description;
    private string $location;
    private float $latitude;
    private float $longitude;
    private ?string $phone;
    private ?string $website;
    private ?string $externalMenuUrl;
    private string $heroImage;

    /**
     * @var array<string, string>
     */
    private array $hours;

    private bool $reservationEnabled;

    /**
     * @var array<int, array{alt?: string, src?: string, image?: string}>
     */
    private array $gallery;

    /**
     * @var array<int, array{category: string, id?: string, items: MenuItem[]}>
     */
    private array $menu;

    private ?string $mapsUrl;
    private ?string $instagramUrl;

    /**
     * @var array<int, array{label: string, url: string}>
     */
    private array $externalLinks;

    /**
     * Cached canonical restaurant instances for the current request lifecycle.
     *
     * @var array<int, self>|null
     */
    private static ?array $repositoryCache = null;

    /**
     * Initializes a new Restaurant domain object.
     *
     * @param string $id
     * @param string $name
     * @param string $category
     * @param string|null $cuisine
     * @param float|null $rating
     * @param float|string|null $distance
     * @param string|null $description
     * @param string $location
     * @param float $latitude
     * @param float $longitude
     * @param string|null $phone
     * @param string|null $website
     * @param string|null $externalMenuUrl
     * @param string $heroImage
     * @param array<string, string> $hours
     * @param bool $reservationEnabled
     * @param array<int, array{alt?: string, src?: string, image?: string}> $gallery
     * @param array<int, array{category: string, id?: string, items: array|MenuItem[]}> $menu
     * @param string|null $mapsUrl
     * @param string|null $instagramUrl
     * @param array<int, array{label: string, url: string}> $externalLinks
     */
    public function __construct(
        string $id,
        string $name,
        string $category,
        ?string $cuisine = null,
        ?float $rating = null,
        float|string|null $distance = null,
        ?string $description = null,
        string $location = '',
        float $latitude = 0.0,
        float $longitude = 0.0,
        ?string $phone = null,
        ?string $website = null,
        ?string $externalMenuUrl = null,
        string $heroImage = '',
        array $hours = [],
        bool $reservationEnabled = false,
        array $gallery = [],
        array $menu = [],
        ?string $mapsUrl = null,
        ?string $instagramUrl = null,
        array $externalLinks = []
    ) {
        $this->id = trim($id);
        $this->name = trim($name);
        $this->category = trim($category);
        $this->cuisine = ($cuisine !== null && trim($cuisine) !== '') ? trim($cuisine) : null;
        $this->rating = $rating !== null ? (float) $rating : null;
        $this->distance = $distance;
        $this->description = ($description !== null && trim($description) !== '') ? trim($description) : null;
        $this->location = trim($location);
        $this->latitude = (float) $latitude;
        $this->longitude = (float) $longitude;
        $this->phone = ($phone !== null && trim($phone) !== '') ? trim($phone) : null;
        $this->website = ($website !== null && trim($website) !== '') ? trim($website) : null;
        $this->externalMenuUrl = ($externalMenuUrl !== null && trim($externalMenuUrl) !== '') ? trim($externalMenuUrl) : null;
        $this->heroImage = trim($heroImage);
        $this->hours = $hours;
        $this->reservationEnabled = $reservationEnabled;
        $this->gallery = $gallery;
        $this->mapsUrl = ($mapsUrl !== null && trim($mapsUrl) !== '') ? trim($mapsUrl) : null;
        $this->instagramUrl = ($instagramUrl !== null && trim($instagramUrl) !== '') ? trim($instagramUrl) : null;
        $this->externalLinks = $externalLinks;

        // Normalize menu items into MenuItem domain objects (Object Composition — Week 6)
        $this->menu = [];
        foreach ($menu as $cat) {
            $catName = (string) ($cat['category'] ?? 'Menu');
            $catId = isset($cat['id']) ? (string) $cat['id'] : null;
            $rawItems = $cat['items'] ?? [];
            $itemObjects = [];

            foreach ($rawItems as $rawItem) {
                if ($rawItem instanceof MenuItem) {
                    $itemObjects[] = $rawItem;
                } elseif (is_array($rawItem)) {
                    $itemObjects[] = MenuItem::fromArray($rawItem, $catName);
                }
            }

            $entry = [
                'category' => $catName,
                'items' => $itemObjects,
            ];
            if ($catId !== null) {
                $entry['id'] = $catId;
            }
            $this->menu[] = $entry;
        }
    }

    /**
     * Instantiates a Restaurant object from an associative array.
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) ($data['id'] ?? ''),
            name: (string) ($data['name'] ?? ''),
            category: (string) ($data['category'] ?? ''),
            cuisine: isset($data['cuisine']) ? (string) $data['cuisine'] : null,
            rating: isset($data['rating']) && is_numeric($data['rating']) ? (float) $data['rating'] : null,
            distance: $data['distance'] ?? null,
            description: isset($data['description']) ? (string) $data['description'] : null,
            location: (string) ($data['location'] ?? ''),
            latitude: isset($data['latitude']) && is_numeric($data['latitude']) ? (float) $data['latitude'] : 0.0,
            longitude: isset($data['longitude']) && is_numeric($data['longitude']) ? (float) $data['longitude'] : 0.0,
            phone: isset($data['phone']) ? (string) $data['phone'] : null,
            website: isset($data['website']) ? (string) $data['website'] : null,
            externalMenuUrl: isset($data['external_menu_url']) ? (string) $data['external_menu_url'] : null,
            heroImage: (string) ($data['hero_image'] ?? ($data['image'] ?? '')),
            hours: is_array($data['hours'] ?? null) ? $data['hours'] : [],
            reservationEnabled: !empty($data['reservation_enabled']),
            gallery: is_array($data['gallery'] ?? null) ? $data['gallery'] : [],
            menu: is_array($data['menu'] ?? null) ? $data['menu'] : [],
            mapsUrl: isset($data['maps_url']) ? (string) $data['maps_url'] : null,
            instagramUrl: isset($data['instagram_url']) ? (string) $data['instagram_url'] : null,
            externalLinks: is_array($data['external_links'] ?? null) ? $data['external_links'] : []
        );
    }

    // ==========================================
    // Model Repository Query Methods (Week 7 MVC)
    // ==========================================

    /**
     * Returns all verified restaurants from data/restaurants.php as Restaurant objects.
     *
     * @return array<int, self>
     */
    public static function all(): array
    {
        if (self::$repositoryCache === null) {
            $dataFile = dirname(__DIR__, 2) . '/data/restaurants.php';
            self::$repositoryCache = [];
            if (file_exists($dataFile)) {
                $rawList = require $dataFile;
                if (is_array($rawList)) {
                    foreach ($rawList as $entry) {
                        if ($entry instanceof self) {
                            self::$repositoryCache[] = $entry;
                        } elseif (is_array($entry)) {
                            self::$repositoryCache[] = self::fromArray($entry);
                        }
                    }
                }
            }
        }

        return self::$repositoryCache;
    }

    /**
     * Finds a single restaurant by its slug ID, or returns null when not found.
     */
    public static function findById(?string $id): ?self
    {
        if ($id === null || trim($id) === '') {
            return null;
        }
        $target = trim($id);
        foreach (self::all() as $restaurant) {
            if ($restaurant->getId() === $target) {
                return $restaurant;
            }
        }
        return null;
    }

    /**
     * Filters and sorts restaurants according to query parameters.
     *
     * Supported keys in $params:
     *   - q         : keyword search (name, category, cuisine, description, address, menu items)
     *   - category  : category name
     *   - cuisine   : cuisine substring
     *   - rating    : minimum numeric rating (e.g. 4.5 or "4.5+")
     *   - distance  : maximum numeric distance in km (e.g. 2 or "< 2 km")
     *   - open_now  : boolean or truthy string ("1", "true", "yes")
     *   - sort      : "Recommended" | "Rating" | "Distance" | "Name"
     *
     * @param array<string, mixed> $params
     * @return array<int, self>
     */
    public static function filter(array $params = []): array
    {
        $query = isset($params['q']) ? trim((string) $params['q']) : '';
        $category = isset($params['category']) ? trim((string) $params['category']) : '';
        $cuisine = isset($params['cuisine']) ? trim((string) $params['cuisine']) : '';

        $minRating = 0.0;
        if (isset($params['rating']) && $params['rating'] !== '') {
            $rawRating = (string) $params['rating'];
            if (is_numeric($rawRating)) {
                $minRating = (float) $rawRating;
            } elseif (preg_match('/(\d+(?:\.\d+)?)/', $rawRating, $m)) {
                $minRating = (float) $m[1];
            }
        }

        $maxDistance = 999.0;
        if (isset($params['distance']) && $params['distance'] !== '') {
            $rawDist = (string) $params['distance'];
            if (is_numeric($rawDist)) {
                $maxDistance = (float) $rawDist;
            } elseif (preg_match('/(\d+(?:\.\d+)?)/', $rawDist, $m)) {
                $maxDistance = (float) $m[1];
            }
        }

        $openNow = false;
        if (isset($params['open_now'])) {
            $openNow = is_bool($params['open_now'])
                ? $params['open_now']
                : in_array(strtolower(trim((string) $params['open_now'])), ['1', 'true', 'yes', 'on'], true);
        }

        $sort = isset($params['sort']) && trim((string) $params['sort']) !== ''
            ? trim((string) $params['sort'])
            : 'Recommended';

        $normalizedFilters = [
            'q' => $query,
            'category' => $category,
            'cuisine' => $cuisine,
            'min_rating' => $minRating,
            'max_distance' => $maxDistance,
            'open_now' => $openNow,
        ];

        $filtered = array_values(array_filter(
            self::all(),
            static fn(self $r): bool => $r->matchesFilters($normalizedFilters)
        ));

        if (strcasecmp($sort, 'Rating') === 0) {
            usort(
                $filtered,
                static fn(self $a, self $b): int => ($b->getRating() ?? -1.0) <=> ($a->getRating() ?? -1.0)
            );
        } elseif (strcasecmp($sort, 'Distance') === 0) {
            usort(
                $filtered,
                static fn(self $a, self $b): int => ($a->getNumericDistance() ?? 999.0) <=> ($b->getNumericDistance() ?? 999.0)
            );
        } elseif (strcasecmp($sort, 'Name') === 0) {
            usort(
                $filtered,
                static fn(self $a, self $b): int => strcasecmp($a->getName(), $b->getName())
            );
        }

        return $filtered;
    }

    // ==========================================
    // Public Getters (Encapsulation — Week 6)
    // ==========================================

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCuisine(): ?string
    {
        return $this->cuisine;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function hasRating(): bool
    {
        return $this->rating !== null && is_numeric($this->rating);
    }

    public function getDistance(): float|string|null
    {
        return $this->distance;
    }

    public function getNumericDistance(): ?float
    {
        if ($this->distance !== null && is_numeric($this->distance)) {
            return (float) $this->distance;
        }
        return null;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getAddressText(): string
    {
        return $this->location;
    }

    /**
     * Extracts the Malang administrative district (e.g. Klojen) from the location string.
     * Pure string helper — zero HTML markup (Week 7 MVC separation).
     */
    public function getDistrict(): string
    {
        if (preg_match('/Kec\.\s*([^,]+)/i', $this->location, $matches)) {
            return trim($matches[1]);
        }
        return 'Klojen';
    }

    /**
     * Returns the 1-based canonical atlas stop index for this destination.
     * Pure integer helper — zero HTML markup (Week 7 MVC separation).
     */
    public function getAtlasStopNumber(): int
    {
        return match ($this->id) {
            'okiru-ramen' => 1,
            'dialogi-signature-malang' => 2,
            'burger-king-ijen-besar-malang' => 3,
            default => 1,
        };
    }

    /**
     * Returns the two-digit atlas stop code (e.g. 'STOP 01').
     * Pure string helper — zero HTML markup (Week 7 MVC separation).
     */
    public function getAtlasStopCode(): string
    {
        return sprintf('STOP %02d', $this->getAtlasStopNumber());
    }

    /**
     * Returns the full uppercase atlas label (e.g. 'STOP 01 · KLOJEN').
     * Pure string helper — zero HTML markup (Week 7 MVC separation).
     */
    public function getAtlasLabel(): string
    {
        return sprintf('%s · %s', $this->getAtlasStopCode(), strtoupper($this->getDistrict()));
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function getExternalMenuUrl(): ?string
    {
        return $this->externalMenuUrl;
    }

    public function getHeroImage(): string
    {
        return $this->heroImage;
    }

    /**
     * @return array<string, string>
     */
    public function getHours(): array
    {
        return $this->hours;
    }

    public function getHoursForDay(string $day): ?string
    {
        return $this->hours[$day] ?? null;
    }

    public function isReservationEnabled(): bool
    {
        return $this->reservationEnabled;
    }

    public function hasReservationCapability(): bool
    {
        return $this->reservationEnabled;
    }

    /**
     * @return array<int, array{alt?: string, src?: string, image?: string}>
     */
    public function getGallery(): array
    {
        return $this->gallery;
    }

    /**
     * @return array<int, array{category: string, id?: string, items: MenuItem[]}>
     */
    public function getMenu(): array
    {
        return $this->menu;
    }

    /**
     * Returns a flat list of all MenuItem objects across all categories.
     *
     * @return array<int, MenuItem>
     */
    public function getAllMenuItems(): array
    {
        $items = [];
        foreach ($this->menu as $cat) {
            foreach (($cat['items'] ?? []) as $item) {
                if ($item instanceof MenuItem) {
                    $items[] = $item;
                }
            }
        }
        return $items;
    }

    public function getMapsUrl(): ?string
    {
        return $this->mapsUrl;
    }

    public function getInstagramUrl(): ?string
    {
        return $this->instagramUrl;
    }

    /**
     * @return array<int, array{label: string, url: string}>
     */
    public function getExternalLinks(): array
    {
        return $this->externalLinks;
    }

    public function hasGallery(): bool
    {
        return !empty($this->gallery);
    }

    public function hasMenu(): bool
    {
        return !empty($this->menu);
    }

    // ==========================================
    // Public Setters (Encapsulation — Week 6)
    // ==========================================

    public function setName(string $name): void
    {
        $this->name = trim($name);
    }

    public function setCategory(string $category): void
    {
        $this->category = trim($category);
    }

    public function setCuisine(?string $cuisine): void
    {
        $this->cuisine = ($cuisine !== null && trim($cuisine) !== '') ? trim($cuisine) : null;
    }

    public function setRating(?float $rating): void
    {
        $this->rating = $rating !== null ? (float) $rating : null;
    }

    public function setDistance(float|string|null $distance): void
    {
        $this->distance = $distance;
    }

    public function setDescription(?string $description): void
    {
        $this->description = ($description !== null && trim($description) !== '') ? trim($description) : null;
    }

    public function setLocation(string $location): void
    {
        $this->location = trim($location);
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = ($phone !== null && trim($phone) !== '') ? trim($phone) : null;
    }

    public function setWebsite(?string $website): void
    {
        $this->website = ($website !== null && trim($website) !== '') ? trim($website) : null;
    }

    public function setReservationEnabled(bool $enabled): void
    {
        $this->reservationEnabled = $enabled;
    }

    // ==========================================
    // Pure Domain Behavior Methods (Zero HTML)
    // ==========================================

    /**
     * Returns formatted numeric rating string (e.g. "4.8") or null if unrated.
     */
    public function getFormattedRatingNumber(): ?string
    {
        if ($this->rating !== null && is_numeric($this->rating)) {
            return number_format($this->rating, 1);
        }
        return null;
    }

    /**
     * Returns plain text rating label (e.g. "4.8" or "New · No reviews yet").
     */
    public function getRatingText(): string
    {
        return $this->getFormattedRatingNumber() ?? 'New · No reviews yet';
    }

    /**
     * Returns plain text category and cuisine subtitle (e.g. "Asian Food • Japanese • Ramen Bar").
     */
    public function getCategoryAndCuisineText(): string
    {
        if ($this->cuisine !== null && $this->cuisine !== '') {
            return $this->category . ' • ' . $this->cuisine;
        }
        return $this->category;
    }

    /**
     * Returns formatted distance string in km (e.g. "0.8 km") or null.
     */
    public function getFormattedDistance(?float $customDistance = null): ?string
    {
        if ($customDistance !== null) {
            return number_format($customDistance, 1) . ' km';
        }

        if ($this->distance !== null) {
            if (is_numeric($this->distance)) {
                return number_format((float) $this->distance, 1) . ' km';
            }
            $str = trim((string) $this->distance);
            return $str !== '' ? $str : null;
        }

        return null;
    }

    /**
     * Evaluates whether the restaurant is open right now in Asia/Jakarta time.
     */
    public function isOpenNow(?DateTimeInterface $now = null): bool
    {
        if (empty($this->hours)) {
            return false;
        }

        if ($now === null) {
            $now = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        }

        $dayName = $now->format('l');
        if (empty($this->hours[$dayName]) || !is_string($this->hours[$dayName])) {
            return false;
        }

        $todayHours = $this->hours[$dayName];

        if (
            preg_match('/24\s*(jam|hours?)/i', $todayHours) ||
            str_contains($todayHours, '00:00 – 24:00') ||
            str_contains($todayHours, '00:00 - 24:00')
        ) {
            return true;
        }

        if (preg_match('/(\d{1,2}):(\d{2})\s*[–—-]\s*(\d{1,2}):(\d{2})/u', $todayHours, $matches)) {
            $currentMins = (int) $now->format('G') * 60 + (int) $now->format('i');
            $openMins = (int) $matches[1] * 60 + (int) $matches[2];
            $closeMins = (int) $matches[3] * 60 + (int) $matches[4];

            if ($closeMins < $openMins) {
                return $currentMins >= $openMins || $currentMins < $closeMins;
            }

            return $currentMins >= $openMins && $currentMins < $closeMins;
        }

        return false;
    }

    /**
     * Checks if the restaurant operates 24 hours on a given day (defaults to today).
     */
    public function is24Hours(?string $dayName = null): bool
    {
        if ($dayName === null) {
            $now = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
            $dayName = $now->format('l');
        }

        if (empty($this->hours[$dayName])) {
            return false;
        }

        $str = $this->hours[$dayName];
        return (bool) (
            preg_match('/24\s*(jam|hours?)/i', $str) ||
            str_contains($str, '00:00 – 24:00') ||
            str_contains($str, '00:00 - 24:00')
        );
    }

    /**
     * Returns structured status data for today's operating hours without HTML.
     *
     * @param DateTimeInterface|null $now
     * @return array{day: string, is_open: bool, is_24h: bool, label: string, badge_variant: string}
     */
    public function getTodayStatus(?DateTimeInterface $now = null): array
    {
        if ($now === null) {
            $now = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        }
        $dayName = $now->format('l');
        $is24h = $this->is24Hours($dayName);
        $isOpen = $this->isOpenNow($now);

        if ($is24h) {
            return [
                'day' => $dayName,
                'is_open' => true,
                'is_24h' => true,
                'label' => 'Open 24 hours',
                'badge_variant' => 'badge-success',
            ];
        }

        if ($isOpen) {
            return [
                'day' => $dayName,
                'is_open' => true,
                'is_24h' => false,
                'label' => 'Open now',
                'badge_variant' => 'badge-success',
            ];
        }

        return [
            'day' => $dayName,
            'is_open' => false,
            'is_24h' => false,
            'label' => 'Closed',
            'badge_variant' => 'badge-neutral',
        ];
    }

    /**
     * Resolves the hero image asset URL with a relative directory prefix.
     */
    public function getHeroImageUrl(string $basePath = ''): string
    {
        if ($this->heroImage === '') {
            return '';
        }

        if (
            str_starts_with($this->heroImage, 'http://') ||
            str_starts_with($this->heroImage, 'https://') ||
            str_starts_with($this->heroImage, 'data:')
        ) {
            return $this->heroImage;
        }

        $normalized = preg_replace('/^(\.\.\/|\/)+/', '', $this->heroImage);
        return $basePath . $normalized;
    }

    /**
     * Evaluates whether this Restaurant matches the normalized filter criteria.
     *
     * @param array<string, mixed> $filters
     * @return bool
     */
    public function matchesFilters(array $filters): bool
    {
        $query = isset($filters['q']) ? trim((string) $filters['q']) : '';
        $category = isset($filters['category']) ? trim((string) $filters['category']) : '';
        $cuisine = isset($filters['cuisine']) ? trim((string) $filters['cuisine']) : '';
        $minRating = isset($filters['min_rating']) ? (float) $filters['min_rating'] : 0.0;
        $maxDistance = isset($filters['max_distance']) ? (float) $filters['max_distance'] : 999.0;
        $openNow = !empty($filters['open_now']);

        if ($query !== '') {
            $qLower = strtolower($query);
            $menuParts = [];
            foreach ($this->menu as $cat) {
                $menuParts[] = (string) ($cat['category'] ?? '');
                foreach (($cat['items'] ?? []) as $item) {
                    if ($item instanceof MenuItem) {
                        $menuParts[] = $item->getName();
                    }
                }
            }
            $haystack = strtolower(
                $this->name . ' ' .
                $this->category . ' ' .
                ($this->cuisine ?? '') . ' ' .
                ($this->description ?? '') . ' ' .
                $this->location . ' ' .
                implode(' ', $menuParts)
            );
            if (!str_contains($haystack, $qLower)) {
                return false;
            }
        }

        if ($category !== '' && strcasecmp($category, 'Category') !== 0 && strcasecmp($category, 'All') !== 0) {
            $catLower = strtolower($category);
            if (
                !str_contains(strtolower($this->category), $catLower) &&
                !str_contains(strtolower($this->cuisine ?? ''), $catLower)
            ) {
                return false;
            }
        }

        if ($cuisine !== '' && strcasecmp($cuisine, 'Cuisine') !== 0 && strcasecmp($cuisine, 'All') !== 0) {
            $cuiLower = strtolower($cuisine);
            if (
                !str_contains(strtolower($this->cuisine ?? ''), $cuiLower) &&
                !str_contains(strtolower($this->category), $cuiLower)
            ) {
                return false;
            }
        }

        if ($minRating > 0.0) {
            if ($this->rating === null || $this->rating < $minRating) {
                return false;
            }
        }

        if ($maxDistance < 999.0) {
            $numDist = $this->getNumericDistance();
            if ($numDist === null || $numDist > $maxDistance) {
                return false;
            }
        }

        if ($openNow && !$this->isOpenNow()) {
            return false;
        }

        return true;
    }

    /**
     * Converts the Restaurant object to an associative array for JSON or template serialization.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $menuArray = [];
        foreach ($this->menu as $cat) {
            $catEntry = ['category' => $cat['category']];
            if (isset($cat['id'])) {
                $catEntry['id'] = $cat['id'];
            }
            $items = [];
            foreach ($cat['items'] as $item) {
                $items[] = $item instanceof MenuItem ? $item->toArray() : $item;
            }
            $catEntry['items'] = $items;
            $menuArray[] = $catEntry;
        }

        $arr = [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'cuisine' => $this->cuisine,
            'rating' => $this->rating,
            'distance' => $this->distance,
            'description' => $this->description,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phone' => $this->phone,
            'website' => $this->website,
            'external_menu_url' => $this->externalMenuUrl,
            'hero_image' => $this->heroImage,
            'hours' => $this->hours,
            'open_now' => $this->isOpenNow(),
            'reservation_enabled' => $this->reservationEnabled,
            'gallery' => $this->gallery,
            'menu' => $menuArray,
        ];

        if ($this->mapsUrl !== null) {
            $arr['maps_url'] = $this->mapsUrl;
        }
        if ($this->instagramUrl !== null) {
            $arr['instagram_url'] = $this->instagramUrl;
        }
        if (!empty($this->externalLinks)) {
            $arr['external_links'] = $this->externalLinks;
        }

        return $arr;
    }

    // ==========================================
    // ArrayAccess & JsonSerializable Support
    // ==========================================

    public function offsetExists(mixed $offset): bool
    {
        $arr = $this->toArray();
        return array_key_exists((string) $offset, $arr);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return match ((string) $offset) {
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'cuisine' => $this->cuisine,
            'rating' => $this->rating,
            'distance' => $this->distance,
            'description' => $this->description,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phone' => $this->phone,
            'website' => $this->website,
            'external_menu_url' => $this->externalMenuUrl,
            'hero_image' => $this->heroImage,
            'hours' => $this->hours,
            'reservation_enabled' => $this->reservationEnabled,
            'gallery' => $this->gallery,
            'menu' => $this->menu,
            'maps_url' => $this->mapsUrl,
            'instagram_url' => $this->instagramUrl,
            'external_links' => $this->externalLinks,
            default => null,
        };
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        match ((string) $offset) {
            'name' => $this->setName((string) $value),
            'category' => $this->setCategory((string) $value),
            'cuisine' => $this->setCuisine($value !== null ? (string) $value : null),
            'rating' => $this->setRating($value !== null ? (float) $value : null),
            'distance' => $this->setDistance($value),
            'description' => $this->setDescription($value !== null ? (string) $value : null),
            'location' => $this->setLocation((string) $value),
            'phone' => $this->setPhone($value !== null ? (string) $value : null),
            'website' => $this->setWebsite($value !== null ? (string) $value : null),
            'reservation_enabled' => $this->setReservationEnabled((bool) $value),
            default => null,
        };
    }

    public function offsetUnset(mixed $offset): void
    {
        // Immutable keys
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
