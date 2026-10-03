/**
 * BiteMap JavaScript
 * Phase 02 - Shared application entry point
 */
'use strict';

// ==========================================
// Local Restaurant Data
// (Single canonical source. Do NOT duplicate.)
// Fields sourced strictly from existing HTML content.
// ==========================================

const BITEMAP_RESTAURANTS = [
    {
        id: 'ramenku',
        name: 'Ramenku',
        category: 'Asian Food',
        cuisine: 'Japanese',
        rating: 4.8,
        distance: 1.2,
        description: 'Ramenku serves comforting Japanese ramen, handmade sides, and simple drinks in a warm casual setting. A relaxed place for a quick meal or a casual dinner.',
        location: 'Jl. Contoh Kuliner No. 12, Malang',
        hours: {
            Monday:    '11:00 – 22:00',
            Tuesday:   '11:00 – 22:00',
            Wednesday: '11:00 – 22:00',
            Thursday:  '11:00 – 22:00',
            Friday:    '11:00 – 22:30',
            Saturday:  '11:00 – 22:30',
            Sunday:    '11:00 – 21:00',
        },
        gallery: [
            { alt: 'Bowl of Ramen' },
            { alt: 'Interior view of Ramenku' },
            { alt: 'Side dish of Gyoza' },
        ],
        reservation_enabled: true,
        menu: [
            {
                category: 'Ramen',
                items: [
                    {
                        name: 'Shoyu Ramen',
                        description: 'Classic soy-based ramen with chicken and spring onions.',
                        price: 'Rp35.000',
                    },
                    {
                        name: 'Tantan Ramen',
                        description: 'Creamy sesame ramen with a mild spicy finish.',
                        price: 'Rp38.000',
                    },
                ],
            },
            {
                category: 'Side Dish',
                items: [
                    {
                        name: 'Gyoza',
                        description: 'Pan-fried handmade dumplings.',
                        price: 'Rp25.000',
                    },
                    {
                        name: 'Karaage',
                        description: 'Japanese-style crispy chicken.',
                        price: 'Rp28.000',
                    },
                ],
            },
            {
                category: 'Drinks',
                items: [
                    {
                        name: 'Ocha',
                        description: null,
                        price: 'Rp10.000',
                    },
                    {
                        name: 'Matcha Latte',
                        description: null,
                        price: 'Rp22.000',
                    },
                ],
            },
        ],
    },
    {
        id: 'kopi-senja',
        name: 'Kopi Senja',
        category: 'Cafe & Coffee',
        cuisine: null,
        rating: 4.9,
        distance: 0.8,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'warung-nusa',
        name: 'Warung Nusa',
        category: 'Local Food',
        cuisine: null,
        rating: 4.7,
        distance: 1.5,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'sora-coffee',
        name: 'Sora Coffee',
        category: 'Cafe & Coffee',
        cuisine: null,
        rating: 4.8,
        distance: 3.0,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'burger-house',
        name: 'Burger House',
        category: 'Fast Food',
        cuisine: null,
        rating: 4.6,
        distance: 2.5,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'dapur-lokal',
        name: 'Dapur Lokal',
        category: 'Local Food',
        cuisine: null,
        rating: 4.5,
        distance: 1.9,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'miso-corner',
        name: 'Miso Corner',
        category: 'Asian Food',
        cuisine: null,
        rating: 4.7,
        distance: 2.1,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'taman-rasa',
        name: 'Taman Rasa',
        category: 'Local Food',
        cuisine: null,
        rating: 4.6,
        distance: 4.0,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'bean-roasters',
        name: 'Bean Roasters',
        category: 'Cafe & Coffee',
        cuisine: null,
        rating: 4.7,
        distance: 4.2,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'morning-brew',
        name: 'Morning Brew',
        category: 'Cafe & Coffee',
        cuisine: null,
        rating: 4.6,
        distance: 2.2,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'the-library-cafe',
        name: 'The Library Cafe',
        category: 'Cafe & Coffee',
        cuisine: null,
        rating: 4.9,
        distance: 5.1,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'quiet-space',
        name: 'Quiet Space',
        category: 'Cafe & Coffee',
        cuisine: null,
        rating: 4.7,
        distance: 2.8,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
    {
        id: 'work-and-brew',
        name: 'Work & Brew',
        category: 'Cafe & Coffee',
        cuisine: null,
        rating: 4.6,
        distance: 3.5,
        description: null,
        location: null,
        hours: null,
        gallery: [],
        reservation_enabled: false,
        menu: [],
    },
];

/**
 * Returns a shallow copy of the canonical restaurant dataset.
 * Does not mutate the source array.
 * Does not fetch anything.
 */
function getRestaurants() {
    return [...BITEMAP_RESTAURANTS];
}

/**
 * Finds a single restaurant by its stable local ID.
 * Returns the restaurant object, or null if not found.
 */
function getRestaurantById(id) {
    if (!id) return null;
    return BITEMAP_RESTAURANTS.find(r => r.id === id) || null;
}

/**
 * Retrieves the menu data from a canonical restaurant object.
 * Returns an array of menu categories, or an empty array if none exist.
 */
function getRestaurantMenu(restaurant) {
    return (restaurant && Array.isArray(restaurant.menu)) ? restaurant.menu : [];
}

/**
 * Retrieves the verified location/address of a restaurant.
 * Returns the address string or null if unavailable.
 */
function getRestaurantLocation(restaurant) {
    return (restaurant && typeof restaurant.location === 'string' && restaurant.location.trim().length > 0)
        ? restaurant.location
        : null;
}

/**
 * Retrieves the verified opening hours of a restaurant.
 * Returns the hours record or null if unavailable.
 */
function getRestaurantHours(restaurant) {
    return (restaurant && restaurant.hours && typeof restaurant.hours === 'object' && Object.keys(restaurant.hours).length > 0)
        ? restaurant.hours
        : null;
}

/**
 * Safely determines whether a restaurant has reservation capability enabled.
 * Returns a boolean.
 */
function hasReservationCapability(restaurant) {
    return !!(restaurant && restaurant.reservation_enabled === true);
}

// ==========================================
// Centralized Favorite State & Helpers
// ==========================================

const BITEMAP_FAVORITES = new Set(['kopi-senja', 'sora-coffee', 'dapur-lokal']);

/**
 * Checks if a restaurant is currently in the favorites set.
 * @param {string} restaurantId
 * @returns {boolean}
 */
function isFavorite(restaurantId) {
    if (!restaurantId) return false;
    return BITEMAP_FAVORITES.has(restaurantId);
}

/**
 * Toggles a restaurant in the centralized favorites set.
 * Returns the new active state (true = saved, false = removed).
 * @param {string} restaurantId
 * @returns {boolean}
 */
function toggleFavorite(restaurantId) {
    if (!restaurantId) return false;
    if (BITEMAP_FAVORITES.has(restaurantId)) {
        BITEMAP_FAVORITES.delete(restaurantId);
        return false;
    } else {
        BITEMAP_FAVORITES.add(restaurantId);
        return true;
    }
}

/**
 * Retrieves the canonical restaurant objects for all active favorites.
 * Filters out invalid or stale IDs safely.
 * @returns {Array<object>}
 */
function getFavoriteRestaurants() {
    return [...BITEMAP_FAVORITES]
        .map(id => getRestaurantById(id))
        .filter(Boolean);
}

/**
 * Synchronizes visual and ARIA attributes for a favorite button.
 * Works seamlessly for both card buttons (.btn-favorite) and detail page buttons ([data-detail="save-btn"]).
 * @param {HTMLButtonElement} button
 * @param {string|object} restaurantOrId
 */
function syncFavoriteButton(button, restaurantOrId) {
    if (!button) return;
    const restaurant = typeof restaurantOrId === 'string' ? getRestaurantById(restaurantOrId) : restaurantOrId;
    const id = typeof restaurantOrId === 'string' ? restaurantOrId : (restaurant ? restaurant.id : null);
    if (!id) return;

    const active = isFavorite(id);
    const restaurantName = restaurant ? restaurant.name : 'restaurant';
    const isCardFav = button.classList.contains('btn-favorite');

    button.setAttribute('aria-pressed', active ? 'true' : 'false');

    if (isCardFav) {
        if (active) {
            button.classList.add('is-active');
            button.setAttribute('aria-label', `Remove ${restaurantName} from favorites`);
        } else {
            button.classList.remove('is-active');
            button.setAttribute('aria-label', `Save ${restaurantName} to favorites`);
        }
    } else {
        if (active) {
            button.classList.remove('btn-outline');
            button.classList.add('btn-primary');
            button.textContent = 'Saved';
            button.setAttribute('aria-label', `Remove ${restaurantName} from favorites`);
        } else {
            button.classList.remove('btn-primary');
            button.classList.add('btn-outline');
            button.textContent = 'Save';
            button.setAttribute('aria-label', `Save ${restaurantName} to favorites`);
        }
    }
}

// ==========================================
// Utilities
// ==========================================

function $(selector, parent = document) {
    if (!parent || typeof parent.querySelector !== 'function') return null;
    return parent.querySelector(selector);
}

function $$(selector, parent = document) {
    if (!parent || typeof parent.querySelectorAll !== 'function') return [];
    return [...parent.querySelectorAll(selector)];
}

// ==========================================
// Page Detection
// ==========================================

function getCurrentPage() {
    const path = window.location.pathname;
    const page = path.split('/').pop().replace('.html', '');
    return page || 'index';
}

// ==========================================
// Mobile Navigation
// ==========================================

function initMobileNavigation() {
    const navToggle = $('.nav-toggle');
    const navLinks = $('#nav-links');

    if (!navToggle || !navLinks) return;
    if (navToggle.dataset.navBound) return;
    navToggle.dataset.navBound = 'true';

    function toggleMenu() {
        const isOpen = navLinks.classList.toggle('nav-open');
        navToggle.setAttribute('aria-expanded', isOpen);
        navToggle.setAttribute('aria-label', isOpen ? 'Close navigation menu' : 'Open navigation menu');
    }

    function closeMenu() {
        if (navLinks.classList.contains('nav-open')) {
            navLinks.classList.remove('nav-open');
            navToggle.setAttribute('aria-expanded', 'false');
            navToggle.setAttribute('aria-label', 'Open navigation menu');
        }
    }

    navToggle.addEventListener('click', toggleMenu);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && navLinks.classList.contains('nav-open')) {
            closeMenu();
            navToggle.focus();
        }
    });
    navLinks.addEventListener('click', (e) => {
        if (e.target.closest('a') || e.target.closest('button')) closeMenu();
    });
}

