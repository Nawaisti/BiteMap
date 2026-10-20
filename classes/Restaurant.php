<?php
/**
 * BiteMap - Restaurant Domain Model
 * Sprint 05 Object-Oriented PHP Implementation (Week 6)
 *
 * Core domain class representing a culinary destination in BiteMap.
 * Fulfills Week 6 requirements: Class & Object, Encapsulation with private properties,
 * Constructor initialization, Getters & Setters, Domain Behavior Methods,
 * and Dynamic HTML Generation.
 *
 * @author BiteMap Engineering Team
 * @package BiteMap\Models
 */

declare(strict_types=1);

require_once __DIR__ . '/MenuItem.php';

class Restaurant implements \ArrayAccess, \JsonSerializable
{
    /**
     * Unique restaurant slug / identifier (e.g. 'okiru-ramen').
     */
    private string $id;

    /**
     * Canonical display name.
     */
    private string $name;

    /**
     * Primary culinary category (e.g. 'Asian Food', 'Cafe & Coffee', 'Fast Food').
     */
    private string $category;

    /**
     * Specific cuisine descriptor (e.g. 'Japanese • Ramen Bar', 'Asian Fusion').
     */
    private ?string $cuisine;

    /**
     * Numeric rating (1.0 - 5.0) or null if unrated.
     */
    private ?float $rating;

    /**
     * Distance from user in km or formatted string, or null.
     */
    private float|string|null $distance;

    /**
     * Editorial description / story.
     */
    private ?string $description;

    /**
     * Full physical street address in Malang.
     */
    private string $location;

    /**
     * Geographic latitude coordinate.
     */
    private float $latitude;

    /**
     * Geographic longitude coordinate.
     */
    private float $longitude;

    /**
     * Contact telephone number or WhatsApp string.
     */
    private ?string $phone;

    /**
     * External website, Linktree, or portfolio URL.
     */
    private ?string $website;

    /**
     * External menu PDF or Drive link URL.
     */
    private ?string $externalMenuUrl;

    /**
     * Relative path to primary hero image asset.
     */
    private string $heroImage;

    /**
     * Operating hours schedule indexed by English day name ('Monday'..'Sunday').
     *
     * @var array<string, string>
     */
    private array $hours;

    /**
     * Whether table reservation flow is active for this restaurant.
     */
    private bool $reservationEnabled;

    /**
     * Photo gallery items containing 'alt' and 'src'.
     *
     * @var array<int, array{alt?: string, src?: string, image?: string}>
     */
    private array $gallery;

    /**
     * Categorized menu structure containing MenuItem objects.
     *
     * @var array<int, array{category: string, id?: string, items: MenuItem[]}>
     */
    private array $menu;

    /**
     * Google Maps profile URL.
     */
    private ?string $mapsUrl;

    /**
     * Instagram profile URL.
     */
    private ?string $instagramUrl;

    /**
     * Additional external social / business links.
     *
     * @var array<int, array{label: string, url: string}>
     */
    private array $externalLinks;

