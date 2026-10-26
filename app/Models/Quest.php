<?php
/**
 * BiteMap — Quest Domain Model (app/Models/Quest.php)
 * Week 6 (PHP OOP) & Week 7 (Vanilla PHP MVC — Pure Model Layer)
 *
 * Represents a Culinary Quest with objectives, XP rewards, level requirements,
 * and achievement badge metadata.
 *
 * Strictly adheres to Week 7 MVC separation: ZERO HTML markup inside the Model.
 */

declare(strict_types=1);

class Quest implements \ArrayAccess, \JsonSerializable
{
    private string $id;
    private string $title;
    private string $description;
    private string $category;
    private string $difficulty;
    private int $requiredLevel;
    private int $minXp;
    private int $xpReward;
    private string $verificationNote;

    /**
     * @var array<int, string>
     */
    private array $targetRestaurants;

    /**
     * @var array{id: string, name: string, icon: string, description: string}
     */
    private array $badge;

    /**
     * @var array<int, array{id: string, label: string, restaurant_id: string, action_type: string, step_xp: int}>
     */
    private array $objectives;

    /**
     * @var array<int, self>|null
     */
    private static ?array $repositoryCache = null;

    /**
     * @param string $id
     * @param string $title
     * @param string $description
     * @param string $category
     * @param string $difficulty
     * @param int $requiredLevel
     * @param int $minXp
     * @param int $xpReward
     * @param string $verificationNote
     * @param array<int, string> $targetRestaurants
     * @param array<string, mixed> $badge
     * @param array<int, array<string, mixed>> $objectives
     */
    public function __construct(
        string $id,
        string $title,
        string $description,
        string $category = 'Exploration',
        string $difficulty = 'Starter',
        int $requiredLevel = 1,
        int $minXp = 0,
        int $xpReward = 100,
        string $verificationNote = 'Self-reported / demo progress',
        array $targetRestaurants = [],
        array $badge = [],
        array $objectives = []
    ) {
        $this->id = trim($id);
        $this->title = trim($title);
        $this->description = trim($description);
        $this->category = trim($category);
        $this->difficulty = trim($difficulty);
        $this->requiredLevel = max(1, $requiredLevel);
        $this->minXp = max(0, $minXp);
        $this->xpReward = max(0, $xpReward);
        $this->verificationNote = trim($verificationNote);
        $this->targetRestaurants = array_values(array_map('strval', $targetRestaurants));
        $this->badge = [
            'id' => (string) ($badge['id'] ?? ('badge-' . $this->id)),
            'name' => (string) ($badge['name'] ?? $this->title),
            'icon' => (string) ($badge['icon'] ?? '🏅'),
            'description' => (string) ($badge['description'] ?? $this->description),
        ];

        $this->objectives = [];
        foreach ($objectives as $obj) {
            if (is_array($obj)) {
                $this->objectives[] = [
                    'id' => (string) ($obj['id'] ?? ''),
                    'label' => (string) ($obj['label'] ?? ''),
                    'restaurant_id' => (string) ($obj['restaurant_id'] ?? ''),
                    'action_type' => (string) ($obj['action_type'] ?? 'visit'),
                    'step_xp' => isset($obj['step_xp']) ? (int) $obj['step_xp'] : 25,
                ];
            }
        }
    }