// ==========================================
// Dynamic Restaurant Card Rendering
// ==========================================

/**
 * Creates a single restaurant card DOM element from a data object.
 * Mirrors the exact markup of the existing static cards in explore.html.
 */
function createRestaurantCard(restaurant, linkBase = 'restaurant.html', isActiveFavorite = null, customDistance = null) {
    const href = linkBase + '?id=' + encodeURIComponent(restaurant.id);
    const article = document.createElement('article');
    article.className = 'restaurant-card';
    article.dataset.id = restaurant.id;
    article.dataset.restaurantId = restaurant.id;

    const ratingText = restaurant.rating != null ? restaurant.rating.toFixed(1) : '—';
    let distanceText = restaurant.distance != null ? restaurant.distance.toFixed(1) + ' km' : '--';
    if (customDistance != null) {
        distanceText = formatDistance(customDistance) || distanceText;
    }
    const isFav = (typeof isActiveFavorite === 'boolean') ? isActiveFavorite : isFavorite(restaurant.id);
    const favClass = isFav ? 'btn-favorite is-active' : 'btn-favorite';
    const favLabel = isFav ? `Remove ${restaurant.name} from favorites` : `Save ${restaurant.name} to favorites`;
    const favPressed = isFav ? 'true' : 'false';

    article.innerHTML = `<button type="button" class="${favClass}" aria-label="${favLabel}" aria-pressed="${favPressed}"><span aria-hidden="true">&hearts;</span></button>
      <a href="${href}" class="card-link-wrapper" aria-label="View ${restaurant.name}">
        <div class="restaurant-card-image" aria-hidden="true"></div>
        <div class="restaurant-card-content">
          <h3 class="text-lead">${restaurant.name}</h3>
          <p class="text-small text-muted" style="margin-bottom: var(--space-1);">${restaurant.category}</p>
          <p class="text-meta text-muted"><span class="rating-icon" aria-hidden="true">&#9733;</span> ${ratingText} &bull; ${distanceText}</p>
        </div>
      </a>`;

    return article;
}

/**
 * Renders all restaurants from the canonical dataset into the target .restaurant-grid.
 * Clears any previous content to prevent duplication.
 */
function renderRestaurantCards(restaurants, grid) {
    if (!grid) return;

    // Fragment for efficient single-reflow insertion
    const fragment = document.createDocumentFragment();
    restaurants.forEach(restaurant => {
        fragment.appendChild(createRestaurantCard(restaurant, 'restaurant.html'));
    });

    // Clear only the injected comment placeholder — safe even if already empty
    grid.innerHTML = '';
    grid.appendChild(fragment);
}

// ==========================================
// Homepage Rail Rendering
// ==========================================

/**
 * Renders up to 5 cards per homepage rail from BITEMAP_RESTAURANTS.
 * Each rail uses a derived subset — never a second hard-coded dataset.
 * linkBase uses pages/ prefix because index.html is at root level.
 */
function renderHomepageRails() {
    const all = getRestaurants();
    const MAX = 5;
    const linkBase = 'pages/restaurant.html';

    function fillRail(sectionId, filterFn, sortFn) {
        const section = document.querySelector('[aria-labelledby="' + sectionId + '"]');
        if (!section) return;
        const rail = section.querySelector('.content-rail');
        if (!rail) return;

        let subset = filterFn ? all.filter(filterFn) : [...all];
        if (sortFn) subset = subset.sort(sortFn);
        subset = subset.slice(0, MAX);

        const fragment = document.createDocumentFragment();
        subset.forEach(r => fragment.appendChild(createRestaurantCard(r, linkBase)));
        rail.innerHTML = '';
        rail.appendChild(fragment);
    }

    // Rail 1: "Popular Near You" — highest-rated restaurants, all categories
    fillRail('popular-heading', null, (a, b) => b.rating - a.rating);

    // Rail 2: "Cafe & Coffee" — category match, preserve natural dataset order
    fillRail('cafe-heading', r => r.category === 'Cafe & Coffee', null);

    // Rail 3: "Good Places for Study" — highest-rated Cafe & Coffee
    // No "study" tag in dataset. Highest-rated cafes matches original static card selection.
    fillRail('curated-heading', r => r.category === 'Cafe & Coffee', (a, b) => b.rating - a.rating);
}

// ==========================================
// Location & Nearby Discovery
// ==========================================

/**
 * Calculates the great-circle distance between two points on the Earth's surface
 * using the Haversine formula.
 * @param {number} lat1 - Latitude of point 1 in degrees
 * @param {number} lon1 - Longitude of point 1 in degrees
 * @param {number} lat2 - Latitude of point 2 in degrees
 * @param {number} lon2 - Longitude of point 2 in degrees
 * @returns {number|null} Distance in kilometers, or null if coordinates are invalid
 */
function calculateDistanceKm(lat1, lon1, lat2, lon2) {
    if (typeof lat1 !== 'number' || typeof lon1 !== 'number' ||
        typeof lat2 !== 'number' || typeof lon2 !== 'number' ||
        isNaN(lat1) || isNaN(lon1) || isNaN(lat2) || isNaN(lon2)) {
        return null;
    }

    const toRad = deg => (deg * Math.PI) / 180;
    const R = 6371; // Earth's mean radius in km

    const dLat = toRad(lat2 - lat1);
    const dLon = toRad(lon2 - lon1);
    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    return R * c;
}

/**
 * Formats distance in kilometers into a user-friendly string.
 * @param {number} distanceKm - Distance in kilometers
 * @returns {string|null} Formatted distance string (e.g., '800 m away', '1.4 km away')
 */
function formatDistance(distanceKm) {
    if (distanceKm == null || typeof distanceKm !== 'number' || isNaN(distanceKm)) {
        return null;
    }
    if (distanceKm < 1) {
        const meters = Math.round(distanceKm * 1000);
        return meters < 50 ? 'Nearby' : `${meters} m away`;
    }
    return `${distanceKm.toFixed(1)} km away`;
}

/**
 * Initializes the frontend location-aware discovery experience for the "Popular Near You" section.
 * Manages geolocation permission, calculates approximate distance using Haversine formula,
 * ranks restaurants with valid coordinates, and displays graceful states.
 * Scoped strictly to runtime memory — never persists coordinates or calls external APIs.
 */
function initNearbyDiscovery() {
    const section = document.querySelector('[aria-labelledby="popular-heading"]');
    if (!section) return;

    const btnLocation = document.getElementById('btn-nearby-location');
    const rail = section.querySelector('.content-rail');
    const statusEl = document.getElementById('nearby-status');
    const subtitle = document.getElementById('popular-subtitle');

    if (!btnLocation || !rail) return;

    function setStatus(message) {
        if (!statusEl) return;
        if (message) {
            statusEl.textContent = message;
            statusEl.style.display = 'block';
        } else {
            statusEl.textContent = '';
            statusEl.style.display = 'none';
        }
    }

    if (btnLocation.dataset.nearbyBound) return;
    btnLocation.dataset.nearbyBound = 'true';

    btnLocation.addEventListener('click', () => {
        // 1. Check if Geolocation API is available in browser
        if (!navigator.geolocation) {
            setStatus("Location isn't available on this browser.");
            return;
        }

        // 2. Set Requesting state
        btnLocation.disabled = true;
        btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Finding places near you...';
        setStatus('Finding places near you...');

        // 3. Request current position
        navigator.geolocation.getCurrentPosition(
            (position) => {
                btnLocation.disabled = false;
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                // Filter canonical restaurants that have valid geographic coordinates
                const all = getRestaurants();
                const withCoords = all.filter(r =>
                    typeof r.latitude === 'number' && typeof r.longitude === 'number' &&
                    !isNaN(r.latitude) && !isNaN(r.longitude)
                );

                if (withCoords.length > 0) {
                    // Calculate distance for restaurants with valid coordinates
                    const nearbyList = withCoords.map(r => ({
                        restaurant: r,
                        distKm: calculateDistanceKm(userLat, userLng, r.latitude, r.longitude)
                    }));

                    // Sort by distance ascending
                    nearbyList.sort((a, b) => a.distKm - b.distKm);

                    // Render up to 5 closest restaurants
                    const MAX = 5;
                    const topNearby = nearbyList.slice(0, MAX);
                    const fragment = document.createDocumentFragment();
                    topNearby.forEach(item => {
                        fragment.appendChild(createRestaurantCard(item.restaurant, 'pages/restaurant.html', null, item.distKm));
                    });

                    rail.innerHTML = '';
                    rail.appendChild(fragment);

                    // Re-bind favorite listeners for newly injected cards
                    initFavorites(rail);

                    if (subtitle) subtitle.textContent = 'Restaurants near your location.';
                    setStatus('Showing restaurants near your location.');
                    btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Location active';
                } else {
                    // Safe empty state: no restaurants with coordinates exist yet
                    rail.innerHTML = '<div class="empty-state nearby-empty-state" role="status" style="width: 100%; text-align: center; padding: var(--space-6);"><p class="empty-state-desc text-muted">No nearby locations available yet.</p><a href="pages/explore.html" class="btn btn-outline" style="margin-top: var(--space-4);">Explore All Restaurants</a></div>';
                    if (subtitle) subtitle.textContent = 'No nearby locations available yet.';
                    setStatus('No nearby locations available yet.');
                    btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Find near me';
                }
            },
            (err) => {
                btnLocation.disabled = false;
                btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Find near me';

                // Handle error states gracefully without exposing error objects or crashing
                if (err && err.code === 1) {
                    // PERMISSION_DENIED
                    setStatus('Location access is off. Explore restaurants by area instead.');
                } else if (err && err.code === 2) {
                    // POSITION_UNAVAILABLE
                    setStatus('Location unavailable. Showing popular places instead.');
                } else if (err && err.code === 3) {
                    // TIMEOUT
                    setStatus('Location request timed out. Showing popular places instead.');
                } else {
                    setStatus('Unable to find your location. Showing popular places instead.');
                }

                // Preserve existing popular rail content so the homepage remains fully usable
                if (rail.children.length === 0) {
                    renderHomepageRails();
                }
            },
            {
                enableHighAccuracy: false,
                timeout: 10000,
                maximumAge: 60000
            }
        );
    });
}

