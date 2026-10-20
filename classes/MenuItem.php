<?php
/**
 * BiteMap - MenuItem Domain Model
 * Sprint 05 Object-Oriented PHP Implementation (Week 6)
 *
 * Encapsulates an individual menu offering within a restaurant category.
 * Demonstrates: Class, Private Properties, Constructor, Encapsulation,
 * Getters/Setters, Domain Methods, and Dynamic HTML Generation.
 *
 * @author BiteMap Engineering Team
 * @package BiteMap\Models
 */

declare(strict_types=1);

class MenuItem implements \ArrayAccess, \JsonSerializable
{
    /**
     * Item display name.
     */
    private string $name;

    /**
     * Item price (formatted string e.g. 'Rp 38.000' or raw string).
     */
    private string $price;

    /**
     * Optional item description / ingredients.
     */
    private ?string $description;

    /**
     * Optional menu category name this item belongs to.
     */
    private ?string $category;

    /**
     * Initializes a new MenuItem object instance.
     * Fulfills Week 6 Slide 4 (Constructor & Encapsulation).
     *
     * @param string $name Item name
     * @param string|int $price Item price string or numeric integer
     * @param string|null $description Optional descriptive text
     * @param string|null $category Optional menu category name
     */
    public function __construct(
        string $name,
        string|int $price,
        ?string $description = null,
        ?string $category = null
    ) {
        $this->name = trim($name);
        $this->price = is_int($price) ? 'Rp ' . number_format($price, 0, ',', '.') : trim((string)$price);
        $this->description = ($description !== null && trim($description) !== '') ? trim($description) : null;
        $this->category = ($category !== null && trim($category) !== '') ? trim($category) : null;
    }

    /**
     * Static factory method to instantiate a MenuItem from an associative array.
     *
     * @param array<string, mixed> $data
     * @param string|null $category
     * @return self
     */
    public static function fromArray(array $data, ?string $category = null): self
    {
        return new self(
            name: (string)($data['name'] ?? ''),
            price: $data['price'] ?? '',
            description: isset($data['description']) ? (string)$data['description'] : null,
            category: $category ?? (isset($data['category']) ? (string)$data['category'] : null)
        );
    }

    // ==========================================
    // Public Getters (Week 6 Slide 4)
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

    // ==========================================
    // Public Setters (Week 6 Slide 4)
    // ==========================================

    public function setName(string $name): void
    {
        $this->name = trim($name);
    }

    public function setPrice(string|int $price): void
    {
        $this->price = is_int($price) ? 'Rp ' . number_format($price, 0, ',', '.') : trim((string)$price);
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
    // Domain Methods & Dynamic HTML Generation (Week 6 Slide 5 & 9)
    // ==========================================

    /**
     * Formats the price for display, parsing parenthetical notes if present.
     * e.g. "Rp 35.000 (Regular)" -> <span class="menu-item-price-main">Rp 35.000</span> <span class="menu-item-price-note">(Regular)</span>
     *
     * @return string Safe HTML price string
     */
    public function renderPriceHtml(): string
    {
        if ($this->price === '') {
            return '';
        }

        if (preg_match('/^(.*?)\s*(\([^)]+\))$/', $this->price, $matches)) {
            $main = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
            $note = htmlspecialchars($matches[2], ENT_QUOTES, 'UTF-8');
            return '<span class="menu-item-price-main">' . $main . '</span> <span class="menu-item-price-note">' . $note . '</span>';
        }

        return htmlspecialchars($this->price, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Renders this menu item as complete semantic HTML matching BiteMap's design system.
     *
     * @return string Safe HTML markup
     */
    public function renderHtml(): string
    {
        $nameHtml = htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8');
        $descHtml = '';
        if ($this->hasDescription()) {
            $descHtml = '<p class="text-small text-muted" style="margin-top: var(--space-1);">' .
                htmlspecialchars((string)$this->description, ENT_QUOTES, 'UTF-8') .
                '</p>';
        }

        $priceHtml = '';
        if ($this->price !== '') {
            $priceHtml = '<div class="menu-item-price">' . $this->renderPriceHtml() . '</div>';
        }

        return <<<HTML
<div class="menu-item">
  <div class="menu-item-info">
    <h4>{$nameHtml}</h4>
    {$descHtml}
  </div>
  {$priceHtml}
</div>
HTML;
    }

    /**
     * Converts MenuItem to associative array for serialization / backward compatibility.
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
        return $arr;
    }

    // ==========================================
    // ArrayAccess Implementation (Defensive Backward Compatibility)
    // ==========================================

    public function offsetExists(mixed $offset): bool
    {
        return in_array($offset, ['name', 'price', 'description', 'category'], true);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return match ($offset) {
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            default => null,
        };
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        match ($offset) {
            'name' => $this->setName((string)$value),
            'price' => $this->setPrice($value),
            'description' => $this->setDescription($value !== null ? (string)$value : null),
            'category' => $this->setCategory($value !== null ? (string)$value : null),
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