    /**
     * Instantiates a Quest object from an associative array.
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) ($data['id'] ?? ''),
            title: (string) ($data['title'] ?? ''),
            description: (string) ($data['description'] ?? ''),
            category: (string) ($data['category'] ?? 'Exploration'),
            difficulty: (string) ($data['difficulty'] ?? 'Starter'),
            requiredLevel: isset($data['required_level']) ? (int) $data['required_level'] : 1,
            minXp: isset($data['min_xp']) ? (int) $data['min_xp'] : 0,
            xpReward: isset($data['xp_reward']) ? (int) $data['xp_reward'] : 100,
            verificationNote: (string) ($data['verification_note'] ?? 'Self-reported / demo progress'),
            targetRestaurants: is_array($data['target_restaurants'] ?? null) ? $data['target_restaurants'] : [],
            badge: is_array($data['badge'] ?? null) ? $data['badge'] : [],
            objectives: is_array($data['objectives'] ?? null) ? $data['objectives'] : []
        );
    }

    // ==========================================
    // Model Repository Query Methods (Week 7 MVC)
    // ==========================================

    /**
     * Returns all Culinary Quests from data/quests.php as Quest domain objects.
     *
     * @return array<int, self>
     */
    public static function all(): array
    {
        if (self::$repositoryCache === null) {
            $dataFile = dirname(__DIR__, 2) . '/data/quests.php';
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
     * Finds a Quest by its unique slug ID.
     */
    public static function findById(?string $id): ?self
    {
        if ($id === null || trim($id) === '') {
            return null;
        }
        $target = trim($id);
        foreach (self::all() as $quest) {
            if ($quest->getId() === $target) {
                return $quest;
            }
        }
        return null;
    }

    /**
     * Returns all quests that target a given restaurant ID.
     *
     * @return array<int, self>
     */
    public static function forRestaurant(string $restaurantId): array
    {
        $cleanId = trim($restaurantId);
        return array_values(array_filter(
            self::all(),
            static fn(self $q): bool => $q->targetsRestaurant($cleanId)
        ));
    }

    // ==========================================
    // Public Getters (Encapsulation — Week 6)
    // ==========================================

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    public function getRequiredLevel(): int
    {
        return $this->requiredLevel;
    }

    public function getMinXp(): int
    {
        return $this->minXp;
    }

    public function getXpReward(): int
    {
        return $this->xpReward;
    }

    public function getVerificationNote(): string
    {
        return $this->verificationNote;
    }

    /**
     * @return array<int, string>
     */
    public function getTargetRestaurants(): array
    {
        return $this->targetRestaurants;
    }

    /**
     * @return array{id: string, name: string, icon: string, description: string}
     */
    public function getBadge(): array
    {
        return $this->badge;
    }

    public function getBadgeId(): string
    {
        return $this->badge['id'];
    }

    public function getBadgeName(): string
    {
        return $this->badge['name'];
    }

    public function getBadgeIcon(): string
    {
        return $this->badge['icon'];
    }

    public function getBadgeDescription(): string
    {
        return $this->badge['description'];
    }

    /**
     * @return array<int, array{id: string, label: string, restaurant_id: string, action_type: string, step_xp: int}>
     */
    public function getObjectives(): array
    {
        return $this->objectives;
    }

    public function getObjectiveCount(): int
    {
        return count($this->objectives);
    }

    // ==========================================
    // Pure Domain Behavior Methods (No HTML)
    // ==========================================

    public function targetsRestaurant(string $restaurantId): bool
    {
        return in_array(trim($restaurantId), $this->targetRestaurants, true);
    }

    public function isLockedByDefault(): bool
    {
        return $this->requiredLevel > 1 || $this->minXp > 0;
    }

    /**
     * Returns total maximum XP obtainable from this quest (step XP + completion bonus).
     */
    public function getTotalPossibleXp(): int
    {
        $stepsXp = 0;
        foreach ($this->objectives as $obj) {
            $stepsXp += (int) ($obj['step_xp'] ?? 25);
        }
        return $stepsXp + $this->xpReward;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'difficulty' => $this->difficulty,
            'required_level' => $this->requiredLevel,
            'min_xp' => $this->minXp,
            'xp_reward' => $this->xpReward,
            'total_possible_xp' => $this->getTotalPossibleXp(),
            'verification_note' => $this->verificationNote,
            'target_restaurants' => $this->targetRestaurants,
            'badge' => $this->badge,
            'objectives' => $this->objectives,
            'objective_count' => $this->getObjectiveCount(),
        ];
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists((string) $offset, $this->toArray());
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->toArray()[(string) $offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        // Immutable keys
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