/// ==========================================
// Homepage Hero Search
// ==========================================

function initHeroSearch() {
    const heroSearch = $('#hero-search');
    if (!heroSearch) return;
    const form = heroSearch.closest('form');
    if (!form) return;
    if (form.dataset.heroBound) return;
    form.dataset.heroBound = 'true';

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const query = heroSearch.value.trim();
        if (query) {
            window.location.href = 'pages/explore.html?q=' + encodeURIComponent(query);
        } else {
            window.location.href = 'pages/explore.html';
        }
    });
}

// ==========================================
// Unified Discovery Engine
// ==========================================

/**
 * Filters and sorts an array of restaurant objects using canonical data attributes.
 * Reusable across explore page and any search/discovery context.
 *
 * @param {Array<Object>} restaurants - Array of restaurant objects from BITEMAP_RESTAURANTS
 * @param {Object} options - Filtering and sorting criteria
 * @param {string} [options.query] - Free-text search term matching name, category, cuisine, description
 * @param {string} [options.chipCategory] - Category from active pill chip (e.g. "Asian Food", "Cafe & Coffee")
 * @param {string} [options.selectCategory] - Category from dropdown select (e.g. "Restaurant", "Cafe & Coffee")
 * @param {string} [options.selectCuisine] - Cuisine from dropdown select (e.g. "Japanese", "Indonesian")
 * @param {number} [options.minRating] - Minimum rating filter (e.g. 4.5, 4.0, 3.5)
 * @param {number} [options.maxDistance] - Maximum distance filter in km (e.g. 1, 2, 5, 10)
 * @param {string} [options.sort] - Sort criteria: 'Recommended' | 'Rating' | 'Distance' | 'Name'
 * @returns {Array<Object>} - Filtered and sorted restaurant objects
 */
function filterRestaurants(restaurants, options = {}) {
    if (!Array.isArray(restaurants)) return [];

    const query = (options.query || '').trim().toLowerCase();
    const chipCat = (options.chipCategory || '').trim().toLowerCase();
    const selectCat = (options.selectCategory || '').trim().toLowerCase();
    const selectCui = (options.selectCuisine || '').trim().toLowerCase();
    const minRating = typeof options.minRating === 'number' ? options.minRating : 0;
    const maxDistance = typeof options.maxDistance === 'number' ? options.maxDistance : 999;
    const sort = options.sort || 'Recommended';

    const results = restaurants.filter(r => {
        // 1. Search query: case-insensitive, whitespace tolerant, matches name, category, cuisine, description
        if (query) {
            const nameMatch = r.name && r.name.toLowerCase().includes(query);
            const catMatch = r.category && r.category.toLowerCase().includes(query);
            const cuiMatch = r.cuisine && r.cuisine.toLowerCase().includes(query);
            const descMatch = r.description && r.description.toLowerCase().includes(query);
            if (!nameMatch && !catMatch && !cuiMatch && !descMatch) {
                return false;
            }
        }

        // 2. Category Chip: matches canonical r.category
        if (chipCat) {
            if (!r.category || !r.category.toLowerCase().includes(chipCat)) {
                return false;
            }
        }

        // 3. Category Select: matches canonical r.category
        if (selectCat) {
            if (!r.category || !r.category.toLowerCase().includes(selectCat)) {
                return false;
            }
        }

        // 4. Cuisine Select: matches canonical r.cuisine
        if (selectCui) {
            if (!r.cuisine || !r.cuisine.toLowerCase().includes(selectCui)) {
                return false;
            }
        }

        // 5. Rating Filter: matches r.rating >= minRating
        if (minRating > 0) {
            if (typeof r.rating !== 'number' || r.rating < minRating) {
                return false;
            }
        }

        // 6. Distance Filter: matches r.distance <= maxDistance (graceful if distance missing)
        if (maxDistance < 999) {
            if (typeof r.distance !== 'number' || r.distance > maxDistance) {
                return false;
            }
        }

        return true;
    });

    // 7. Sorting
    if (sort === 'Rating') {
        results.sort((a, b) => {
            const ra = typeof a.rating === 'number' ? a.rating : -1;
            const rb = typeof b.rating === 'number' ? b.rating : -1;
            if (rb !== ra) return rb - ra;
            return restaurants.indexOf(a) - restaurants.indexOf(b);
        });
    } else if (sort === 'Distance') {
        results.sort((a, b) => {
            const da = typeof a.distance === 'number' ? a.distance : 999;
            const db = typeof b.distance === 'number' ? b.distance : 999;
            if (da !== db) return da - db;
            return restaurants.indexOf(a) - restaurants.indexOf(b);
        });
    } else if (sort === 'Name') {
        results.sort((a, b) => {
            const na = a.name || '';
            const nb = b.name || '';
            return na.localeCompare(nb);
        });
    } else {
        // 'Recommended' / Default order preserves canonical dataset position
        results.sort((a, b) => restaurants.indexOf(a) - restaurants.indexOf(b));
    }

    return results;
}

// ==========================================
// Explore Filters & Sorting
// ==========================================

