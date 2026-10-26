<?php
/**
 * BiteMap - Canonical Restaurant Dataset (Sprint 05 OOP Architecture)
 * Single source of truth for restaurant data on the server side.
 * Returns an array of Restaurant domain model instances.
 */

declare(strict_types=1);

require_once __DIR__ . '/../classes/MenuItem.php';
require_once __DIR__ . '/../classes/Restaurant.php';

$rawRestaurants = [
    [
        'id' => 'okiru-ramen',
        'name' => 'Okiru Ramen',
        'category' => 'Asian Food',
        'cuisine' => 'Japanese • Ramen Bar',
        'rating' => null,
        'distance' => null,
        'description' => 'Bar ramen bernuansa Jepang di Jl. Bandung No. 5 Malang yang menyajikan ramen kaldu Paitan, Shoyu, Tantan, aneka hidangan pembuka, sushi roll, dan hidangan penutup khas.',
        'location' => 'Jl. Bandung No. 5, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65113',
        'latitude' => -7.9617932,
        'longitude' => 112.623681,
        'phone' => '+62 822-2897-8497',
        'website' => 'https://linktr.ee/okiruspiritramenbar',
        'external_menu_url' => 'https://drive.google.com/file/d/1PHc2pjUS3tifwjjVVb4AVqYKjzqEuJOD/view?usp=drivesdk',
        'hero_image' => 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234732.png',
        'hours' => [
            'Monday' => '10:00 – 22:00',
            'Tuesday' => '10:00 – 22:00',
            'Wednesday' => '10:00 – 22:00',
            'Thursday' => '10:00 – 22:00',
            'Friday' => '10:00 – 22:00',
            'Saturday' => '10:00 – 22:00',
            'Sunday' => '10:00 – 22:00',
        ],
        'reservation_enabled' => false,
        'gallery' => [
            [
                'alt' => 'Interior ruang makan bernuansa kayu Jepang dengan lampion chochin di Okiru Ramen',
                'src' => 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234732.png',
            ],
            [
                'alt' => 'Detail seni lukisan dinding Jepang dan ornamen kayu di Okiru Ramen',
                'src' => 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234812.png',
            ],
            [
                'alt' => 'Salmon Truffle carpaccio disajikan dengan minyak truffle',
                'src' => 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234210.png',
            ],
            [
                'alt' => 'Aburi Salmon Roll dengan saus mentai dan tobiko',
                'src' => 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234222.png',
            ],
            [
                'alt' => 'Soft-Shell Crab Tempura renyah dengan saus cocolan',
                'src' => 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234301.png',
            ],
            [
                'alt' => 'Milk Pudding khas Jepang disajikan dengan es krim vanila dan buah segar',
                'src' => 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 233541.png',
            ],
        ],
        'menu' => [
            [
                'category' => 'Paitan Soup Ramen (Rich and Creamy)',
                'id' => 'menu-paitan',
                'items' => [
                    [
                        'name' => 'Wagyu Steak',
                        'description' => 'Daging premium yang dengan marmer lemak yang halus merata',
                        'price' => 'Rp 55.000',
                    ],
                    [
                        'name' => 'Wagyu Saikoro',
                        'description' => 'Daging yang dipotong bentuk cube / dadu dan dibumbui khas Okiru',
                        'price' => 'Rp 58.000',
                    ],
                    [
                        'name' => 'Chicken Chasu',
                        'description' => 'Ayam gulung rebus yang dimasak dengan bumbu khas Okiru',
                        'price' => 'Rp 48.000',
                    ],
                ],
            ],
            [
                'category' => 'Shoyu Soup Ramen (Light)',
                'id' => 'menu-shoyu',
                'items' => [
                    [
                        'name' => 'Nitamago',
                        'description' => 'Telur omega yang di marinasi belasan jam dengan bumbu khas Okiru',
                        'price' => 'Rp 35.000',
                    ],
                    [
                        'name' => 'Wagyu Saikoro',
                        'description' => 'Daging yang dipotong bentuk cube / dadu dan dibumbui khas Okiru',
                        'price' => 'Rp 58.000',
                    ],
                    [
                        'name' => 'Chicken Chasu',
                        'description' => 'Ayam gulung rebus yang dimasak dengan bumbu khas Okiru',
                        'price' => 'Rp 48.000',
                    ],
                ],
            ],
            [
                'category' => 'Tantan Ramen (Level Spicy 1-5)',
                'id' => 'menu-tantan',
                'items' => [
                    [
                        'name' => 'Wagyu Steak',
                        'description' => 'Daging premium yang dengan marmer lemak yang halus merata',
                        'price' => 'Rp 55.000',
                    ],
                    [
                        'name' => 'Wagyu Saikoro',
                        'description' => 'Daging yang dipotong bentuk cube / dadu dan dibumbui khas Okiru',
                        'price' => 'Rp 58.000',
                    ],
                    [
                        'name' => 'Chicken Chasu',
                        'description' => 'Ayam gulung rebus yang dimasak dengan bumbu khas Okiru',
                        'price' => 'Rp 48.000',
                    ],
                ],
            ],
            [
                'category' => 'Dry Ramen',
                'id' => 'menu-dry-ramen',
                'items' => [
                    [
                        'name' => 'Tantan Katsu',
                        'description' => 'Ramen kuah pedas gurih dengan topping dada ayam tepung',
                        'price' => 'Rp 55.000',
                    ],
                    [
                        'name' => 'Spicy Cheese',
                        'description' => 'Ramen kuah keju sedikit pedas dengan toping ayam',
                        'price' => 'Rp 55.000',
                    ],
                    [
                        'name' => 'Dry Minced Tofu',
                        'description' => 'Ramen kering dengan topping daging cincang dan tofu',
                        'price' => 'Rp 45.000',
                    ],
                ],
            ],
            [
                'category' => 'Donburi',
                'id' => 'menu-donburi',
                'items' => [
                    [
                        'name' => 'Salmon Belly Don',
                        'description' => 'Perut salmon dengan tobiko dan beras Jepang',
                        'price' => 'Rp 65.000',
                    ],
                    [
                        'name' => 'Wagyu Don',
                        'description' => 'Wagyu dengan telur omega 3 dan beras Jepang',
                        'price' => 'Rp 68.000',
                    ],
                    [
                        'name' => 'Saikoro Don',
                        'description' => 'Wagyu saikoro dengan telur omega 3 dan beras Jepang',
                        'price' => 'Rp 68.000',
                    ],
                ],
            ],
            [
                'category' => 'Special Menu',
                'id' => 'menu-special-menu',
                'items' => [
                    [
                        'name' => 'Beef Teppanyaki',
                        'description' => 'Daging sapi premium yang dimasak langsung di atas pelat besi panas oleh chef ahli, hidangan ini menawarkan rasa gurih dan juicy yang memikat.',
                        'price' => 'Rp 185.000',
                    ],
                    [
                        'name' => 'Salmon Head',
                        'description' => 'Kepala salmon yang di masak garlic butter dan irisan daging ham sapi + nasi putih',
                        'price' => 'Rp 68.000',
                    ],
                    [
                        'name' => 'Salmon Teppanyaki',
                        'description' => 'Fillet salmon segar yang dimasak langsung di atas pelat besi panas oleh chef ahli, hidangan ini menawarkan rasa gurih dan juicy yang memikat.',
                        'price' => 'Rp 160.000',
                    ],
                ],
            ],
            [
                'category' => 'Kids Meal',
                'id' => 'menu-kids-meal',
                'items' => [
                    [
                        'name' => 'Kids Meal A',
                        'description' => 'Nasi goreng salmon, nitamago, ebi tempura, acar',
                        'price' => 'Rp 60.000',
                    ],
                    [
                        'name' => 'Kids Meal B',
                        'description' => 'Nasi putih Jepang, beef teriyaki, ebi tempura, acar',
                        'price' => 'Rp 65.000',
                    ],
                ],
            ],
            [
                'category' => 'Special Fried Rice',
                'id' => 'menu-special-fried-rice',
                'items' => [
                    [
                        'name' => 'Salmon Fried Rice',
                        'description' => 'Nasi goreng salmon & telur',
                        'price' => 'Rp 65.000',
                    ],
                    [
                        'name' => 'Beef Fried Rice',
                        'description' => 'Nasi goreng daging & telur',
                        'price' => 'Rp 65.000',
                    ],
                    [
                        'name' => 'Chicken Fried Rice',
                        'description' => 'Nasi goreng ayam & telur',
                        'price' => 'Rp 65.000',
                    ],
                ],
            ],
            [
                'category' => 'Snack',
                'id' => 'menu-snacks',
                'items' => [
                    [
                        'name' => 'Salmon Truffle',
                        'description' => 'Potongan salmon yang disajikan dengan minyak truffle sebagai saus',
                        'price' => 'Rp 58.000',
                    ],
                    [
                        'name' => 'Nori Tempura',
                        'description' => 'Rumput laut goreng dilapisi tempura khas Okiru',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Ebi Tempura',
                        'description' => 'Udang yang dilapisi dengan adonan tempura digoreng renyah',
                        'price' => 'Rp 35.000',
                    ],
                    [
                        'name' => 'Ika Karage',
                        'description' => 'Potongan cumi-cumi yang digoreng dengan tepung hingga renyah di luar dan lembut di dalam',
                        'price' => 'Rp 30.000',
                    ],
                    [
                        'name' => 'Chicken Karage',
                        'description' => 'Potongan ayam yang digoreng tepung mempunyai rasa renyah di luar dan juicy di dalam',
                        'price' => 'Rp 30.000',
                    ],
                    [
                        'name' => 'Salmon Skin',
                        'description' => 'Kulit salmon di goreng tepung, mempunyai rasa renyah diluar juicy di dalam',
                        'price' => 'Rp 40.000',
                    ],
                    [
                        'name' => 'Gyoza',
                        'description' => 'Pangsit Jepang yang diisi dengan daging ayam dan daun kucai',
                        'price' => 'Rp 35.000',
                    ],
                ],
            ],
            [
                'category' => 'Shusi and Desert',
                'id' => 'menu-shusi-and-desert',
                'items' => [
                    [
                        'name' => 'Unagi Roll',
                        'description' => 'Nori, beras sushi, kanimayo kyuri dan unagi',
                        'price' => 'Rp 40.000',
                    ],
                    [
                        'name' => 'Aburi Salmon Roll',
                        'description' => 'Nori, beras sushi, kanimayo, salmon, saus mentai dan tobiko',
                        'price' => 'Rp 38.000',
                    ],
                    [
                        'name' => 'Spicy Tuna Roll',
                        'description' => 'Nori, beras sushi, kanimayo timun dan tuna tar tar',
                        'price' => 'Rp 30.000',
                    ],
                    [
                        'name' => 'Spicy Salmon Roll',
                        'description' => 'Nori, beras sushi, kanimayo kyuri, tobiko dan spicy salmon',
                        'price' => 'Rp 35.000',
                    ],
                    [
                        'name' => 'Chesse Cake Green Tea',
                        'price' => 'Rp 58.000',
                    ],
                    [
                        'name' => 'Chocolate Roulade',
                        'price' => 'Rp 45.000',
                    ],
                    [
                        'name' => 'Milk Puding',
                        'price' => 'Rp 40.000',
                    ],
                ],
            ],
            [
                'category' => 'Signature Okiru',
                'id' => 'menu-signature-okiru',
                'items' => [
                    [
                        'name' => 'Nami Flower',
                        'description' => 'Sakura syrup, jasmine tea, lime juice, passion fruit syrup.',
                        'price' => 'Rp 35.000',
                    ],
                    [
                        'name' => 'Yukari',
                        'description' => 'Fresh milk, strawberry syrup, lavender syrup, orange juice',
                        'price' => 'Rp 35.000',
                    ],
                    [
                        'name' => 'Izumi',
                        'description' => 'Orange juice, almond syrup, rosemerry, cotton candy',
                        'price' => 'Rp 35.000',
                    ],
                    [
                        'name' => 'Amai Ryokucha',
                        'description' => 'Matcha powder, freshmilk, earlgrey foam.',
                        'price' => 'Rp 35.000',
                    ],
                ],
            ],
            [
                'category' => 'Juice',
                'id' => 'menu-juice',
                'items' => [
                    [
                        'name' => 'Watermelon Juice',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Melon Juice',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Apple Juice',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Strawberry Juice',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Orange Juice',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Banana Juice',
                        'price' => 'Rp 25.000',
                    ],
                ],
            ],
            [
                'category' => 'Tea',
                'id' => 'menu-tea',
                'items' => [
                    [
                        'name' => 'Tea (C/H)',
                        'price' => 'Rp 20.000',
                    ],
                    [
                        'name' => 'Lychee Tea',
                        'price' => 'Rp 20.000',
                    ],
                    [
                        'name' => 'Lemon Tea',
                        'price' => 'Rp 20.000',
                    ],
                    [
                        'name' => 'Ocha (C/H)',
                        'price' => 'Rp 20.000',
                    ],
                ],
            ],
            [
                'category' => 'Coffee',
                'id' => 'menu-coffee',
                'items' => [
                    [
                        'name' => 'Americano (C/H)',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Coffee Latte',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Cappucino',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Vanila',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Hazelnut',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Caramel',
                        'price' => 'Rp 25.000',
                    ],
                    [
                        'name' => 'Affogato',
                        'price' => 'Rp 25.000',
                    ],
                ],
            ],
            [
                'category' => 'Soda & Mineral',
                'id' => 'menu-soda-mineral',
                'items' => [
                    [
                        'name' => 'Mineral',
                        'price' => 'Rp 15.000',
                    ],
                    [
                        'name' => 'Cola',
                        'price' => 'Rp 20.000',
                    ],
                    [
                        'name' => 'Sprite',
                        'price' => 'Rp 20.000',
                    ],
                    [
                        'name' => 'Sparkling Water',
                        'price' => 'Rp 25.000',
                    ],
                ],
            ],
            [
                'category' => 'Upgrade & Add-On',
                'id' => 'menu-upgrade-addon',
                'items' => [
                    [
                        'name' => 'Upgrade Wagyu MB5',
                        'price' => '+ Rp 40.000',
                    ],
                    [
                        'name' => 'Upgrade Wagyu MB5 (Beef Teppanyaki)',
                        'price' => '+ Rp 60.000',
                    ],
                    [
                        'name' => 'Nitamago (Telur Omega 3)',
                        'price' => '+ Rp 10.000',
                    ],
                    [
                        'name' => 'Shitake (Jamur Rebus)',
                        'price' => '+ Rp 10.000',
                    ],
                    [
                        'name' => 'Gohan (Nasi Putih dengan Beras Jepang)',
                        'price' => '+ Rp 10.000',
                    ],
                ],
            ],
            [
                'category' => 'Promo Menu',
                'id' => 'menu-promo',
                'items' => [
                    [
                        'name' => 'Unagi Butter Rice',
                        'description' => 'Unagi Butter Rice has finally landed at Okiru. Comforting, rich, and ready to be enjoyed. (Excluding tax and service)',
                        'price' => 'Rp 175.000 (excl. tax & service)',
                    ],
                    [
                        'name' => 'Unagi Butter Rice (Add on Beef Wagyu MB5)',
                        'description' => 'Our Unagi Butter Rice now comes with a premium upgrade add Wagyu MB5 beef on top for the ultimate flavor boost (Excluding tax and service)',
                        'price' => 'Rp 275.000 (excl. tax & service)',
                    ],
                ],
            ],
        ],
    ],
    [
        'id' => 'burger-king-ijen-besar-malang',
        'name' => 'Burger King Ijen Besar Malang',
        'category' => 'Fast Food',
        'cuisine' => 'American / Burger',
        'rating' => null,
        'distance' => null,
        'description' => 'Restoran cepat saji Burger King di kawasan Jl. Besar Ijen Malang yang menyajikan burger panggang khas, aneka paket ayam, kentang goreng, dan hidangan penutup dengan fasilitas 24 jam dan drive-thru.',
        'location' => 'Jl. Besar Ijen No. 84, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119',
        'latitude' => null,
        'longitude' => null,
        'phone' => '0819-1708-1121',
        'website' => 'https://bkdelivery.co.id/',
        'maps_url' => 'https://www.google.com/maps/search/?api=1&query=Burger+King+Ijen+Besar+Malang',
        'instagram_url' => 'https://www.instagram.com/burgerking.id/',
        'external_menu_url' => null,
        'hero_image' => 'assets/restaurants/burger-king-ijen-besar-malang/exterior/Screenshot_20261013_130205_Maps.jpg',
        'hours' => [
            'Monday' => '00:00 – 24:00',
            'Tuesday' => '00:00 – 24:00',
            'Wednesday' => '00:00 – 24:00',
            'Thursday' => '00:00 – 24:00',
            'Friday' => '00:00 – 24:00',
            'Saturday' => '00:00 – 24:00',
            'Sunday' => '00:00 – 24:00',
        ],
        'reservation_enabled' => false,
        'external_links' => [
            [
                'label' => 'Kunjungi Website Resmi',
                'url' => 'https://bkdelivery.co.id/',
            ],
            [
                'label' => 'Petunjuk Arah',
                'url' => 'https://www.google.com/maps/search/?api=1&query=Burger+King+Ijen+Besar+Malang',
            ],
            [
                'label' => 'Instagram Resmi',
                'url' => 'https://www.instagram.com/burgerking.id/',
            ],
        ],
        'gallery' => [
            [
                'alt' => 'Pintu masuk dan fasad depan Burger King Ijen Besar Malang',
                'src' => 'assets/restaurants/burger-king-ijen-besar-malang/exterior/Screenshot_20261013_130407_Maps.jpg',
            ],
            [
                'alt' => 'Area pemesanan kasir dan dapur bersih Burger King Ijen Besar Malang',
                'src' => 'assets/restaurants/burger-king-ijen-besar-malang/interior/Screenshot_20261013_130233_Maps.jpg',
            ],
            [
                'alt' => 'Es krim sundae vanilla Burger King dengan saus cokelat',
                'src' => 'assets/restaurants/burger-king-ijen-besar-malang/food/Food1.jpg',
            ],
            [
                'alt' => 'Burger Whopper dengan roti wijen dan sayuran segar di Burger King Ijen',
                'src' => 'assets/restaurants/burger-king-ijen-besar-malang/food/Food2.jpg',
            ],
            [
                'alt' => 'Burger ayam renyah dengan selada dan saus mayones di Burger King',
                'src' => 'assets/restaurants/burger-king-ijen-besar-malang/food/Food3.jpg',
            ],
            [
                'alt' => 'Paket combo Burger King dengan kentang goreng, burger, dan minuman dingin',
                'src' => 'assets/restaurants/burger-king-ijen-besar-malang/food/Food4.jpg',
            ],
        ],
        'menu' => [],
    ],
    [
        'id' => 'dialogi-signature-malang',
        'name' => 'Dialoogi Signature Restaurant Malang',
        'category' => 'Restaurant',
        'cuisine' => 'Asian Fusion',
        'rating' => null,
        'distance' => null,
        'description' => 'Restoran casual dining dan lounge di Jl. Bandung No. 40 Malang yang menyajikan hidangan Asian fusion, aneka hidangan utama ayam, daging sapi, hidangan laut, pasta, pastry artisan, dan minuman racikan khas.',
        'location' => 'Jl. Bandung No.40, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65113',
        'latitude' => null,
        'longitude' => null,
        'phone' => '0812-3438-0800',
        'website' => 'https://linktr.ee/dialoogi.signature',
        'maps_url' => 'https://www.google.com/maps/search/?api=1&query=Dialoogi+Signature+Restaurant+Malang',
        'instagram_url' => 'https://www.instagram.com/dialoogi.signature/',
        'external_menu_url' => null,
        'hero_image' => 'assets/restaurants/dialogi-signature-malang/gallery/Profile8.jpg',
        'hours' => [
            'Monday' => '10:00 – 22:00',
            'Tuesday' => '10:00 – 22:00',
            'Wednesday' => '10:00 – 22:00',
            'Thursday' => '10:00 – 22:00',
            'Friday' => '10:00 – 23:00',
            'Saturday' => '10:00 – 23:00',
            'Sunday' => '10:00 – 23:00',
        ],
        'reservation_enabled' => false,
        'external_links' => [
            [
                'label' => 'Linktree Resmi',
                'url' => 'https://linktr.ee/dialoogi.signature',
            ],
            [
                'label' => 'Petunjuk Arah',
                'url' => 'https://www.google.com/maps/search/?api=1&query=Dialoogi+Signature+Restaurant+Malang',
            ],
            [
                'label' => 'Instagram Resmi',
                'url' => 'https://www.instagram.com/dialoogi.signature/',
            ],
        ],
        'gallery' => [
            [
                'alt' => 'Suasana ruang makan utama Dialoogi Signature dengan ornamen langit-langit kayu dan lambang kuningan di dinding marmer',
                'src' => 'assets/restaurants/dialogi-signature-malang/gallery/Profile8.jpg',
            ],
            [
                'alt' => 'Penataan meja jamuan VIP dengan hiasan bunga dan tanaman hijau indoor di Dialoogi Signature',
                'src' => 'assets/restaurants/dialogi-signature-malang/gallery/Profile2.jpg',
            ],
            [
                'alt' => 'Area santap semi-outdoor beratap kaca dengan rumput hijau dan pohon bonsai di Dialoogi Signature',
                'src' => 'assets/restaurants/dialogi-signature-malang/gallery/Profile4.jpg',
            ],
            [
                'alt' => 'Meja makan kayu dan kursi rotan berlatar instalasi pohon dan lumut alami di Dialoogi Signature',
                'src' => 'assets/restaurants/dialogi-signature-malang/gallery/Profile6.jpg',
            ],
            [
                'alt' => 'Tenderloin With Mango Salad disajikan dengan saus khas di atas meja kayu Dialoogi Signature',
                'src' => 'assets/restaurants/dialogi-signature-malang/food/Food8.jpg',
            ],
            [
                'alt' => 'Salmon fillet panggang disajikan dengan mashed potato dan aneka sayuran segar di Dialoogi Signature',
                'src' => 'assets/restaurants/dialogi-signature-malang/food/Food6.jpg',
            ],
        ],
        'menu' => [
            [
                'category' => 'Finger Licking Bites',
                'id' => 'menu-finger-licking-bites',
                'items' => [
                    [
                        'name' => 'Roti Goreng Udang',
                        'description' => 'Deep fried prawn toast, sesame seed, fish roe, mentai mayo',
                        'price' => 'Rp 50.000',
                    ],
                    [
                        'name' => 'Handcut cheese fries',
                        'description' => 'Local \'kawi\' potato fries, scallion, parmesan cheese and tartar mayo',
                        'price' => 'Rp 50.000',
                    ],
                    [
                        'name' => 'Truffle fries',
                        'description' => 'Straight cut fries tossed with truffle oil served with tartar mayo',
                        'price' => 'Rp 50.000',
                    ],
                    [
                        'name' => 'Pangsit Goreng Sapi',
                        'description' => 'Fried dumplings filled with aromatic stir fried minced beef, served with mentai sauce',
                        'price' => 'Rp 50.000',
                    ],
                    [
                        'name' => 'Fish n chips',
                        'description' => 'Deep fried fish with fries and tartar sauce',
                        'price' => 'Rp 74.000',
                    ],
                ],
            ],
            [
                'category' => 'Salad',
                'id' => 'menu-salad',
                'items' => [
                    [
                        'name' => 'Caesar Salad',
                        'description' => 'Romaine lettuce, caesar dressing, chicken fajita, onsen egg, shaved parmesan and grated cured egg',
                        'price' => 'Rp 55.000',
                    ],
                    [
                        'name' => 'Salmon Salad',
                        'description' => 'Salmon fillet, mixed greens, kyuri & rice paper, drizzled with zesty citrus dressing & hint of spice',
                        'price' => 'Rp 65.000',
                    ],
                    [
                        'name' => 'Vietnam Beef Salad',
                        'description' => 'Grilled beef with asian spice, peanut crumble, noodles, kyuri, carrot, tomato, coriander leaf and sweet spice tamarind dressing',
                        'price' => 'Rp 68.000',
                    ],
                ],
            ],
            [
                'category' => 'Soup',
                'id' => 'menu-soup',
                'items' => [
                    [
                        'name' => 'Buntut Kuah Mesanten',
                        'description' => 'Cooked beef oxtail with kuah kuning mesanten, eggplant, daun kelor, sweet corn served with steam rice and sambal',
                        'price' => 'Rp 95.000',
                    ],
                    [
                        'name' => 'Iga Garang Asem "Bali"',
                        'description' => 'Braised beef ribs balinese style with belimbing wuluh, tomato served with steam rice and sambal',
                        'price' => 'Rp 93.000',
                    ],
                ],
            ],
            [
                'category' => 'Main Course Chicken',
                'id' => 'menu-main-course-chicken',
                'items' => [
                    [
                        'name' => 'Ayam Bakar Plecing',
                        'description' => 'Half spring chicken grilled with buleleng plecing sauce served with aromatic rice, beberuk tauge & umami spice broth',
                        'price' => 'Rp 90.000',
                    ],
                    [
                        'name' => 'Steam Roast Chicken Betutu',
                        'description' => 'Balinese steam roast chicken with rice, jukut kalas, and trio of sambals',
                        'price' => 'Rp 90.000',
                    ],
                    [
                        'name' => 'Nasi Bebek Jukut Kalas',
                        'description' => 'Tender fried duck served with rempah butter rice, jukut kalas, lalapan, and a trio sambal',
                        'price' => 'Rp 85.000',
                    ],
                    [
                        'name' => 'Rolade Ala Mama',
                        'description' => 'Chicken roulade, fries, mama bistik sauce, cucumber coconut salad',
                        'price' => 'Rp 78.000',
                    ],
                    [
                        'name' => 'Klodjen Chicken bowl',
                        'description' => 'Nori butter rice, chicken satay yakitori, edamame, sweet corn, fresh tomato, lokal tempe chips, onsen egg, scallion and grated parmesan cheese',
                        'price' => 'Rp 78.000',
                    ],
                    [
                        'name' => 'Nasi Rames Ala Signature',
                        'description' => 'Nasi gurih tempe, ayam pelalah, sambal ijo, sambal matah, mustopa potato, jukut kalas',
                        'price' => 'Rp 75.000',
                    ],
                    [
                        'name' => '"Ayam Kukus" inspired from ayam pop west sumatra',
                        'description' => 'Steam chicken leg with coconut milk, smashed baby potatoes, served with trio sambal and steam rice',
                        'price' => 'Rp 75.000',
                    ],
                ],
            ],
            [
                'category' => 'Main Course Beef',
                'id' => 'menu-main-course-beef',
                'items' => [
                    [
                        'name' => 'Tenderloin With Mango Salad',
                        'description' => 'Sous vide Tenderloin steak, mango salad, nanjim, coriander leaf, mint leaf served with corn aromatic rice',
                        'price' => 'Rp 235.000',
                    ],
                    [
                        'name' => 'Kalio Iga Sapi',
                        'description' => 'Grilled beef ribs, dan ubi tumbuk, kalio sauce, potato chips, dabu dabu served with steam rice',
                        'price' => 'Rp 125.000',
                    ],
                    [
                        'name' => 'Iga Bakar Rempah',
                        'description' => 'Iga bakar serundeng, salsa dabu-dabu, aromatic steamed rice, sambal terasi, & chips',
                        'price' => 'Rp 125.000',
                    ],
                    [
                        'name' => 'Daging Bakar Meltique Bumbu Kluwek',
                        'description' => 'Grill meltique beef, perkedel mashed potatoes, tempe crumble, onion texture, coconut srundeng',
                        'price' => 'Rp 125.000',
                    ],
                    [
                        'name' => 'Ribs Burger',
                        'description' => 'Homemade brioche bun, grilled beef ribs, iceberg lettuce, red onion pickles, american mayo, kemangi aioli, served with handcut kawi fries',
                        'price' => 'Rp 125.000',
                    ],
                    [
                        'name' => 'Sate Manis Saikoro',
                        'description' => '150 gr saikoro meltique beef satay, maranggi sauce, peanut crumble, pickles, dabu dabu served with steamed rice',
                        'price' => 'Rp 95.000',
                    ],
                ],
            ],
            [
                'category' => 'Main Course Fish',
                'id' => 'menu-main-course-fish',
                'items' => [
                    [
                        'name' => 'Salmon Gulai Aceh',
                        'description' => 'Skin on salmon fillet, gulai aceh sauce, curry leaf, baked eggplant, rambak crackers served with steamed rice',
                        'price' => 'Rp 148.000',
                    ],
                    [
                        'name' => 'Salmon Teriyaki',
                        'description' => 'Salmon fillet glazed with teriyaki sauce, served with seasonal vegetables, and mashed potato',
                        'price' => 'Rp 148.000',
                    ],
                ],
            ],
            [
                'category' => 'Pasta',
                'id' => 'menu-pasta',
                'items' => [
                    [
                        'name' => 'Balacan Seafood Noodles',
                        'description' => 'Stir-fried kwetiau rice noodles, bumbu balacan, prawn, calamary, fish balls, vegetables',
                        'price' => 'Rp 85.000',
                    ],
                    [
                        'name' => 'Fettucine Kemangi Sauce',
                        'description' => 'Fettucine pasta, creamy kemangi sauce, pan seared chicken breast',
                        'price' => 'Rp 70.000',
                    ],
                    [
                        'name' => 'Rigatoni With Creamy Korean Sauce',
                        'description' => 'Rigatoni pasta, gochujang, cheese, pan seared chicken breast',
                        'price' => 'Rp 70.000',
                    ],
                ],
            ],
            [
                'category' => 'Fried Rice',
                'id' => 'menu-fried-rice',
                'items' => [
                    [
                        'name' => 'Nasi Goreng Sapi Balado',
                        'description' => 'X.O fried rice, sapi balado, potato chips and lalapan',
                        'price' => 'Rp 80.000',
                    ],
                    [
                        'name' => 'Nasi Goreng Rempah Sapi',
                        'description' => 'Spiced fried rice with beef, egg, crackers, and pickles',
                        'price' => 'Rp 80.000',
                    ],
                    [
                        'name' => 'Legit Beef Fried Rice',
                        'description' => 'Fried rice with soy wagyu beef ragout',
                        'price' => 'Rp 75.000',
                    ],
                    [
                        'name' => 'Butter Rice (Chicken/Beef)',
                        'description' => 'Fried rice with herb garlic butter & almond crumble',
                        'price' => 'Rp 75.000',
                    ],
                ],
            ],
            [
                'category' => 'Dessert',
                'id' => 'menu-dessert',
                'items' => [
                    [
                        'name' => 'Lemon Truffle Cremeux',
                        'description' => 'Creamy cheese cremeux and infused lemon served with berry compote',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Raspberry Roses',
                        'description' => 'Raspberry confit, vanilla mousse, & berry sauce',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Basque Burnt Cheese Cake',
                        'description' => 'Burnt cheese cake served with vanilla ice cream',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Klappertart',
                        'description' => 'Coconut kue, raisin, almond, aren butter sauce',
                        'price' => 'Rp 45.000',
                    ],
                ],
            ],
            [
                'category' => 'Patisserie',
                'id' => 'menu-patisserie',
                'items' => [
                    [
                        'name' => 'Raspberry Apple Puff',
                        'price' => 'Rp 38.000',
                    ],
                    [
                        'name' => 'Almond Croissant',
                        'price' => 'Rp 38.000',
                    ],
                    [
                        'name' => 'Danish Strawberry',
                        'price' => 'Rp 38.000',
                    ],
                    [
                        'name' => 'Danish Cheese',
                        'price' => 'Rp 38.000',
                    ],
                    [
                        'name' => 'Soussie vaniglie Chocolalt',
                        'price' => 'Rp 38.000',
                    ],
                    [
                        'name' => 'Croissant Butter',
                        'price' => 'Rp 30.000',
                    ],
                ],
            ],
            [
                'category' => 'Healthy Juice',
                'id' => 'menu-healthy-juice',
                'items' => [
                    [
                        'name' => 'Yellow Sunset',
                        'description' => 'Fresh pineapple, sunkist orange, cranberry juice, orange juice',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Apple Fruvella',
                        'description' => 'Green apple, Dragon Fruit',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Troppical Juice',
                        'description' => 'Fresh Strawberry, pineapple, Sunkist orange, cranberry juice',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Bumi',
                        'description' => 'Fresh Hydroponic pokcoy, green apple, mixed with aromatic celery',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Rona',
                        'description' => 'Watermelon, fresh Strawberry, mixed with lychee',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Green Kyuri Refresh',
                        'description' => 'Fresh kyuri mixed with apple juice',
                        'price' => 'Rp 47.000',
                    ],
                    [
                        'name' => 'Atma',
                        'description' => 'Fresh melon, Kyuri, mixied with apple juice',
                        'price' => 'Rp 47.000',
                    ],
                ],
            ],
            [
                'category' => 'Mocktails & Smoothies',
                'id' => 'menu-mocktails-smoothies',
                'items' => [
                    [
                        'name' => 'Lemongrass Fizz',
                        'description' => 'Aromatic mocktail with fragrant lemongrass, and lime, perfectly balanced with the sweetness of lychee flavour and apple juice',
                        'price' => 'Rp 49.000',
                    ],
                    [
                        'name' => 'Sunkist Presso',
                        'description' => 'Fresh orange, vanilla syrup, orange juice & espresso',
                        'price' => 'Rp 55.000',
                    ],
                    [
                        'name' => 'Berry Luxe',
                        'description' => 'Fresh strawberry, cranberry juice, mixed with fresh lemon, & coconut syrup',
                        'price' => 'Rp 50.000',
                    ],
                    [
                        'name' => 'Senandung',
                        'description' => 'A sophisticated and refreshing fusion of calming chamomile tea and sweet cookie syrup',
                        'price' => 'Rp 49.000',
                    ],
                    [
                        'name' => 'Pisang Rai',
                        'description' => 'Air tajin, pineapple juice, pandan, coconut milk, gula aren',
                        'price' => 'Rp 45.000',
                    ],
                    [
                        'name' => 'Create Your Smoothies',
                        'description' => 'Banana, Dragon Fruit, Strawberry, Local Murbei Berry, Yogurt with fresh milk, honey, topped with Granola',
                        'price' => 'Rp 40.000',
                    ],
                ],
            ],
            [
                'category' => 'Coffee',
                'id' => 'menu-coffee',
                'items' => [
                    [
                        'name' => 'Kopi Berdialoogi',
                        'description' => 'Signature Coffee Bottle of Dialoogi',
                        'price' => 'Rp 45.000 (Ice)',
                    ],
                    [
                        'name' => 'Mochaccino',
                        'description' => 'Espresso shoot mixed with chocolate & fresh milk',
                        'price' => 'Rp 35.000 (Hot) / Rp 42.000 (Ice)',
                    ],
                    [
                        'name' => 'Caramel Macchiato',
                        'description' => 'Vanilla latte topped with caramel sauce & espresso',
                        'price' => 'Rp 42.000 (Ice)',
                    ],
                    [
                        'name' => 'Aren Latte',
                        'description' => 'Cafe latte with palm sugar syrup',
                        'price' => 'Rp 40.000 (Ice)',
                    ],
                    [
                        'name' => 'Cinnamon Dolce',
                        'description' => 'Cafe Latte with creamer & cinnamon',
                        'price' => 'Rp 40.000 (Ice)',
                    ],
                    [
                        'name' => 'Caffe Latte',
                        'description' => 'Classic combination of fresh milk & espresso',
                        'price' => 'Rp 35.000 (Hot) / Rp 39.000 (Ice)',
                    ],
                    [
                        'name' => 'Cappuccino',
                        'description' => 'Espresso shoot topped with steamed milk',
                        'price' => 'Rp 35.000 (Hot)',
                    ],
                    [
                        'name' => 'Americano',
                        'price' => 'Rp 30.000 (Hot) / Rp 32.000 (Ice)',
                    ],
                    [
                        'name' => 'Longblack',
                        'price' => 'Rp 30.000 (Hot) / Rp 34.000 (Ice)',
                    ],
                    [
                        'name' => 'Espresso',
                        'price' => 'Rp 28.000 (Hot)',
                    ],
                ],
            ],
            [
                'category' => 'Tea & Other',
                'id' => 'menu-tea-other',
                'items' => [
                    [
                        'name' => 'Lychee Tea',
                        'price' => 'Rp 37.000 (Ice)',
                    ],
                    [
                        'name' => 'Peach Tea',
                        'price' => 'Rp 37.000 (Ice)',
                    ],
                    [
                        'name' => 'Chamomile Tea',
                        'price' => 'Rp 33.000 (Hot)',
                    ],
                    [
                        'name' => 'Peppermint Tea',
                        'price' => 'Rp 33.000 (Hot)',
                    ],
                    [
                        'name' => 'Lemon Tea',
                        'price' => 'Rp 33.000 (Hot) / Rp 35.000 (Ice)',
                    ],
                    [
                        'name' => 'Black Tea',
                        'price' => 'Rp 27.000 (Hot) / Rp 29.000 (Ice)',
                    ],
                    [
                        'name' => 'Mineral Water (750ml)',
                        'price' => 'Rp 30.000',
                    ],
                ],
            ],
            [
                'category' => 'Upgrade & Add-On',
                'id' => 'menu-upgrade-addon',
                'items' => [
                    [
                        'name' => 'Nasi Sela Ungu',
                        'description' => 'Inspired from karangasem bali mix rice with ubi sela ungu',
                        'price' => '+ Rp 17.500',
                    ],
                    [
                        'name' => 'Nasi Daun Jeruk',
                        'description' => 'Aromatic steam rice mix with kaffir lime leaf',
                        'price' => '+ Rp 17.500',
                    ],
                    [
                        'name' => 'Nasi Gurih Tempe',
                        'description' => 'Special chef creation mix local tempe with rice and lime leaf',
                        'price' => '+ Rp 17.500',
                    ],
                    [
                        'name' => 'Rempah Butter Rice',
                        'description' => 'Coconut butter stirred fried rice with local aromatic n spice',
                        'price' => '+ Rp 17.500',
                    ],
                    [
                        'name' => 'Aromatic Steamed Rice',
                        'price' => '+ Rp 17.500',
                    ],
                ],
            ],
        ],
    ],
];

return array_map(fn(array $data): Restaurant => Restaurant::fromArray($data), $rawRestaurants);
