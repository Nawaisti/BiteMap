<?php
/**
 * BiteMap — MenuItem Domain Model
 * Week 6 (PHP OOP) & Week 7 (Vanilla PHP MVC — Pure Model Layer)
 *
 * Represents a single dish or beverage item in a restaurant's menu.
 * Strictly encapsulates data and domain logic with ZERO HTML markup.
 *
 * Demonstrated Course Concepts:
 *   - Week 6: class, private properties, __construct(), public getters/setters, domain methods
 *   - Week 7: Model layer purity (no HTML strings or presentation markup)
 */

declare(strict_types=1);

class MenuItem implements \ArrayAccess, \JsonSerializable
{
    private string $name;
    private string $price;
    private ?string $description;
    private ?string $category;

    /**
     * Initializes a MenuItem domain object.
     *
     * @param string $name Item display name
     * @param string|int $price Formatted price string (e.g. 'Rp 38.000') or integer Rupiah amount
     * @param string|null $description Optional description or ingredients list
     * @param string|null $category Optional menu category name
     */
    public function __construct(
        string $name,
        string|int $price,
        ?string $description = null,
        ?string $category = null
    ) {
        $this->name = trim($name);
        $this->price = is_int($price)
            ? 'Rp ' . number_format($price, 0, ',', '.')
            : trim((string) $price);
        $this->description = ($description !== null && trim($description) !== '') ? trim($description) : null;
        $this->category = ($category !== null && trim($category) !== '') ? trim($category) : null;
    }

    /**
     * Instantiates a MenuItem from an associative array.
     *
     * @param array<string, mixed> $data
     * @param string|null $category
     * @return self
     */
    public static function fromArray(array $data, ?string $category = null): self
    {
        return new self(
            name: (string) ($data['name'] ?? ''),
            price: $data['price'] ?? '',
            description: isset($data['description']) ? (string) $data['description'] : null,
            category: $category ?? (isset($data['category']) ? (string) $data['category'] : null)
        );
    }

    // ==========================================
    // Public Getters (Encapsulation — Week 6)
    // ==========================================

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function hasDescription(): bool
    {
        return $this->description !== null && $this->description !== '';
    }

    public function hasPrice(): bool
    {
        return $this->price !== '';
    }

    // ==========================================
    // Public Setters (Encapsulation — Week 6)
    // ==========================================

    public function setName(string $name): void
    {
        $this->name = trim($name);
    }

    public function setPrice(string|int $price): void
    {
        $this->price = is_int($price)
            ? 'Rp ' . number_format($price, 0, ',', '.')
            : trim((string) $price);
    }

    public function setDescription(?string $description): void
    {
        $this->description = ($description !== null && trim($description) !== '') ? trim($description) : null;
    }

    public function setCategory(?string $category): void
    {
        $this->category = ($category !== null && trim($category) !== '') ? trim($category) : null;
    }

    // ==========================================
    // Pure Domain Behavior Methods (No HTML)
    // ==========================================

    /**
     * Returns the full formatted price string (e.g. "Rp 35.000 (Regular)").
     */
    public function getFormattedPrice(): string
    {
        return $this->price;
    }

    /**
     * Extracts the primary price portion before any parenthetical note.
     * Example: "Rp 35.000 (Regular)" -> "Rp 35.000"
     */
    public function getMainPrice(): string
    {
        if ($this->price === '') {
            return '';
        }
        if (preg_match('/^(.*?)\s*(\([^)]+\))$/', $this->price, $matches)) {
            return trim($matches[1]);
        }
        return $this->price;
    }

    /**
     * Extracts the parenthetical price note if present, or null.
     * Example: "Rp 35.000 (Regular)" -> "(Regular)"
     */
    public function getPriceNote(): ?string
    {
        if ($this->price !== '' && preg_match('/^(.*?)\s*(\([^)]+\))$/', $this->price, $matches)) {
            return trim($matches[2]);
        }
        return null;
    }

    /**
     * Converts the MenuItem domain object to a plain associative array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $arr = [
            'name' => $this->name,
            'price' => $this->price,
        ];
        if ($this->description !== null) {
            $arr['description'] = $this->description;
        }
        if ($this->category !== null) {
            $arr['category'] = $this->category;
        }
        return $arr;
    }

    // ==========================================
    // ArrayAccess & JsonSerializable Support
    // ==========================================

    public function offsetExists(mixed $offset): bool
    {
        return in_array((string) $offset, ['name', 'price', 'description', 'category'], true);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return match ((string) $offset) {
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            default => null,
        };
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        match ((string) $offset) {
            'name' => $this->setName((string) $value),
            'price' => $this->setPrice($value),
            'description' => $this->setDescription($value !== null ? (string) $value : null),
            'category' => $this->setCategory($value !== null ? (string) $value : null),
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