function initExploreFilters() {
    const searchInput = $('#explore-search');
    const categoryBadges = $$('.badge-category');
    
    // Select existing filter controls
    const filterCatSelect = $('select[aria-label="Category filter"]');
    const filterCuiSelect = $('select[aria-label="Cuisine filter"]');
    const filterDistSelect = $('select[aria-label="Distance filter"]');
    const filterRatSelect = $('select[aria-label="Rating filter"]');
    const sortSelect = $('#sort-results');

    if (!searchInput && categoryBadges.length === 0) return;
    if (searchInput && searchInput.dataset.filtersBound) return;
    if (searchInput) searchInput.dataset.filtersBound = 'true';

    const mainContent = (searchInput && searchInput.closest('main')) || (categoryBadges[0] && categoryBadges[0].closest('main')) || document;
    const restaurantGrid = $('.restaurant-grid', mainContent);
    const restaurantCards = $$('.restaurant-card', mainContent);
    const emptyState = $('.empty-state', mainContent);
    const resultsCountEl = $('#results-count', mainContent) || $('.restaurant-results .text-meta', mainContent);
    const loadMoreContainer = $('.load-more-container', mainContent);
    const btnResetFilters = $('#btn-reset-filters', mainContent);
    const btnClearFilters = $('#btn-clear-filters', mainContent);

    // Map DOM cards by restaurant ID for non-destructive DOM toggling & reordering
    const cardMap = new Map();
    restaurantCards.forEach(card => {
        const id = card.dataset.id || (card.querySelector('a')?.href.match(/id=([^&]+)/) || [])[1];
        if (id) {
            cardMap.set(id, card);
        }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const initialQuery = urlParams.get('q');
    const initialCategory = urlParams.get('category');
    
    let currentCategory = '';

    if (searchInput && initialQuery) {
        searchInput.value = initialQuery;
    }

    if (initialCategory) {
        currentCategory = initialCategory.trim().toLowerCase();
    }

    function getCategoryName(badge) {
        let text = '';
        badge.childNodes.forEach(node => {
            if (node.nodeType === Node.TEXT_NODE) text += node.textContent;
        });
        return text.trim().toLowerCase();
    }

    function updateCategoryUI() {
        categoryBadges.forEach(badge => {
            if (badge.tagName.toLowerCase() === 'a' && badge.getAttribute('href') !== '#') {
                return;
            }
            const badgeText = getCategoryName(badge);
            if (badgeText === currentCategory) {
                badge.classList.remove('badge-neutral');
                badge.classList.add('badge-primary');
                badge.setAttribute('aria-pressed', 'true');
            } else {
                badge.classList.remove('badge-primary');
                badge.classList.add('badge-neutral');
                badge.setAttribute('aria-pressed', 'false');
            }
        });
    }

    function performFilters() {
        const query = (searchInput && typeof searchInput.value === 'string') ? searchInput.value.trim() : '';
        
        // Read native select states
        let selectCategory = '';
        if (filterCatSelect && filterCatSelect.value && filterCatSelect.value !== 'Category') {
            selectCategory = filterCatSelect.value.trim().toLowerCase();
        }

        let selectCuisine = '';
        if (filterCuiSelect && filterCuiSelect.value && filterCuiSelect.value !== 'Cuisine') {
            selectCuisine = filterCuiSelect.value.trim().toLowerCase();
        }
        
        // Extract numeric constraints (e.g. "< 5 km" -> 5)
        let maxDistance = 999;
        if (filterDistSelect && filterDistSelect.value && filterDistSelect.value !== 'Distance') {
            const match = filterDistSelect.value.match(/[\d.]+/);
            if (match) maxDistance = parseFloat(match[0]);
        }

        let minRating = 0;
        if (filterRatSelect && filterRatSelect.value && filterRatSelect.value !== 'Rating') {
            const match = filterRatSelect.value.match(/[\d.]+/);
            if (match) minRating = parseFloat(match[0]);
        }

        const sortVal = sortSelect ? sortSelect.value : 'Recommended';

        // Filter and sort canonical dataset
        const allRestaurants = getRestaurants();
        const filtered = filterRestaurants(allRestaurants, {
            query,
            chipCategory: currentCategory,
            selectCategory,
            selectCuisine,
            minRating,
            maxDistance,
            sort: sortVal
        });

        const matchingIds = new Set(filtered.map(r => r.id));
        let visibleCount = 0;

        // Toggle card visibility in DOM
        restaurantCards.forEach(card => {
            const id = card.dataset.id || (card.querySelector('a')?.href.match(/id=([^&]+)/) || [])[1];
            if (matchingIds.has(id)) {
                card.hidden = false;
                visibleCount++;
            } else {
                card.hidden = true;
            }
        });

        // Reorder visible DOM cards to reflect sorted order
        if (restaurantGrid) {
            filtered.forEach(r => {
                const card = cardMap.get(r.id);
                if (card) {
                    restaurantGrid.appendChild(card);
                }
            });
            // Keep hidden cards in grid for subsequent filter passes
            restaurantCards.forEach(card => {
                if (card.hidden) {
                    restaurantGrid.appendChild(card);
                }
            });
        }

        // Determine if any non-default filter is currently active
        const hasActiveFilters = Boolean(
            query ||
            currentCategory ||
            selectCategory ||
            selectCuisine ||
            minRating > 0 ||
            maxDistance < 999 ||
            sortVal !== 'Recommended'
        );

        // Update Result Count text
        if (resultsCountEl) {
            if (visibleCount === allRestaurants.length && !hasActiveFilters) {
                resultsCountEl.textContent = `${allRestaurants.length} restaurants`;
            } else if (visibleCount === 1) {
                resultsCountEl.textContent = '1 restaurant found';
            } else if (visibleCount === 0) {
                resultsCountEl.textContent = '0 restaurants found';
            } else {
                resultsCountEl.textContent = `${visibleCount} restaurants found`;
            }
        }

        // Empty State handling
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.style.display = 'flex';
                emptyState.removeAttribute('aria-hidden');
                if (loadMoreContainer) loadMoreContainer.style.display = 'none';
            } else {
                emptyState.style.display = 'none';
                emptyState.setAttribute('aria-hidden', 'true');
                if (loadMoreContainer) loadMoreContainer.style.display = '';
            }
        }

        // Clear Filters button in filter bar
        if (btnClearFilters) {
            btnClearFilters.style.display = hasActiveFilters ? 'inline-flex' : 'none';
        }
        
        // URL synchronization (without reload)
        const newUrl = new URL(window.location);
        if (query) {
            newUrl.searchParams.set('q', query);
        } else {
            newUrl.searchParams.delete('q');
        }
        
        if (currentCategory) {
            newUrl.searchParams.set('category', currentCategory);
        } else {
            newUrl.searchParams.delete('category');
        }
        
        window.history.replaceState({}, '', newUrl);
    }

    function clearAllFilters() {
        if (searchInput) searchInput.value = '';
        currentCategory = '';
        updateCategoryUI();
        if (filterCatSelect) filterCatSelect.selectedIndex = 0;
        if (filterCuiSelect) filterCuiSelect.selectedIndex = 0;
        if (filterDistSelect) filterDistSelect.selectedIndex = 0;
        if (filterRatSelect) filterRatSelect.selectedIndex = 0;
        if (sortSelect) sortSelect.selectedIndex = 0;
        performFilters();
    }

    // Attach interaction listeners
    if (searchInput) {
        searchInput.addEventListener('input', performFilters);
        const form = searchInput.closest('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                performFilters();
            });
        }
    }

    const nativeControls = [filterCatSelect, filterCuiSelect, filterDistSelect, filterRatSelect, sortSelect];
    nativeControls.forEach(control => {
        if (control) {
            control.addEventListener('change', performFilters);
        }
    });

    categoryBadges.forEach(badge => {
        if (badge.tagName.toLowerCase() === 'a' && badge.getAttribute('href') !== '#') {
            return;
        }

        badge.addEventListener('click', (e) => {
            e.preventDefault();
            const badgeText = getCategoryName(badge);
            if (currentCategory === badgeText) {
                currentCategory = '';
            } else {
                currentCategory = badgeText;
            }
            updateCategoryUI();
            performFilters();
        });
    });

    if (btnResetFilters) {
        btnResetFilters.addEventListener('click', (e) => {
            e.preventDefault();
            clearAllFilters();
        });
    }

    if (btnClearFilters) {
        btnClearFilters.addEventListener('click', (e) => {
            e.preventDefault();
            clearAllFilters();
        });
    }

    if (currentCategory) updateCategoryUI();
    performFilters();
}

// ==========================================
// Favorites
// ==========================================

function initFavorites(container = document) {
    const favButtons = $$('button[aria-label*="favorites"], [data-detail="save-btn"], .btn-favorite', container);
    
    if (favButtons.length === 0) return;

    favButtons.forEach(btn => {
        if (btn.dataset.favBound) return;
        btn.dataset.favBound = 'true';

        // Resolve restaurant ID from card or page context
        const card = btn.closest('.restaurant-card');
        let restaurantId = card ? (card.dataset.id || card.dataset.restaurantId) : null;
        if (!restaurantId && btn.dataset.restaurantId) {
            restaurantId = btn.dataset.restaurantId;
        }
        if (!restaurantId) {
            const params = new URLSearchParams(window.location.search);
            const pageId = params.get('id');
            if (pageId && getRestaurantById(pageId)) {
                restaurantId = pageId;
            }
        }

        // Standardize ARIA pressed and visual state on initial bind
        if (restaurantId) {
            syncFavoriteButton(btn, restaurantId);
        }

        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            if (!restaurantId) return;

            const isNowActive = toggleFavorite(restaurantId);

            // Sync all matching card buttons on the page
            const matchingCardButtons = $$(`.restaurant-card[data-id="${restaurantId}"] .btn-favorite, .restaurant-card[data-restaurant-id="${restaurantId}"] .btn-favorite`);
            matchingCardButtons.forEach(b => syncFavoriteButton(b, restaurantId));

            // Sync detail page save button if present
            const detailBtn = document.querySelector('[data-detail="save-btn"]');
            if (detailBtn) {
                const detailId = detailBtn.dataset.restaurantId || new URLSearchParams(window.location.search).get('id');
                if (detailId === restaurantId) {
                    syncFavoriteButton(detailBtn, restaurantId);
                }
            }

            // Sync the clicked button directly
            syncFavoriteButton(btn, restaurantId);

            // If on Dashboard favorites grid and item was removed, remove the card from DOM
            if (card && card.closest('[data-detail="dashboard-favorites-grid"]')) {
                if (!isNowActive) {
                    card.remove();
                    updateFavoritesState();
                }
            }
        });
    });
}

// ==========================================
// Dynamic Restaurant Gallery Rendering
// ==========================================

/**
 * Renders gallery figures into the gallery-grid from restaurant.gallery data.
 * Uses the canonical gallery descriptor format: { alt: string }.
 * No image src values exist in the current dataset — figures are CSS placeholder blocks
 * styled by .gallery-image-wrapper, exactly as the original static gallery.
 * If the restaurant has no gallery items, shows the existing empty-state fallback.
 */
function renderRestaurantGallery(restaurant) {
    const galleryGrid = document.querySelector('[data-detail="gallery-grid"]');
    const galleryEmpty = document.querySelector('[data-detail="gallery-empty"]');

    if (!galleryGrid) return;

    const items = (restaurant && restaurant.gallery) ? restaurant.gallery : [];

    if (items.length === 0) {
        // No gallery items: clear grid and show fallback
        galleryGrid.innerHTML = '';
        galleryGrid.setAttribute('aria-hidden', 'true');
        if (galleryEmpty) {
            galleryEmpty.style.display = 'block';
            galleryEmpty.removeAttribute('aria-hidden');
        }
        return;
    }

    // Has items: render figures matching the existing static structure exactly
    const fragment = document.createDocumentFragment();
    items.forEach(function(item) {
        var li = document.createElement('li');
        var fig = document.createElement('figure');
        fig.className = 'gallery-image-wrapper';
        fig.setAttribute('aria-label', item.alt || 'Gallery photo');
        fig.setAttribute('tabindex', '0');
        fig.setAttribute('role', 'button');
        // No src: the figure is a CSS background placeholder block (matches original static markup)
        li.appendChild(fig);
        fragment.appendChild(li);
    });

    galleryGrid.innerHTML = '';
    galleryGrid.removeAttribute('aria-hidden');
    galleryGrid.appendChild(fragment);

    // Ensure empty-state remains hidden
    if (galleryEmpty) {
        galleryEmpty.style.display = 'none';
        galleryEmpty.setAttribute('aria-hidden', 'true');
    }
}