    /**
     * Initializes a new Restaurant object instance.
     * Fulfills Week 6 Slide 4 (Constructor & Encapsulation).
     *
     * @param string $id Unique identifier
     * @param string $name Restaurant name
     * @param string $category Primary category
     * @param string|null $cuisine Optional cuisine details
     * @param float|null $rating Optional numeric rating
     * @param float|string|null $distance Optional distance
     * @param string|null $description Optional description
     * @param string $location Physical address
     * @param float $latitude Latitude coordinate
     * @param float $longitude Longitude coordinate
     * @param string|null $phone Phone number
     * @param string|null $website Website URL
     * @param string|null $externalMenuUrl External menu link
     * @param string $heroImage Relative path to hero photo
     * @param array<string, string> $hours Daily operating hours
     * @param bool $reservationEnabled Reservation capability flag
     * @param array<int, array{alt?: string, src?: string, image?: string}> $gallery Gallery photos
     * @param array<int, array{category: string, id?: string, items: array|MenuItem[]}> $menu Menu categories and items
     * @param string|null $mapsUrl Google Maps link
     * @param string|null $instagramUrl Instagram link
     * @param array<int, array{label: string, url: string}> $externalLinks Additional links
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
        $this->rating = $rating !== null ? (float)$rating : null;
        $this->distance = $distance;
        $this->description = ($description !== null && trim($description) !== '') ? trim($description) : null;
        $this->location = trim($location);
        $this->latitude = (float)$latitude;
        $this->longitude = (float)$longitude;
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

        // Normalize menu items into MenuItem domain objects (Composition)
        $this->menu = [];
        foreach ($menu as $cat) {
            $catName = (string)($cat['category'] ?? 'Menu');
            $catId = isset($cat['id']) ? (string)$cat['id'] : null;
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
     * Static factory method to instantiate a Restaurant directly from an associative array.
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string)($data['id'] ?? ''),
            name: (string)($data['name'] ?? ''),
            category: (string)($data['category'] ?? ''),
            cuisine: isset($data['cuisine']) ? (string)$data['cuisine'] : null,
            rating: isset($data['rating']) && is_numeric($data['rating']) ? (float)$data['rating'] : null,
            distance: $data['distance'] ?? null,
            description: isset($data['description']) ? (string)$data['description'] : null,
            location: (string)($data['location'] ?? ''),
            latitude: isset($data['latitude']) && is_numeric($data['latitude']) ? (float)$data['latitude'] : 0.0,
            longitude: isset($data['longitude']) && is_numeric($data['longitude']) ? (float)$data['longitude'] : 0.0,
            phone: isset($data['phone']) ? (string)$data['phone'] : null,
            website: isset($data['website']) ? (string)$data['website'] : null,
            externalMenuUrl: isset($data['external_menu_url']) ? (string)$data['external_menu_url'] : null,
            heroImage: (string)($data['hero_image'] ?? ($data['image'] ?? '')),
            hours: is_array($data['hours'] ?? null) ? $data['hours'] : [],
            reservationEnabled: !empty($data['reservation_enabled']),
            gallery: is_array($data['gallery'] ?? null) ? $data['gallery'] : [],
            menu: is_array($data['menu'] ?? null) ? $data['menu'] : [],
            mapsUrl: isset($data['maps_url']) ? (string)$data['maps_url'] : null,
            instagramUrl: isset($data['instagram_url']) ? (string)$data['instagram_url'] : null,
            externalLinks: is_array($data['external_links'] ?? null) ? $data['external_links'] : []
        );
    }

    // ==========================================
    // Public Getters (Encapsulation - Week 6 Slide 4)
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

    public function getDistance(): float|string|null
    {
        return $this->distance;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLocation(): string
    {
        return $this->location;
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
     * Returns categorized menu with MenuItem objects.
     *
     * @return array<int, array{category: string, id?: string, items: MenuItem[]}>
     */
    public function getMenu(): array
    {
        return $this->menu;
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
    // Public Setters (Week 6 Slide 4)
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
        $this->rating = $rating !== null ? (float)$rating : null;
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
    // Domain Behavior Methods (Week 6 Slide 3 & 8)
    // ==========================================

    /**
     * Returns combined category and cuisine label for subtitle display.
     * e.g. "Asian Food &bull; Japanese • Ramen Bar"
     */
    public function getCategoryAndCuisine(): string
    {
        $str = htmlspecialchars($this->category, ENT_QUOTES, 'UTF-8');
        if ($this->cuisine !== null && $this->cuisine !== '') {
            $str .= ' &bull; ' . htmlspecialchars($this->cuisine, ENT_QUOTES, 'UTF-8');
        }
        return $str;
    }

    /**
     * Formats restaurant rating as safe HTML.
     */
    public function getFormattedRating(): string
    {
        if ($this->rating !== null && is_numeric($this->rating)) {
            $formatted = number_format($this->rating, 1);
            return '<span class="rating-icon" aria-hidden="true">&#9733;</span> ' . $formatted;
        }

        return '<span>New &middot; No reviews yet</span>';
    }

    /**
     * Formats distance in km string.
     */
    public function getFormattedDistance(?float $customDistance = null): ?string
    {
        if ($customDistance !== null) {
            return number_format($customDistance, 1) . ' km';
        }

        if ($this->distance !== null) {
            if (is_numeric($this->distance)) {
                return number_format((float)$this->distance, 1) . ' km';
            }
            $str = trim((string)$this->distance);
            return $str !== '' ? $str : null;
        }

        return null;
    }

    /**
     * Evaluates whether the restaurant is open right now based on operating hours.
     * Encapsulates timezone handling (Asia/Jakarta) and 24-hour service checks.
     *
     * @param DateTimeInterface|null $now
     * @return bool
     */
    public function isOpenNow(?DateTimeInterface $now = null): bool
    {
        if (empty($this->hours)) {
            return false;
        }

        if ($now === null) {
            $now = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        }

        $dayName = $now->format('l'); // 'Monday' through 'Sunday'
        if (empty($this->hours[$dayName]) || !is_string($this->hours[$dayName])) {
            return false;
        }

        $todayHours = $this->hours[$dayName];

        // 24-hour service check
        if (preg_match('/24\s*(jam|hours?)/i', $todayHours) ||
            str_contains($todayHours, '00:00 – 24:00') ||
            str_contains($todayHours, '00:00 - 24:00')) {
            return true;
        }

        // Standard time range check
        if (preg_match('/(\d{1,2}):(\d{2})\s*[–—-]\s*(\d{1,2}):(\d{2})/u', $todayHours, $matches)) {
            $currentMins = (int)$now->format('G') * 60 + (int)$now->format('i');
            $openMins = (int)$matches[1] * 60 + (int)$matches[2];
            $closeMins = (int)$matches[3] * 60 + (int)$matches[4];

            if ($closeMins < $openMins) {
                // Operates past midnight
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
        return (bool)(preg_match('/24\s*(jam|hours?)/i', $str) ||
            str_contains($str, '00:00 – 24:00') ||
            str_contains($str, '00:00 - 24:00'));
    }

    /**
     * Resolves the hero image asset path with appropriate relative directory prefix.
     */
    public function getHeroImageUrl(string $basePath = ''): string
    {
        if ($this->heroImage === '') {
            return '';
        }

        // Absolute URLs or data URIs
        if (str_starts_with($this->heroImage, 'http://') ||
            str_starts_with($this->heroImage, 'https://') ||
            str_starts_with($this->heroImage, 'data:')) {
            return $this->heroImage;
        }

        // Normalize leading ../ or /
        $normalized = preg_replace('/^(\.\.\/|\/)+/', '', $this->heroImage);
        return $basePath . $normalized;
    }

    /**
     * Returns inline CSS style string for hero background image.
     */
    public function getHeroStyle(string $basePath = ''): string
    {
        $url = $this->getHeroImageUrl($basePath);
        if ($url === '') {
            return '';
        }

        $escaped = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        return ' style="background-image: url(\'' . $escaped . '\'); background-size: cover; background-position: center;"';
    }

    // ==========================================
    // Dynamic HTML Output Generation (Week 6 Slide 5 & 9)
    // ==========================================

    /**
     * Renders this restaurant card as semantic HTML for grids and discovery rails.
     * Fulfills Week 6 Slide 5 & Slide 9: "Object -> PHP -> HTML".
     *
     * @param string $linkBase URL destination (e.g. 'restaurant.php' or 'pages/restaurant.php')
     * @param string $assetPrefix Relative path prefix for assets ('' or '../')
     * @param bool $isFav Initial favorite state
     * @param float|null $customDistance Custom distance in km if calculated
     * @return string Safe semantic HTML markup
     */
    public function renderCard(
        string $linkBase = 'restaurant.php',
        string $assetPrefix = '',
        bool $isFav = false,
        ?float $customDistance = null
    ): string {
        $id = htmlspecialchars($this->id, ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($this->category, ENT_QUOTES, 'UTF-8');
        $href = htmlspecialchars($linkBase . '?id=' . urlencode($this->id), ENT_QUOTES, 'UTF-8');

        // Meta (Rating & Distance)
        $metaParts = [$this->getFormattedRating()];
        $distText = $this->getFormattedDistance($customDistance);
        if ($distText !== null) {
            $metaParts[] = htmlspecialchars($distText, ENT_QUOTES, 'UTF-8');
        }
        $metaHtml = implode(' &bull; ', $metaParts);

        // Favorite button state
        $favClass = $isFav ? 'btn-favorite is-active' : 'btn-favorite';
        $favLabel = $isFav ? "Remove {$name} from favorites" : "Save {$name} to favorites";
        $favPressed = $isFav ? 'true' : 'false';

        // Hero image style
        $imgStyle = $this->getHeroStyle($assetPrefix);

        return <<<HTML
<article class="restaurant-card" data-id="{$id}" data-restaurant-id="{$id}">
  <button type="button" class="{$favClass}" aria-label="{$favLabel}" aria-pressed="{$favPressed}"><span aria-hidden="true">&hearts;</span></button>
  <a href="{$href}" class="card-link-wrapper" aria-label="View {$name}">
    <div class="restaurant-card-image" aria-hidden="true"{$imgStyle}></div>
    <div class="restaurant-card-content">
      <h3 class="text-lead">{$name}</h3>
      <p class="text-small text-muted" style="margin-bottom: var(--space-1);">{$category}</p>
      <p class="text-meta text-muted">{$metaHtml}</p>
    </div>
  </a>
</article>
HTML;
    }

    /**
     * Converts restaurant object back to an associative array for backward compatibility.
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
    // ArrayAccess Implementation (Defensive Backward Compatibility)
    // ==========================================

    public function offsetExists(mixed $offset): bool
    {
        $arr = $this->toArray();
        return array_key_exists((string)$offset, $arr);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return match ((string)$offset) {
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
        match ((string)$offset) {
            'name' => $this->setName((string)$value),
            'category' => $this->setCategory((string)$value),
            'cuisine' => $this->setCuisine($value !== null ? (string)$value : null),
            'rating' => $this->setRating($value !== null ? (float)$value : null),
            'distance' => $this->setDistance($value),
            'description' => $this->setDescription($value !== null ? (string)$value : null),
            'location' => $this->setLocation((string)$value),
            'phone' => $this->setPhone($value !== null ? (string)$value : null),
            'website' => $this->setWebsite($value !== null ? (string)$value : null),
            'reservation_enabled' => $this->setReservationEnabled((bool)$value),
            default => null,
        };
    }

    public function offsetUnset(mixed $offset): void
    {
        // Immutable keys
    }

    // ==========================================
    // JsonSerializable Implementation
    // ==========================================

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
