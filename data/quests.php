<?php
/**
 * BiteMap — Culinary Quest Dataset (data/quests.php)
 * Week 5 (Server-Side PHP Arrays) & Phase C/D (Culinary Quest MVP & Achievements)
 *
 * Defines deterministic quests, step objectives, XP rewards, and achievement badges
 * tied to the verified Malang restaurants in data/restaurants.php.
 *
 * Note on Verification:
 * Quest progress is self-reported/demo interaction state persisted in browser
 * localStorage; physical GPS visits are not claimed as verified.
 */

declare(strict_types=1);

return [
    [
        'id' => 'quest-malang-scout',
        'title' => 'Malang Culinary Scout',
        'description' => 'Inspect all 3 verified Malang culinary landmarks on the interactive map or restaurant detail pages.',
        'category' => 'Exploration',
        'difficulty' => 'Starter',
        'required_level' => 1,
        'min_xp' => 0,
        'xp_reward' => 150,
        'verification_note' => 'Self-reported / demo exploration progress (browser localStorage)',
        'target_restaurants' => [
            'okiru-ramen',
            'dialogi-signature-malang',
            'burger-king-ijen-besar-malang',
        ],
        'badge' => [
            'id' => 'badge-malang-scout',
            'name' => 'Malang Scout',
            'icon' => '🧭',
            'description' => 'Explored all 3 verified culinary landmarks in Klojen.',
        ],
        'objectives' => [
            [
                'id' => 'visit:okiru-ramen',
                'label' => 'Inspect Okiru Ramen (Jl. Bandung)',
                'restaurant_id' => 'okiru-ramen',
                'action_type' => 'visit',
                'step_xp' => 25,
            ],
            [
                'id' => 'visit:dialogi-signature-malang',
                'label' => 'Inspect Dialoogi Signature (Jl. Bandung)',
                'restaurant_id' => 'dialogi-signature-malang',
                'action_type' => 'visit',
                'step_xp' => 25,
            ],
            [
                'id' => 'visit:burger-king-ijen-besar-malang',
                'label' => 'Inspect Burger King (Ijen Boulevard)',
                'restaurant_id' => 'burger-king-ijen-besar-malang',
                'action_type' => 'visit',
                'step_xp' => 25,
            ],
        ],
    ],
    [
        'id' => 'quest-noodle-connoisseur',
        'title' => 'Ramen & Broth Connoisseur',
        'description' => 'Dive into Klojen’s Japanese ramen bar on Jl. Bandung by inspecting Okiru Ramen’s menu and logging a tasting check-in.',
        'category' => 'Asian Food',
        'difficulty' => 'Easy',
        'required_level' => 1,
        'min_xp' => 0,
        'xp_reward' => 120,
        'verification_note' => 'Self-reported / demo check-in progress (browser localStorage)',
        'target_restaurants' => [
            'okiru-ramen',
        ],
        'badge' => [
            'id' => 'badge-broth-master',
            'name' => 'Broth Master',
            'icon' => '🍜',
            'description' => 'Completed the Okiru Ramen Paitan & Chintan menu exploration quest.',
        ],
        'objectives' => [
            [
                'id' => 'visit:okiru-ramen',
                'label' => 'Inspect Okiru Ramen detail or map marker',
                'restaurant_id' => 'okiru-ramen',
                'action_type' => 'visit',
                'step_xp' => 25,
            ],
            [
                'id' => 'checkin:okiru-ramen',
                'label' => 'Log a self-reported tasting check-in at Okiru Ramen',
                'restaurant_id' => 'okiru-ramen',
                'action_type' => 'checkin',
                'step_xp' => 25,
            ],
        ],
    ],
    [
        'id' => 'quest-bandung-artisan',
        'title' => 'Bandung Street Artisan',
        'description' => 'Bookmark Dialoogi Signature on Jl. Bandung No. 40 to your Favorites and record a demo dining check-in.',
        'category' => 'Restaurant',
        'difficulty' => 'Medium',
        'required_level' => 1,
        'min_xp' => 0,
        'xp_reward' => 130,
        'verification_note' => 'Self-reported / demo favorite & check-in progress (browser localStorage)',
        'target_restaurants' => [
            'dialogi-signature-malang',
        ],
        'badge' => [
            'id' => 'badge-artisan-explorer',
            'name' => 'Artisan Explorer',
            'icon' => '☕',
            'description' => 'Saved and checked in at Dialoogi Signature on Jl. Bandung.',
        ],
        'objectives' => [
            [
                'id' => 'fav:dialogi-signature-malang',
                'label' => 'Save Dialoogi Signature to Favorites (♥)',
                'restaurant_id' => 'dialogi-signature-malang',
                'action_type' => 'favorite',
                'step_xp' => 25,
            ],
            [
                'id' => 'checkin:dialogi-signature-malang',
                'label' => 'Log a self-reported check-in at Dialoogi Signature',
                'restaurant_id' => 'dialogi-signature-malang',
                'action_type' => 'checkin',
                'step_xp' => 25,
            ],
        ],
    ],
    [
        'id' => 'quest-midnight-ijen',
        'title' => 'Ijen 24-Hour Night Owl',
        'description' => 'Reach Level 2 (150+ XP) to unlock this quest, then inspect and check in at Burger King Ijen Boulevard (Open 24 Hours).',
        'category' => 'Fast Food',
        'difficulty' => 'Advanced',
        'required_level' => 2,
        'min_xp' => 150,
        'xp_reward' => 200,
        'verification_note' => 'Unlocks at Level 2 (150 XP) • Self-reported / demo progress',
        'target_restaurants' => [
            'burger-king-ijen-besar-malang',
        ],
        'badge' => [
            'id' => 'badge-night-owl',
            'name' => 'Ijen Night Owl',
            'icon' => '🦉',
            'description' => 'Reached Level 2 and completed the 24-hour Ijen Boulevard quest.',
        ],
        'objectives' => [
            [
                'id' => 'visit:burger-king-ijen-besar-malang',
                'label' => 'Inspect Burger King Ijen (24-Hour Landmark)',
                'restaurant_id' => 'burger-king-ijen-besar-malang',
                'action_type' => 'visit',
                'step_xp' => 25,
            ],
            [
                'id' => 'checkin:burger-king-ijen-besar-malang',
                'label' => 'Log a self-reported 24h check-in at Burger King Ijen',
                'restaurant_id' => 'burger-king-ijen-besar-malang',
                'action_type' => 'checkin',
                'step_xp' => 25,
            ],
        ],
    ],
];