// ==========================================
// Dynamic Restaurant Menu Rendering
// ==========================================

/**
 * Renders menu categories and items into the menu-container.
 * Preserves the exact semantic hierarchy and CSS classes from Phase 01.
 * Shows empty-state fallback if menu is empty.
 */
function renderRestaurantMenu(restaurant) {
    const menuContainer = document.querySelector('[data-detail="menu-container"]');
    const menuEmpty = document.querySelector('[data-detail="menu-empty"]');

    if (!menuContainer) return;

    const categories = getRestaurantMenu(restaurant);

    if (categories.length === 0) {
        menuContainer.innerHTML = '';
        menuContainer.setAttribute('aria-hidden', 'true');
        if (menuEmpty) {
            menuEmpty.style.display = 'block';
            menuEmpty.removeAttribute('aria-hidden');
        }
        return;
    }

    const fragment = document.createDocumentFragment();

    categories.forEach(function(cat) {
        if (!cat || !cat.items || cat.items.length === 0) return;

        const section = document.createElement('div');
        section.className = 'menu-section';
        const sectionId = cat.id || ('menu-' + cat.category.toLowerCase().replace(/[^a-z0-9]+/g, '-'));
        section.setAttribute('aria-labelledby', sectionId);

        const h3 = document.createElement('h3');
        h3.id = sectionId;
        h3.className = 'menu-section-title';
        h3.textContent = cat.category;
        section.appendChild(h3);

        cat.items.forEach(function(item) {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'menu-item';

            const infoDiv = document.createElement('div');
            infoDiv.className = 'menu-item-info';

            const h4 = document.createElement('h4');
            h4.textContent = item.name;
            infoDiv.appendChild(h4);

            if (item.description) {
                const p = document.createElement('p');
                p.className = 'text-small text-muted';
                p.style.marginTop = 'var(--space-1)';
                p.textContent = item.description;
                infoDiv.appendChild(p);
            }

            itemDiv.appendChild(infoDiv);

            if (item.price) {
                const priceDiv = document.createElement('div');
                priceDiv.className = 'menu-item-price';
                priceDiv.textContent = item.price;
                itemDiv.appendChild(priceDiv);
            }

            section.appendChild(itemDiv);
        });

        fragment.appendChild(section);
    });

    if (fragment.children.length === 0) {
        menuContainer.innerHTML = '';
        menuContainer.setAttribute('aria-hidden', 'true');
        if (menuEmpty) {
            menuEmpty.style.display = 'block';
            menuEmpty.removeAttribute('aria-hidden');
        }
        return;
    }

    menuContainer.innerHTML = '';
    menuContainer.removeAttribute('aria-hidden');
    menuContainer.appendChild(fragment);

    if (menuEmpty) {
        menuEmpty.style.display = 'none';
        menuEmpty.setAttribute('aria-hidden', 'true');
    }
}

// ==========================================
// Dynamic Restaurant Location & Hours Rendering
// ==========================================

/**
 * Renders the restaurant location and address.
 * Updates map placeholder aria-label to prevent data leakage.
 * Shows locked fallback "Location unavailable" if address is missing.
 */
function renderRestaurantLocation(restaurant) {
    const locationMap = document.querySelector('[data-detail="location-map"]');
    const addressText = document.querySelector('[data-detail="address-text"]');
    const locationAddress = document.querySelector('[data-detail="location-address"]');
    const locationEmpty = document.querySelector('[data-detail="location-empty"]');

    if (!addressText && !locationAddress && !locationEmpty) return;

    const location = getRestaurantLocation(restaurant);

    if (location) {
        if (locationMap) {
            locationMap.style.display = '';
            locationMap.removeAttribute('aria-hidden');
            locationMap.setAttribute('aria-label', 'Map showing location of ' + (restaurant && restaurant.name ? restaurant.name : 'restaurant'));
        }
        if (addressText) {
            addressText.textContent = location;
        } else if (locationAddress) {
            locationAddress.innerHTML = '<p class="text-lead">' + location + '</p>';
        }
        if (locationAddress) {
            locationAddress.style.display = '';
            locationAddress.removeAttribute('aria-hidden');
        }
        if (locationEmpty) {
            locationEmpty.style.display = 'none';
            locationEmpty.setAttribute('aria-hidden', 'true');
        }
    } else {
        if (locationMap) {
            locationMap.style.display = 'none';
            locationMap.setAttribute('aria-hidden', 'true');
        }
        if (locationAddress) {
            locationAddress.style.display = 'none';
            locationAddress.setAttribute('aria-hidden', 'true');
        }
        if (addressText) {
            addressText.textContent = 'Location unavailable.';
        }
        if (locationEmpty) {
            locationEmpty.style.display = 'block';
            locationEmpty.removeAttribute('aria-hidden');
        }
    }
}

/**
 * Renders the restaurant opening hours.
 * Uses verified canonical day/time values directly without timezone conversion.
 * Shows "Hours not available." fallback if hours are missing.
 */
function renderRestaurantHours(restaurant) {
    const hoursList = document.querySelector('[data-detail="hours-list"]');
    const hoursEmpty = document.querySelector('[data-detail="hours-empty"]');
    const hoursHeading = document.getElementById('hours-heading');

    if (!hoursList) return;

    const hours = getRestaurantHours(restaurant);

    // Remove any previous status badge
    if (hoursHeading) {
        const existingStatus = hoursHeading.querySelector('.hours-status-badge');
        if (existingStatus) existingStatus.remove();
    }

    if (!hours) {
        hoursList.innerHTML = '';
        hoursList.style.display = 'none';
        hoursList.setAttribute('aria-hidden', 'true');
        if (hoursEmpty) {
            hoursEmpty.style.display = 'block';
            hoursEmpty.removeAttribute('aria-hidden');
        }
        return;
    }

    const fragment = document.createDocumentFragment();
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const todayName = dayNames[new Date().getDay()];

    let todayHoursStr = null;

    days.forEach(function(day) {
        if (!hours[day]) return;
        const time = hours[day];
        const isToday = day === todayName;
        if (isToday) {
            todayHoursStr = time;
        }

        const row = document.createElement('div');
        row.className = 'hours-row' + (isToday ? ' hours-today' : '');

        const dt = document.createElement('dt');
        dt.textContent = day + (isToday ? ' (Today)' : '');

        const dd = document.createElement('dd');
        dd.textContent = time;

        row.appendChild(dt);
        row.appendChild(dd);
        fragment.appendChild(row);
    });

    hoursList.innerHTML = '';
    hoursList.style.display = '';
    hoursList.removeAttribute('aria-hidden');
    hoursList.appendChild(fragment);

    if (hoursEmpty) {
        hoursEmpty.style.display = 'none';
        hoursEmpty.setAttribute('aria-hidden', 'true');
    }

    // Determine Today's open/closing/closed status if time format is verifiable
    if (hoursHeading && todayHoursStr) {
        const timeMatch = todayHoursStr.match(/(\d{1,2}):(\d{2})\s*[–-]\s*(\d{1,2}):(\d{2})/);
        if (timeMatch) {
            const now = new Date();
            const currentMins = now.getHours() * 60 + now.getMinutes();
            const openMins = parseInt(timeMatch[1], 10) * 60 + parseInt(timeMatch[2], 10);
            const closeMins = parseInt(timeMatch[3], 10) * 60 + parseInt(timeMatch[4], 10);

            let statusText = '';
            let badgeClass = 'badge badge-neutral';

            if (currentMins >= openMins && currentMins < closeMins) {
                if (closeMins - currentMins <= 30) {
                    statusText = 'Closing soon';
                    badgeClass = 'badge badge-primary';
                } else {
                    statusText = 'Open now';
                    badgeClass = 'badge badge-success';
                }
            } else {
                statusText = 'Closed';
                badgeClass = 'badge badge-neutral';
            }

            const statusBadge = document.createElement('span');
            statusBadge.className = 'hours-status-badge ' + badgeClass;
            statusBadge.style.marginLeft = 'var(--space-2)';
            statusBadge.style.fontSize = 'var(--font-size-xs)';
            statusBadge.style.verticalAlign = 'middle';
            statusBadge.textContent = statusText;
            hoursHeading.appendChild(statusBadge);
        }
    }
}

// ==========================================
// Dynamic Restaurant Reservation CTA Rendering
// ==========================================

/**
 * Renders the reservation call-to-action buttons/sections based on canonical capability.
 * Enables/links Reserve buttons if reservation_enabled === true.
 * Hides Reserve buttons and provides clear fallback text if unsupported.
 */
function renderRestaurantReservationCTA(restaurant) {
    const heroReserveBtn = document.querySelector('[data-detail="reserve-btn"]');
    const ctaReserveBtn = document.querySelector('[data-detail="cta-reserve-btn"]');
    const ctaText = document.querySelector('[data-detail="reservation-cta-text"]');

    const canReserve = hasReservationCapability(restaurant);

    const targetUrl = restaurant && restaurant.id ? 'reservation.html?id=' + encodeURIComponent(restaurant.id) : 'reservation.html';

    if (heroReserveBtn) {
        if (canReserve) {
            heroReserveBtn.style.display = '';
            heroReserveBtn.removeAttribute('aria-hidden');
            heroReserveBtn.setAttribute('href', targetUrl);
        } else {
            heroReserveBtn.style.display = 'none';
            heroReserveBtn.setAttribute('aria-hidden', 'true');
            heroReserveBtn.removeAttribute('href');
        }
    }

    if (ctaReserveBtn) {
        if (canReserve) {
            ctaReserveBtn.style.display = '';
            ctaReserveBtn.removeAttribute('aria-hidden');
            ctaReserveBtn.setAttribute('href', targetUrl);
        } else {
            ctaReserveBtn.style.display = 'none';
            ctaReserveBtn.setAttribute('aria-hidden', 'true');
            ctaReserveBtn.removeAttribute('href');
        }
    }

    if (ctaText) {
        if (canReserve) {
            ctaText.textContent = 'Reserve your table before you arrive.';
        } else {
            ctaText.textContent = "Reservations aren't available for this restaurant.";
        }
    }
}

// ==========================================
// Restaurant Gallery
// ==========================================

function initRestaurantGallery() {
    const dialog = $('#gallery-lightbox');
    const galleryGrid = $('.gallery-grid');
    const imageContainer = $('#lightbox-image-container');
    
    if (!dialog || !galleryGrid || !imageContainer) return;
    
    let lastFocusedElement = null;

    function openLightbox(trigger) {
        lastFocusedElement = document.activeElement;
        
        imageContainer.innerHTML = '';
        const clone = trigger.cloneNode(true);
        clone.removeAttribute('tabindex');
        clone.removeAttribute('role');
        imageContainer.appendChild(clone);
        if (typeof dialog.showModal === 'function') {
            dialog.showModal();
        } else {
            dialog.setAttribute('open', '');
        }
    }

    if (!galleryGrid.dataset.galleryBound) {
        galleryGrid.dataset.galleryBound = 'true';

        galleryGrid.addEventListener('click', (e) => {
            const trigger = e.target.closest('.gallery-image-wrapper');
            if (trigger) openLightbox(trigger);
        });

        galleryGrid.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                const trigger = e.target.closest('.gallery-image-wrapper');
                if (trigger) {
                    e.preventDefault();
                    openLightbox(trigger);
                }
            }
        });
    }

    if (!dialog.dataset.lightboxBound) {
        dialog.dataset.lightboxBound = 'true';
        const closeBtn = $('.lightbox-close', dialog);
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                if (typeof dialog.close === 'function') {
                    dialog.close();
                } else {
                    dialog.removeAttribute('open');
                    if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
                        lastFocusedElement.focus();
                    }
                }
            });
        }

        dialog.addEventListener('click', (e) => {
            if (e.target === dialog) {
                if (typeof dialog.close === 'function') {
                    dialog.close();
                } else {
                    dialog.removeAttribute('open');
                    if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
                        lastFocusedElement.focus();
                    }
                }
            }
        });

        dialog.addEventListener('close', () => {
            if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
                lastFocusedElement.focus();
            }
        });
    }
}

// ==========================================
// Reservation State & Flow Foundation
// ==========================================

/**
 * Initializes reservation form UI state and synchronization for pages/reservation.html.
 * Maintains a local, in-memory state object for the current page interaction.
 * Synchronizes inputs with the visual summary card and progressive stepper.
 * Does not implement persistence, server communication, or booking generation.
 */
function initReservation() {
    const reservationFlow = $('.reservation-flow');
    if (!reservationFlow) return;

    const form = $('.reservation-form');
    if (!form) return;
    if (form.dataset.resBound) return;
    form.dataset.resBound = 'true';

    // Resolve restaurant from URL parameter
    const params = new URLSearchParams(window.location.search);
    const paramId = params.get('id') || params.get('restaurant');
    const restaurant = paramId ? getRestaurantById(paramId) : null;

    // Handle invalid or missing restaurant ID safely
    if (!restaurant) {
        document.title = 'Restaurant Not Found – BiteMap';
        const pageHeader = $('.page-header');
        if (pageHeader) pageHeader.style.display = 'none';
        if (reservationFlow) reservationFlow.style.display = 'none';

        const main = document.getElementById('main-content');
        if (main) {
            const existingNotice = main.querySelector('.reservation-not-found');
            if (existingNotice) existingNotice.remove();

            const notFound = document.createElement('section');
            notFound.className = 'page-header reservation-not-found';
            notFound.style.cssText = 'padding-block: var(--section-space-xl); text-align: center;';
            notFound.innerHTML = `
              <div class="container">
                <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; gap: var(--space-4); max-width: 520px; margin-inline: auto;">
                  <h2 class="empty-state-title">Restaurant not found</h2>
                  <p class="empty-state-desc text-muted">Please select a valid restaurant to make a reservation.</p>
                  <a href="explore.html" class="btn btn-primary" style="margin-top: var(--space-2);">Back to Explore</a>
                </div>
              </div>
            `;
            if (typeof main.prepend === 'function') {
                main.prepend(notFound);
            } else if (main.firstChild) {
                main.insertBefore(notFound, main.firstChild);
            } else {
                main.appendChild(notFound);
            }
        }
        return;
    }

    // Local, in-memory reservation UI state
    const reservationState = {
        restaurantId: restaurant.id,
        date: '',
        time: '',
        guests: '',
        name: '',
        phone: '',
        notes: ''
    };

    // Form controls
    const inputDate = $('#res-date');
    const inputTime = $('#res-time');
    const inputGuests = $('#res-guests');
    const inputName = $('#res-name');
    const inputPhone = $('#res-phone');
    const inputNotes = $('#res-notes');

    // Prevent selection of past dates
    if (inputDate) {
        const todayStr = new Date().toISOString().split('T')[0];
        inputDate.min = todayStr;
    }

    // Summary panel elements
    const summaryImg = $('[data-detail="summary-image"]') || $('.summary-restaurant-image');
    const summaryName = $('[data-detail="summary-name"]') || $('.reservation-summary h2');
    const summaryCategory = $('[data-detail="summary-category"]') || $('.reservation-summary p.text-muted');
    const dts = $$('.summary-details dt');
    const summaryRestaurant = $('[data-detail="summary-restaurant"]') || dts.find(dt => dt.textContent.trim() === 'Restaurant')?.nextElementSibling;
    const summaryDate = $('[data-detail="summary-date"]') || dts.find(dt => dt.textContent.trim() === 'Date')?.nextElementSibling;
    const summaryTime = $('[data-detail="summary-time"]') || dts.find(dt => dt.textContent.trim() === 'Time')?.nextElementSibling;
    const summaryGuests = $('[data-detail="summary-guests"]') || dts.find(dt => dt.textContent.trim() === 'Guests')?.nextElementSibling;
    const summaryNameLabel = $('[data-detail="summary-name-label"]');
    const summaryGuestName = $('[data-detail="summary-guest-name"]');
    const summaryContactLabel = $('[data-detail="summary-contact-label"]');
    const summaryGuestContact = $('[data-detail="summary-guest-contact"]');

    // Visual stepper
    const stepItems = $$('.step-item');

    // Populate initial restaurant context into summary
    if (summaryName) summaryName.textContent = restaurant.name;
    if (summaryRestaurant) summaryRestaurant.textContent = restaurant.name;
    if (summaryImg) summaryImg.setAttribute('aria-label', restaurant.name + ' exterior');

    if (summaryCategory) {
        const parts = [restaurant.category];
        if (restaurant.cuisine) parts.push(restaurant.cuisine);
        let metaHtml = parts.join(' · ');
        if (restaurant.rating != null) {
            metaHtml += ' · <span class="rating-icon" aria-hidden="true">&#9733;</span> ' + restaurant.rating.toFixed(1);
        }
        if (restaurant.distance != null) {
            metaHtml += ' • ' + restaurant.distance.toFixed(1) + ' km';
        }
        summaryCategory.innerHTML = metaHtml;
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';
        const parts = dateStr.split('-');
        if (parts.length === 3) return `${parts[2]}/${parts[1]}/${parts[0]}`;
        return dateStr;
    }

    function syncStateFromInputs() {
        if (inputDate) reservationState.date = inputDate.value;
        if (inputTime) reservationState.time = inputTime.value;
        if (inputGuests) reservationState.guests = inputGuests.value;
        if (inputName) reservationState.name = inputName.value;
        if (inputPhone) reservationState.phone = inputPhone.value;
        if (inputNotes) reservationState.notes = inputNotes.value;
    }

    function updateSummary() {
        if (summaryDate) {
            summaryDate.textContent = reservationState.date ? formatDate(reservationState.date) : 'Select a date';
        }
        if (summaryTime) {
            summaryTime.textContent = reservationState.time || 'Select a time';
        }
        if (summaryGuests) {
            if (reservationState.guests) {
                summaryGuests.textContent = reservationState.guests === '1' ? '1 Guest' : `${reservationState.guests} Guests`;
            } else {
                summaryGuests.textContent = 'Select guests';
            }
        }
        if (summaryGuestName && summaryNameLabel) {
            if (reservationState.name && reservationState.name.trim()) {
                summaryNameLabel.style.display = '';
                summaryGuestName.style.display = '';
                summaryGuestName.textContent = reservationState.name.trim();
            } else {
                summaryNameLabel.style.display = 'none';
                summaryGuestName.style.display = 'none';
            }
        }
        if (summaryGuestContact && summaryContactLabel) {
            if (reservationState.phone && reservationState.phone.trim()) {
                summaryContactLabel.style.display = '';
                summaryGuestContact.style.display = '';
                summaryGuestContact.textContent = reservationState.phone.trim();
            } else {
                summaryContactLabel.style.display = 'none';
                summaryGuestContact.style.display = 'none';
            }
        }
        updateStepper();
    }

    function updateStepper() {
        if (stepItems.length < 4) return;

        const hasDate = !!(reservationState.date && reservationState.date.trim());
        const hasTime = !!(reservationState.time && reservationState.time.trim());
        const hasGuests = !!(reservationState.guests && reservationState.guests.trim());
        const hasName = !!(reservationState.name && reservationState.name.trim());

        stepItems.forEach(step => {
            step.classList.remove('active');
            step.removeAttribute('aria-current');
        });

        // Step 1: Date is always active
        stepItems[0].classList.add('active');

        if (hasDate && hasTime && hasGuests && hasName) {
            stepItems[1].classList.add('active');
            stepItems[2].classList.add('active');
            stepItems[3].classList.add('active');
            stepItems[3].setAttribute('aria-current', 'step');
        } else if (hasDate && hasTime && hasGuests) {
            stepItems[1].classList.add('active');
            stepItems[2].classList.add('active');
            stepItems[2].setAttribute('aria-current', 'step');
        } else if (hasDate && hasTime) {
            stepItems[1].classList.add('active');
            stepItems[2].classList.add('active');
            stepItems[2].setAttribute('aria-current', 'step');
        } else if (hasDate) {
            stepItems[1].classList.add('active');
            stepItems[1].setAttribute('aria-current', 'step');
        } else {
            stepItems[0].setAttribute('aria-current', 'step');
        }
    }

    function showError(input, message) {
        input.classList.add('is-error');
        input.setAttribute('aria-invalid', 'true');
        const errorId = input.id ? `${input.id}-error` : null;
        let errorEl = input.nextElementSibling;
        if (!errorEl || !errorEl.classList.contains('form-error-msg')) {
            errorEl = document.createElement('p');
            errorEl.className = 'text-small form-error-msg';
            if (errorId) errorEl.id = errorId;
            errorEl.setAttribute('role', 'alert');
            errorEl.style.color = 'var(--color-primary)';
            errorEl.style.marginTop = 'var(--space-1)';
            input.parentNode.insertBefore(errorEl, input.nextSibling);
        }
        if (errorId) {
            input.setAttribute('aria-describedby', errorId);
        }
        errorEl.textContent = message;
    }

    function clearError(input) {
        input.classList.remove('is-error');
        input.removeAttribute('aria-invalid');
        input.removeAttribute('aria-describedby');
        const errorEl = input.nextElementSibling;
        if (errorEl && errorEl.classList.contains('form-error-msg')) {
            errorEl.remove();
        }
    }

    function validateField(input) {
        if (!input.hasAttribute('required')) return true;

        const val = input.value.trim();

        if (input.id === 'res-date') {
            if (!val) {
                showError(input, 'Please select a date.');
                return false;
            }
            const todayStr = new Date().toISOString().split('T')[0];
            if (val < todayStr) {
                showError(input, 'Please select today or a future date.');
                return false;
            }
        } else if (input.id === 'res-time') {
            if (!val) {
                showError(input, 'Please select a time.');
                return false;
            }
        } else if (input.id === 'res-guests') {
            if (!val) {
                showError(input, 'Please select the number of guests.');
                return false;
            }
        } else if (input.id === 'res-name') {
            if (!val) {
                showError(input, 'Please enter your full name.');
                return false;
            }
        } else {
            if (!val) {
                showError(input, 'This field is required.');
                return false;
            }
        }

        clearError(input);
        return true;
    }

    // Attach real-time synchronization to all form inputs
    const trackInputs = [inputDate, inputTime, inputGuests, inputName, inputPhone, inputNotes];
    trackInputs.forEach(input => {
        if (!input) return;
        const handleSync = () => {
            syncStateFromInputs();
            updateSummary();
            if (input.classList.contains('is-error')) {
                validateField(input);
            }
        };
        input.addEventListener('input', handleSync);
        input.addEventListener('change', handleSync);
        if (input.hasAttribute('required')) {
            input.addEventListener('blur', () => {
                validateField(input);
            });
        }
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        syncStateFromInputs();

        const requiredInputs = [inputDate, inputTime, inputGuests, inputName].filter(Boolean);
        let firstInvalid = null;
        requiredInputs.forEach(input => {
            const isValid = validateField(input);
            if (!isValid && !firstInvalid) {
                firstInvalid = input;
            }
        });

        if (firstInvalid) {
            firstInvalid.focus();
            return;
        }

        // Update summary one final time with validated state
        updateSummary();

        // Build navigation query preserving reservation context safely without storage
        const queryParts = [
            'id=' + encodeURIComponent(reservationState.restaurantId)
        ];
        if (reservationState.date) queryParts.push('date=' + encodeURIComponent(reservationState.date));
        if (reservationState.time) queryParts.push('time=' + encodeURIComponent(reservationState.time));
        if (reservationState.guests) queryParts.push('guests=' + encodeURIComponent(reservationState.guests));
        if (reservationState.name) queryParts.push('name=' + encodeURIComponent(reservationState.name));
        if (reservationState.phone) queryParts.push('phone=' + encodeURIComponent(reservationState.phone));

        // Frontend simulation: navigate to ticket page safely without backend submission or persistence
        window.location.href = 'reservation-ticket.html?' + queryParts.join('&');
    });

    // Initialize state & UI
    syncStateFromInputs();
    updateSummary();
}

// ==========================================
// Reservation Ticket
// ==========================================

function initReservationTicket() {
    const printBtn = $('.btn-print-ticket');
    const viewRestaurantBtn = document.querySelector('[data-detail="ticket-view-restaurant"]') || $('.ticket-actions a.btn-primary');
    const ticketName = document.querySelector('[data-detail="ticket-restaurant-name"]') || $('.ticket-restaurant h2');
    const ticketCategory = document.querySelector('[data-detail="ticket-restaurant-category"]') || $('.ticket-restaurant p');
    const ticketDate = document.querySelector('[data-detail="ticket-date"]');
    const ticketTime = document.querySelector('[data-detail="ticket-time"]');
    const ticketGuests = document.querySelector('[data-detail="ticket-guests"]');
    const ticketGuestItem = document.querySelector('[data-detail="ticket-guest-item"]');
    const ticketGuestName = document.querySelector('[data-detail="ticket-guest-name"]');

    if (!ticketName && !printBtn) return;

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const restaurant = id ? getRestaurantById(id) : getRestaurantById('ramenku');

    if (restaurant) {
        if (ticketName) ticketName.textContent = restaurant.name;
        if (ticketCategory) {
            const parts = [restaurant.category];
            if (restaurant.cuisine) parts.push(restaurant.cuisine);
            ticketCategory.textContent = parts.join(' · ');
        }
        if (viewRestaurantBtn) {
            viewRestaurantBtn.setAttribute('href', 'restaurant.html?id=' + encodeURIComponent(restaurant.id));
        }
    }

    if (ticketDate && params.get('date')) {
        const rawDate = params.get('date');
        const parts = rawDate.split('-');
        if (parts.length === 3) {
            ticketDate.textContent = `${parts[2]}/${parts[1]}/${parts[0]}`;
        } else {
            ticketDate.textContent = rawDate;
        }
    }

    if (ticketTime && params.get('time')) {
        ticketTime.textContent = params.get('time');
    }

    if (ticketGuests && params.get('guests')) {
        const g = params.get('guests');
        ticketGuests.textContent = g === '1' ? '1 Guest' : `${g} Guests`;
    }

    if (ticketGuestName && params.get('name')) {
        ticketGuestName.textContent = params.get('name');
        if (ticketGuestItem) ticketGuestItem.style.display = '';
    }

    if (printBtn) {
        if (!printBtn.getAttribute('aria-label')) {
            printBtn.setAttribute('aria-label', 'Print reservation ticket');
        }
        if (!printBtn.dataset.ticketBound) {
            printBtn.dataset.ticketBound = 'true';
            printBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.print();
            });
        }
    }
}

// ==========================================
// Restaurant Detail
// ==========================================

function initRestaurantDetail() {
    // Guard: only run on restaurant.html pages (identified by data-detail hook)
    const nameEl = document.querySelector('[data-detail="name"]');
    if (!nameEl) return;

    const main = document.getElementById('main-content');
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const restaurant = id ? getRestaurantById(id) : null;

    // Clean up any previous not-found notice
    if (main) {
        const existingNotice = main.querySelector('.restaurant-not-found');
        if (existingNotice) existingNotice.remove();
    }

    // -- Not-found / invalid / missing ID state -----------------------------
    if (!restaurant) {
        if (!main) return;

        document.title = 'Restaurant Not Found – BiteMap';

        // Hide regular sections so no stale content appears
        main.querySelectorAll('section, .location-hours-wrapper').forEach(function(el) {
            el.style.display = 'none';
        });

        // Insert polished BiteMap not-found container
        const notFound = document.createElement('section');
        notFound.className = 'page-header restaurant-not-found';
        notFound.style.cssText = 'padding-block: var(--section-space-xl); text-align: center;';
        notFound.innerHTML = `
          <div class="container">
            <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; gap: var(--space-4); max-width: 520px; margin-inline: auto;">
              <h2 class="empty-state-title">Restaurant not found</h2>
              <p class="empty-state-desc text-muted">The restaurant you're looking for doesn't exist or the link may be incorrect.</p>
              <a href="explore.html" class="btn btn-primary" style="margin-top: var(--space-2);">Back to Explore</a>
            </div>
          </div>
        `;
        if (typeof main.prepend === 'function') {
            main.prepend(notFound);
        } else if (main.firstChild) {
            main.insertBefore(notFound, main.firstChild);
        } else {
            main.appendChild(notFound);
        }
        return;
    }

    // Restore regular sections in case they were previously hidden
    if (main) {
        main.querySelectorAll('section, .location-hours-wrapper').forEach(function(el) {
            el.style.display = '';
        });
    }

    // -- Bind identity fields from canonical dataset -----------------------
    document.title = restaurant.name + ' – BiteMap';
    nameEl.textContent = restaurant.name;

    const categoryEl = document.querySelector('[data-detail="category"]');
    if (categoryEl) {
        const parts = [restaurant.category];
        if (restaurant.cuisine) parts.push(restaurant.cuisine);
        categoryEl.textContent = parts.join(' · ');
    }

    const metaEl = document.querySelector('[data-detail="meta"]');
    if (metaEl) {
        const metaParts = [];
        if (typeof restaurant.rating === 'number') {
            metaParts.push('<span class="rating-icon" aria-hidden="true">&#9733;</span> ' + restaurant.rating.toFixed(1));
        } else {
            metaParts.push('<span>New &middot; No reviews yet</span>');
        }
        if (typeof restaurant.distance === 'number') {
            metaParts.push(restaurant.distance.toFixed(1) + ' km');
        }
        metaEl.innerHTML = metaParts.join(' &bull; ');
    }

    const heroImg = document.querySelector('[data-detail="hero-image"]');
    if (heroImg) {
        heroImg.setAttribute('aria-label', restaurant.name + ' exterior view');
    }

    const descEl = document.querySelector('[data-detail="description"]');
    const descLongEl = document.querySelector('[data-detail="description-long"]');
    const aboutContent = document.querySelector('[data-detail="about-content"]') || (descEl ? descEl.parentElement : null);
    const aboutEmpty = document.querySelector('[data-detail="about-empty"]');

    if (restaurant.description && restaurant.description.trim().length > 0) {
        if (descEl) {
            descEl.textContent = restaurant.description;
            descEl.style.display = '';
        }
        if (descLongEl) descLongEl.style.display = 'none';
        if (aboutContent) aboutContent.style.display = '';
        if (aboutEmpty) {
            aboutEmpty.style.display = 'none';
            aboutEmpty.setAttribute('aria-hidden', 'true');
        }
    } else {
        if (descEl) {
            descEl.textContent = 'Description unavailable.';
            descEl.style.display = 'none';
        }
        if (descLongEl) descLongEl.style.display = 'none';
        if (aboutContent) aboutContent.style.display = 'none';
        if (aboutEmpty) {
            aboutEmpty.style.display = 'block';
            aboutEmpty.removeAttribute('aria-hidden');
        }
    }

    const saveBtn = document.querySelector('[data-detail="save-btn"]');
    if (saveBtn) {
        saveBtn.dataset.restaurantId = restaurant.id;
        syncFavoriteButton(saveBtn, restaurant);
    }

    // Render modular components
    renderRestaurantGallery(restaurant);
    initRestaurantGallery();
    renderRestaurantMenu(restaurant);
    renderRestaurantLocation(restaurant);
    renderRestaurantHours(restaurant);
    renderRestaurantReservationCTA(restaurant);
}

// ==========================================
// Dashboard State & Empty-State Controllers
// ==========================================

/**
 * Updates upcoming reservation visibility based on current DOM presence.
 * Shows card and hides empty state when demo booking is present.
 */
function updateUpcomingReservationState() {
    const card = document.querySelector('[data-detail="upcoming-card"]');
    const emptyState = document.querySelector('[data-detail="upcoming-empty"]');

    if (!card && !emptyState) return;

    const hasUpcoming = !!(card && card.children.length > 0 && card.style.display !== 'none');

    if (hasUpcoming) {
        if (card) {
            card.style.display = '';
            card.removeAttribute('aria-hidden');
        }
        if (emptyState) {
            emptyState.style.display = 'none';
            emptyState.setAttribute('aria-hidden', 'true');
        }
    } else {
        if (card) {
            card.style.display = 'none';
            card.setAttribute('aria-hidden', 'true');
        }
        if (emptyState) {
            emptyState.style.display = 'block';
            emptyState.removeAttribute('aria-hidden');
        }
    }
}

/**
 * Updates reservation history visibility based on current DOM list items.
 * Shows history list and hides empty state when history items exist.
 */
function updateReservationHistoryState() {
    const list = document.querySelector('[data-detail="history-list"]');
    const emptyState = document.querySelector('[data-detail="history-empty"]');

    if (!list && !emptyState) return;

    const items = list ? list.querySelectorAll('.history-item') : [];
    const hasHistory = items.length > 0 && list.style.display !== 'none';

    if (hasHistory) {
        if (list) {
            list.style.display = '';
            list.removeAttribute('aria-hidden');
        }
        if (emptyState) {
            emptyState.style.display = 'none';
            emptyState.setAttribute('aria-hidden', 'true');
        }
    } else {
        if (list) {
            list.style.display = 'none';
            list.setAttribute('aria-hidden', 'true');
        }
        if (emptyState) {
            emptyState.style.display = 'block';
            emptyState.removeAttribute('aria-hidden');
        }
    }
}

/**
 * Updates favorites grid visibility based on rendered card elements.
 * Shows grid and hides empty state when favorite cards exist.
 */
function updateFavoritesState() {
    const grid = document.querySelector('[data-detail="dashboard-favorites-grid"]');
    const emptyState = document.querySelector('[data-detail="dashboard-favorites-empty"]');

    if (!grid && !emptyState) return;

    const cards = grid ? grid.querySelectorAll('.restaurant-card') : [];
    const count = cards.length;
    const hasFavorites = count > 0 && grid.style.display !== 'none';

    const countEl = document.querySelector('[data-detail="favorites-count"]');
    if (countEl) {
        countEl.textContent = count === 1 ? '1 Saved Restaurant' : `${count} Saved Restaurants`;
    }

    if (hasFavorites) {
        if (grid) {
            grid.style.display = '';
            grid.removeAttribute('aria-hidden');
        }
        if (emptyState) {
            emptyState.style.display = 'none';
            emptyState.setAttribute('aria-hidden', 'true');
        }
    } else {
        if (grid) {
            grid.style.display = 'none';
            grid.setAttribute('aria-hidden', 'true');
        }
        if (emptyState) {
            emptyState.style.display = 'block';
            emptyState.removeAttribute('aria-hidden');
        }
    }
}

// ==========================================
// Dashboard Data Rendering Foundation
// ==========================================

/**
 * Initializes dashboard data rendering for dashboard.html.
 * Renders demo favorites from canonical BITEMAP_RESTAURANTS.
 * Aligns upcoming reservation restaurant identity with canonical data.
 * Controls section and empty-state visibility safely from local DOM state.
 * Does not implement persistence, real user accounts, or backend booking.
 */
function initDashboard() {
    const dashboardHeader = $('.dashboard-header');
    if (!dashboardHeader) return;

    // 1. Render favorites grid from canonical data
    const favGrid = document.querySelector('[data-detail="dashboard-favorites-grid"]');
    if (favGrid) {
        const favoriteRestaurants = getFavoriteRestaurants();

        const fragment = document.createDocumentFragment();
        favoriteRestaurants.forEach(restaurant => {
            // Dashboard is in /pages/, so linkBase is 'restaurant.html'
            fragment.appendChild(createRestaurantCard(restaurant, 'restaurant.html', true));
        });
        favGrid.innerHTML = '';
        favGrid.appendChild(fragment);
    }

    // 2. Align upcoming reservation restaurant identity with canonical data
    const upcomingCard = document.querySelector('.upcoming-reservation-card');
    if (upcomingCard) {
        const id = upcomingCard.getAttribute('data-restaurant-id') || 'ramenku';
        const restaurant = getRestaurantById(id);
        if (restaurant) {
            upcomingCard.setAttribute('aria-label', 'Upcoming reservation at ' + restaurant.name);
            const upcomingName = upcomingCard.querySelector('[data-detail="upcoming-name"]');
            const upcomingCategory = upcomingCard.querySelector('[data-detail="upcoming-category"]');
            if (upcomingName) upcomingName.textContent = restaurant.name;
            if (upcomingCategory) {
                const parts = [restaurant.category];
                if (restaurant.cuisine) parts.push(restaurant.cuisine);
                upcomingCategory.textContent = parts.join(' · ');
            }
        }
    }

    // 3. Align reservation history restaurant identity with canonical data
    const historyItems = document.querySelectorAll('.history-item[data-restaurant-id]');
    historyItems.forEach(item => {
        const id = item.getAttribute('data-restaurant-id');
        const restaurant = getRestaurantById(id);
        if (restaurant) {
            const nameEl = item.querySelector('[data-detail="history-name"]');
            const categoryEl = item.querySelector('[data-detail="history-category"]');
            if (nameEl) nameEl.textContent = restaurant.name;
            if (categoryEl) {
                const parts = [restaurant.category];
                if (restaurant.cuisine) parts.push(restaurant.cuisine);
                categoryEl.textContent = parts.join(' · ');
            }
        }
    });

    // 4. Update section visibility & empty states based on actual DOM content
    updateUpcomingReservationState();
    updateReservationHistoryState();
    updateFavoritesState();
}

// ==========================================
// Shared Initialization
// ==========================================

function initBiteMap() {
    initHeroSearch();
    // Render dynamic cards on explore page only
    const exploreSearch = $('#explore-search');
    const exploreGrid = $('.restaurant-grid');
    if (exploreSearch && exploreGrid) {
        renderRestaurantCards(getRestaurants(), exploreGrid);
    }
    renderHomepageRails();
    initNearbyDiscovery();
    initRestaurantDetail();
    initDashboard();
    initMobileNavigation();
    initExploreFilters();
    initFavorites();
    initRestaurantGallery();
    initReservation();
    initReservationTicket();
}

initBiteMap();