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
        id: 'okiru-ramen',
        name: 'Okiru Ramen',
        category: 'Asian Food',
        cuisine: 'Japanese • Ramen Bar',
        rating: null,
        distance: null,
        description: 'Bar ramen bernuansa Jepang di Jl. Bandung No. 5 Malang yang menyajikan ramen kaldu Paitan, Shoyu, Tantan, aneka hidangan pembuka, sushi roll, dan hidangan penutup khas.',
        location: 'Jl. Bandung No. 5, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65113',
        latitude: -7.9617932,
        longitude: 112.623681,
        phone: '+62 822-2897-8497',
        website: 'https://linktr.ee/okiruspiritramenbar',
        external_menu_url: 'https://drive.google.com/file/d/1PHc2pjUS3tifwjjVVb4AVqYKjzqEuJOD/view?usp=drivesdk',
        hero_image: 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234732.png',
        hours: {
            Monday: '10:00 – 22:00',
            Tuesday: '10:00 – 22:00',
            Wednesday: '10:00 – 22:00',
            Thursday: '10:00 – 22:00',
            Friday: '10:00 – 22:00',
            Saturday: '10:00 – 22:00',
            Sunday: '10:00 – 22:00',
        },
        reservation_enabled: false,
        gallery: [
            {
                alt: 'Interior ruang makan bernuansa kayu Jepang dengan lampion chochin di Okiru Ramen',
                src: 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234732.png',
            },
            {
                alt: 'Detail seni lukisan dinding Jepang dan ornamen kayu di Okiru Ramen',
                src: 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234812.png',
            },
            {
                alt: 'Salmon Truffle carpaccio disajikan dengan minyak truffle',
                src: 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234210.png',
            },
            {
                alt: 'Aburi Salmon Roll dengan saus mentai dan tobiko',
                src: 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234222.png',
            },
            {
                alt: 'Soft-Shell Crab Tempura renyah dengan saus cocolan',
                src: 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 234301.png',
            },
            {
                alt: 'Milk Pudding khas Jepang disajikan dengan es krim vanila dan buah segar',
                src: 'assets/restaurants/okiru-ramen/source/Screenshot 2026-10-12 233541.png',
            },
        ],
        menu: [
            {
                category: 'Paitan Soup Ramen (Rich and Creamy)',
                id: 'menu-paitan',
                items: [
                    {
                        name: 'Wagyu Steak',
                        description: 'Daging premium yang dengan marmer lemak yang halus merata',
                        price: 'Rp 55.000',
                    },
                    {
                        name: 'Wagyu Saikoro',
                        description: 'Daging yang dipotong bentuk cube / dadu dan dibumbui khas Okiru',
                        price: 'Rp 58.000',
                    },
                    {
                        name: 'Chicken Chasu',
                        description: 'Ayam gulung rebus yang dimasak dengan bumbu khas Okiru',
                        price: 'Rp 48.000',
                    },
                ],
            },
            {
                category: 'Shoyu Soup Ramen (Light)',
                id: 'menu-shoyu',
                items: [
                    {
                        name: 'Nitamago',
                        description: 'Telur omega yang di marinasi belasan jam dengan bumbu khas Okiru',
                        price: 'Rp 35.000',
                    },
                    {
                        name: 'Wagyu Saikoro',
                        description: 'Daging yang dipotong bentuk cube / dadu dan dibumbui khas Okiru',
                        price: 'Rp 58.000',
                    },
                    {
                        name: 'Chicken Chasu',
                        description: 'Ayam gulung rebus yang dimasak dengan bumbu khas Okiru',
                        price: 'Rp 48.000',
                    },
                ],
            },
            {
                category: 'Tantan Ramen (Level Spicy 1-5)',
                id: 'menu-tantan',
                items: [
                    {
                        name: 'Wagyu Steak',
                        description: 'Daging premium yang dengan marmer lemak yang halus merata',
                        price: 'Rp 55.000',
                    },
                    {
                        name: 'Wagyu Saikoro',
                        description: 'Daging yang dipotong bentuk cube / dadu dan dibumbui khas Okiru',
                        price: 'Rp 58.000',
                    },
                    {
                        name: 'Chicken Chasu',
                        description: 'Ayam gulung rebus yang dimasak dengan bumbu khas Okiru',
                        price: 'Rp 48.000',
                    },
                ],
            },
            {
                category: 'Dry Ramen',
                id: 'menu-dry-ramen',
                items: [
                    {
                        name: 'Tantan Katsu',
                        description: 'Ramen kuah pedas gurih dengan topping dada ayam tepung',
                        price: 'Rp 55.000',
                    },
                    {
                        name: 'Spicy Cheese',
                        description: 'Ramen kuah keju sedikit pedas dengan toping ayam',
                        price: 'Rp 55.000',
                    },
                    {
                        name: 'Dry Minced Tofu',
                        description: 'Ramen kering dengan topping daging cincang dan tofu',
                        price: 'Rp 45.000',
                    },
                ],
            },
            {
                category: 'Donburi',
                id: 'menu-donburi',
                items: [
                    {
                        name: 'Salmon Belly Don',
                        description: 'Perut salmon dengan tobiko dan beras Jepang',
                        price: 'Rp 65.000',
                    },
                    {
                        name: 'Wagyu Don',
                        description: 'Wagyu dengan telur omega 3 dan beras Jepang',
                        price: 'Rp 68.000',
                    },
                    {
                        name: 'Saikoro Don',
                        description: 'Wagyu saikoro dengan telur omega 3 dan beras Jepang',
                        price: 'Rp 68.000',
                    },
                ],
            },
            {
                category: 'Special Menu',
                id: 'menu-special-menu',
                items: [
                    {
                        name: 'Beef Teppanyaki',
                        description: 'Daging sapi premium yang dimasak langsung di atas pelat besi panas oleh chef ahli, hidangan ini menawarkan rasa gurih dan juicy yang memikat.',
                        price: 'Rp 185.000',
                    },
                    {
                        name: 'Salmon Head',
                        description: 'Kepala salmon yang di masak garlic butter dan irisan daging ham sapi + nasi putih',
                        price: 'Rp 68.000',
                    },
                    {
                        name: 'Salmon Teppanyaki',
                        description: 'Fillet salmon segar yang dimasak langsung di atas pelat besi panas oleh chef ahli, hidangan ini menawarkan rasa gurih dan juicy yang memikat.',
                        price: 'Rp 160.000',
                    },
                ],
            },
            {
                category: 'Kids Meal',
                id: 'menu-kids-meal',
                items: [
                    {
                        name: 'Kids Meal A',
                        description: 'Nasi goreng salmon, nitamago, ebi tempura, acar',
                        price: 'Rp 60.000',
                    },
                    {
                        name: 'Kids Meal B',
                        description: 'Nasi putih Jepang, beef teriyaki, ebi tempura, acar',
                        price: 'Rp 65.000',
                    },
                ],
            },
            {
                category: 'Special Fried Rice',
                id: 'menu-special-fried-rice',
                items: [
                    {
                        name: 'Salmon Fried Rice',
                        description: 'Nasi goreng salmon & telur',
                        price: 'Rp 65.000',
                    },
                    {
                        name: 'Beef Fried Rice',
                        description: 'Nasi goreng daging & telur',
                        price: 'Rp 65.000',
                    },
                    {
                        name: 'Chicken Fried Rice',
                        description: 'Nasi goreng ayam & telur',
                        price: 'Rp 65.000',
                    },
                ],
            },
            {
                category: 'Snack',
                id: 'menu-snacks',
                items: [
                    {
                        name: 'Salmon Truffle',
                        description: 'Potongan salmon yang disajikan dengan minyak truffle sebagai saus',
                        price: 'Rp 58.000',
                    },
                    {
                        name: 'Nori Tempura',
                        description: 'Rumput laut goreng dilapisi tempura khas Okiru',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Ebi Tempura',
                        description: 'Udang yang dilapisi dengan adonan tempura digoreng renyah',
                        price: 'Rp 35.000',
                    },
                    {
                        name: 'Ika Karage',
                        description: 'Potongan cumi-cumi yang digoreng dengan tepung hingga renyah di luar dan lembut di dalam',
                        price: 'Rp 30.000',
                    },
                    {
                        name: 'Chicken Karage',
                        description: 'Potongan ayam yang digoreng tepung mempunyai rasa renyah di luar dan juicy di dalam',
                        price: 'Rp 30.000',
                    },
                    {
                        name: 'Salmon Skin',
                        description: 'Kulit salmon di goreng tepung, mempunyai rasa renyah diluar juicy di dalam',
                        price: 'Rp 40.000',
                    },
                    {
                        name: 'Gyoza',
                        description: 'Pangsit Jepang yang diisi dengan daging ayam dan daun kucai',
                        price: 'Rp 35.000',
                    },
                ],
            },
            {
                category: 'Shusi and Desert',
                id: 'menu-shusi-and-desert',
                items: [
                    {
                        name: 'Unagi Roll',
                        description: 'Nori, beras sushi, kanimayo kyuri dan unagi',
                        price: 'Rp 40.000',
                    },
                    {
                        name: 'Aburi Salmon Roll',
                        description: 'Nori, beras sushi, kanimayo, salmon, saus mentai dan tobiko',
                        price: 'Rp 38.000',
                    },
                    {
                        name: 'Spicy Tuna Roll',
                        description: 'Nori, beras sushi, kanimayo timun dan tuna tar tar',
                        price: 'Rp 30.000',
                    },
                    {
                        name: 'Spicy Salmon Roll',
                        description: 'Nori, beras sushi, kanimayo kyuri, tobiko dan spicy salmon',
                        price: 'Rp 35.000',
                    },
                    {
                        name: 'Chesse Cake Green Tea',
                        price: 'Rp 58.000',
                    },
                    {
                        name: 'Chocolate Roulade',
                        price: 'Rp 45.000',
                    },
                    {
                        name: 'Milk Puding',
                        price: 'Rp 40.000',
                    },
                ],
            },
            {
                category: 'Signature Okiru',
                id: 'menu-signature-okiru',
                items: [
                    {
                        name: 'Nami Flower',
                        description: 'Sakura syrup, jasmine tea, lime juice, passion fruit syrup.',
                        price: 'Rp 35.000',
                    },
                    {
                        name: 'Yukari',
                        description: 'Fresh milk, strawberry syrup, lavender syrup, orange juice',
                        price: 'Rp 35.000',
                    },
                    {
                        name: 'Izumi',
                        description: 'Orange juice, almond syrup, rosemerry, cotton candy',
                        price: 'Rp 35.000',
                    },
                    {
                        name: 'Amai Ryokucha',
                        description: 'Matcha powder, freshmilk, earlgrey foam.',
                        price: 'Rp 35.000',
                    },
                ],
            },
            {
                category: 'Juice',
                id: 'menu-juice',
                items: [
                    {
                        name: 'Watermelon Juice',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Melon Juice',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Apple Juice',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Strawberry Juice',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Orange Juice',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Banana Juice',
                        price: 'Rp 25.000',
                    },
                ],
            },
            {
                category: 'Tea',
                id: 'menu-tea',
                items: [
                    {
                        name: 'Tea (C/H)',
                        price: 'Rp 20.000',
                    },
                    {
                        name: 'Lychee Tea',
                        price: 'Rp 20.000',
                    },
                    {
                        name: 'Lemon Tea',
                        price: 'Rp 20.000',
                    },
                    {
                        name: 'Ocha (C/H)',
                        price: 'Rp 20.000',
                    },
                ],
            },
            {
                category: 'Coffee',
                id: 'menu-coffee',
                items: [
                    {
                        name: 'Americano (C/H)',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Coffee Latte',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Cappucino',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Vanila',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Hazelnut',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Caramel',
                        price: 'Rp 25.000',
                    },
                    {
                        name: 'Affogato',
                        price: 'Rp 25.000',
                    },
                ],
            },
            {
                category: 'Soda & Mineral',
                id: 'menu-soda-mineral',
                items: [
                    {
                        name: 'Mineral',
                        price: 'Rp 15.000',
                    },
                    {
                        name: 'Cola',
                        price: 'Rp 20.000',
                    },
                    {
                        name: 'Sprite',
                        price: 'Rp 20.000',
                    },
                    {
                        name: 'Sparkling Water',
                        price: 'Rp 25.000',
                    },
                ],
            },
            {
                category: 'Upgrade & Add-On',
                id: 'menu-upgrade-addon',
                items: [
                    {
                        name: 'Upgrade Wagyu MB5',
                        price: '+ Rp 40.000',
                    },
                    {
                        name: 'Upgrade Wagyu MB5 (Beef Teppanyaki)',
                        price: '+ Rp 60.000',
                    },
                    {
                        name: 'Nitamago (Telur Omega 3)',
                        price: '+ Rp 10.000',
                    },
                    {
                        name: 'Shitake (Jamur Rebus)',
                        price: '+ Rp 10.000',
                    },
                    {
                        name: 'Gohan (Nasi Putih dengan Beras Jepang)',
                        price: '+ Rp 10.000',
                    },
                ],
            },
            {
                category: 'Promo Menu',
                id: 'menu-promo',
                items: [
                    {
                        name: 'Unagi Butter Rice',
                        description: 'Unagi Butter Rice has finally landed at Okiru. Comforting, rich, and ready to be enjoyed. (Excluding tax and service)',
                        price: 'Rp 175.000 (excl. tax & service)',
                    },
                    {
                        name: 'Unagi Butter Rice (Add on Beef Wagyu MB5)',
                        description: 'Our Unagi Butter Rice now comes with a premium upgrade add Wagyu MB5 beef on top for the ultimate flavor boost (Excluding tax and service)',
                        price: 'Rp 275.000 (excl. tax & service)',
                    },
                ],
            },
        ],
    },
    {
        id: 'burger-king-ijen-besar-malang',
        name: 'Burger King Ijen Besar Malang',
        category: 'Fast Food',
        cuisine: 'American / Burger',
        rating: null,
        distance: null,
        description: 'Restoran cepat saji Burger King di kawasan Jl. Besar Ijen Malang yang menyajikan burger panggang khas, aneka paket ayam, kentang goreng, dan hidangan penutup dengan fasilitas 24 jam dan drive-thru.',
        location: 'Jl. Besar Ijen No. 84, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65119',
        latitude: null,
        longitude: null,
        phone: '0819-1708-1121',
        website: 'https://bkdelivery.co.id/',
        maps_url: 'https://www.google.com/maps/search/?api=1&query=Burger+King+Ijen+Besar+Malang',
        instagram_url: 'https://www.instagram.com/burgerking.id/',
        external_menu_url: null,
        hero_image: 'assets/restaurants/burger-king-ijen-besar-malang/exterior/Screenshot_20261013_130205_Maps.jpg',
        hours: {
            Monday: '00:00 – 24:00',
            Tuesday: '00:00 – 24:00',
            Wednesday: '00:00 – 24:00',
            Thursday: '00:00 – 24:00',
            Friday: '00:00 – 24:00',
            Saturday: '00:00 – 24:00',
            Sunday: '00:00 – 24:00',
        },
        reservation_enabled: false,
        external_links: [
            {
                label: 'Kunjungi Website Resmi',
                url: 'https://bkdelivery.co.id/',
            },
            {
                label: 'Petunjuk Arah',
                url: 'https://www.google.com/maps/search/?api=1&query=Burger+King+Ijen+Besar+Malang',
            },
            {
                label: 'Instagram Resmi',
                url: 'https://www.instagram.com/burgerking.id/',
            },
        ],
        gallery: [
            {
                alt: 'Pintu masuk dan fasad depan Burger King Ijen Besar Malang',
                src: 'assets/restaurants/burger-king-ijen-besar-malang/exterior/Screenshot_20261013_130407_Maps.jpg',
            },
            {
                alt: 'Area pemesanan kasir dan dapur bersih Burger King Ijen Besar Malang',
                src: 'assets/restaurants/burger-king-ijen-besar-malang/interior/Screenshot_20261013_130233_Maps.jpg',
            },
            {
                alt: 'Es krim sundae vanilla Burger King dengan saus cokelat',
                src: 'assets/restaurants/burger-king-ijen-besar-malang/food/Food1.jpg',
            },
            {
                alt: 'Burger Whopper dengan roti wijen dan sayuran segar di Burger King Ijen',
                src: 'assets/restaurants/burger-king-ijen-besar-malang/food/Food2.jpg',
            },
            {
                alt: 'Burger ayam renyah dengan selada dan saus mayones di Burger King',
                src: 'assets/restaurants/burger-king-ijen-besar-malang/food/Food3.jpg',
            },
            {
                alt: 'Paket combo Burger King dengan kentang goreng, burger, dan minuman dingin',
                src: 'assets/restaurants/burger-king-ijen-besar-malang/food/Food4.jpg',
            },
        ],
        menu: [],
    },
    {
        id: 'dialogi-signature-malang',
        name: 'Dialoogi Signature Restaurant Malang',
        category: 'Restaurant',
        cuisine: 'Asian Fusion',
        rating: null,
        distance: null,
        description: 'Restoran casual dining dan lounge di Jl. Bandung No. 40 Malang yang menyajikan hidangan Asian fusion, aneka hidangan utama ayam, daging sapi, hidangan laut, pasta, pastry artisan, dan minuman racikan khas.',
        location: 'Jl. Bandung No.40, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65113',
        latitude: null,
        longitude: null,
        phone: '0812-3438-0800',
        website: 'https://linktr.ee/dialoogi.signature',
        maps_url: 'https://www.google.com/maps/search/?api=1&query=Dialoogi+Signature+Restaurant+Malang',
        instagram_url: 'https://www.instagram.com/dialoogi.signature/',
        external_menu_url: null,
        hero_image: 'assets/restaurants/dialogi-signature-malang/gallery/Profile8.jpg',
        hours: {
            Monday: '10:00 – 22:00',
            Tuesday: '10:00 – 22:00',
            Wednesday: '10:00 – 22:00',
            Thursday: '10:00 – 22:00',
            Friday: '10:00 – 23:00',
            Saturday: '10:00 – 23:00',
            Sunday: '10:00 – 23:00',
        },
        reservation_enabled: false,
        external_links: [
            {
                label: 'Linktree Resmi',
                url: 'https://linktr.ee/dialoogi.signature',
            },
            {
                label: 'Petunjuk Arah',
                url: 'https://www.google.com/maps/search/?api=1&query=Dialoogi+Signature+Restaurant+Malang',
            },
            {
                label: 'Instagram Resmi',
                url: 'https://www.instagram.com/dialoogi.signature/',
            },
        ],
        gallery: [
            {
                alt: 'Suasana ruang makan utama Dialoogi Signature dengan ornamen langit-langit kayu dan lambang kuningan di dinding marmer',
                src: 'assets/restaurants/dialogi-signature-malang/gallery/Profile8.jpg',
            },
            {
                alt: 'Penataan meja jamuan VIP dengan hiasan bunga dan tanaman hijau indoor di Dialoogi Signature',
                src: 'assets/restaurants/dialogi-signature-malang/gallery/Profile2.jpg',
            },
            {
                alt: 'Area santap semi-outdoor beratap kaca dengan rumput hijau dan pohon bonsai di Dialoogi Signature',
                src: 'assets/restaurants/dialogi-signature-malang/gallery/Profile4.jpg',
            },
            {
                alt: 'Meja makan kayu dan kursi rotan berlatar instalasi pohon dan lumut alami di Dialoogi Signature',
                src: 'assets/restaurants/dialogi-signature-malang/gallery/Profile6.jpg',
            },
            {
                alt: 'Tenderloin With Mango Salad disajikan dengan saus khas di atas meja kayu Dialoogi Signature',
                src: 'assets/restaurants/dialogi-signature-malang/food/Food8.jpg',
            },
            {
                alt: 'Salmon fillet panggang disajikan dengan mashed potato dan aneka sayuran segar di Dialoogi Signature',
                src: 'assets/restaurants/dialogi-signature-malang/food/Food6.jpg',
            },
        ],
        menu: [
            {
                category: 'Finger Licking Bites',
                id: 'menu-finger-licking-bites',
                items: [
                    {
                        name: 'Roti Goreng Udang',
                        description: 'Deep fried prawn toast, sesame seed, fish roe, mentai mayo',
                        price: 'Rp 50.000',
                    },
                    {
                        name: 'Handcut cheese fries',
                        description: 'Local \'kawi\' potato fries, scallion, parmesan cheese and tartar mayo',
                        price: 'Rp 50.000',
                    },
                    {
                        name: 'Truffle fries',
                        description: 'Straight cut fries tossed with truffle oil served with tartar mayo',
                        price: 'Rp 50.000',
                    },
                    {
                        name: 'Pangsit Goreng Sapi',
                        description: 'Fried dumplings filled with aromatic stir fried minced beef, served with mentai sauce',
                        price: 'Rp 50.000',
                    },
                    {
                        name: 'Fish n chips',
                        description: 'Deep fried fish with fries and tartar sauce',
                        price: 'Rp 74.000',
                    },
                ],
            },
            {
                category: 'Salad',
                id: 'menu-salad',
                items: [
                    {
                        name: 'Caesar Salad',
                        description: 'Romaine lettuce, caesar dressing, chicken fajita, onsen egg, shaved parmesan and grated cured egg',
                        price: 'Rp 55.000',
                    },
                    {
                        name: 'Salmon Salad',
                        description: 'Salmon fillet, mixed greens, kyuri & rice paper, drizzled with zesty citrus dressing & hint of spice',
                        price: 'Rp 65.000',
                    },
                    {
                        name: 'Vietnam Beef Salad',
                        description: 'Grilled beef with asian spice, peanut crumble, noodles, kyuri, carrot, tomato, coriander leaf and sweet spice tamarind dressing',
                        price: 'Rp 68.000',
                    },
                ],
            },
            {
                category: 'Soup',
                id: 'menu-soup',
                items: [
                    {
                        name: 'Buntut Kuah Mesanten',
                        description: 'Cooked beef oxtail with kuah kuning mesanten, eggplant, daun kelor, sweet corn served with steam rice and sambal',
                        price: 'Rp 95.000',
                    },
                    {
                        name: 'Iga Garang Asem "Bali"',
                        description: 'Braised beef ribs balinese style with belimbing wuluh, tomato served with steam rice and sambal',
                        price: 'Rp 93.000',
                    },
                ],
            },
            {
                category: 'Main Course Chicken',
                id: 'menu-main-course-chicken',
                items: [
                    {
                        name: 'Ayam Bakar Plecing',
                        description: 'Half spring chicken grilled with buleleng plecing sauce served with aromatic rice, beberuk tauge & umami spice broth',
                        price: 'Rp 90.000',
                    },
                    {
                        name: 'Steam Roast Chicken Betutu',
                        description: 'Balinese steam roast chicken with rice, jukut kalas, and trio of sambals',
                        price: 'Rp 90.000',
                    },
                    {
                        name: 'Nasi Bebek Jukut Kalas',
                        description: 'Tender fried duck served with rempah butter rice, jukut kalas, lalapan, and a trio sambal',
                        price: 'Rp 85.000',
                    },
                    {
                        name: 'Rolade Ala Mama',
                        description: 'Chicken roulade, fries, mama bistik sauce, cucumber coconut salad',
                        price: 'Rp 78.000',
                    },
                    {
                        name: 'Klodjen Chicken bowl',
                        description: 'Nori butter rice, chicken satay yakitori, edamame, sweet corn, fresh tomato, lokal tempe chips, onsen egg, scallion and grated parmesan cheese',
                        price: 'Rp 78.000',
                    },
                    {
                        name: 'Nasi Rames Ala Signature',
                        description: 'Nasi gurih tempe, ayam pelalah, sambal ijo, sambal matah, mustopa potato, jukut kalas',
                        price: 'Rp 75.000',
                    },
                    {
                        name: '"Ayam Kukus" inspired from ayam pop west sumatra',
                        description: 'Steam chicken leg with coconut milk, smashed baby potatoes, served with trio sambal and steam rice',
                        price: 'Rp 75.000',
                    },
                ],
            },
            {
                category: 'Main Course Beef',
                id: 'menu-main-course-beef',
                items: [
                    {
                        name: 'Tenderloin With Mango Salad',
                        description: 'Sous vide Tenderloin steak, mango salad, nanjim, coriander leaf, mint leaf served with corn aromatic rice',
                        price: 'Rp 235.000',
                    },
                    {
                        name: 'Kalio Iga Sapi',
                        description: 'Grilled beef ribs, dan ubi tumbuk, kalio sauce, potato chips, dabu dabu served with steam rice',
                        price: 'Rp 125.000',
                    },
                    {
                        name: 'Iga Bakar Rempah',
                        description: 'Iga bakar serundeng, salsa dabu-dabu, aromatic steamed rice, sambal terasi, & chips',
                        price: 'Rp 125.000',
                    },
                    {
                        name: 'Daging Bakar Meltique Bumbu Kluwek',
                        description: 'Grill meltique beef, perkedel mashed potatoes, tempe crumble, onion texture, coconut srundeng',
                        price: 'Rp 125.000',
                    },
                    {
                        name: 'Ribs Burger',
                        description: 'Homemade brioche bun, grilled beef ribs, iceberg lettuce, red onion pickles, american mayo, kemangi aioli, served with handcut kawi fries',
                        price: 'Rp 125.000',
                    },
                    {
                        name: 'Sate Manis Saikoro',
                        description: '150 gr saikoro meltique beef satay, maranggi sauce, peanut crumble, pickles, dabu dabu served with steamed rice',
                        price: 'Rp 95.000',
                    },
                ],
            },
            {
                category: 'Main Course Fish',
                id: 'menu-main-course-fish',
                items: [
                    {
                        name: 'Salmon Gulai Aceh',
                        description: 'Skin on salmon fillet, gulai aceh sauce, curry leaf, baked eggplant, rambak crackers served with steamed rice',
                        price: 'Rp 148.000',
                    },
                    {
                        name: 'Salmon Teriyaki',
                        description: 'Salmon fillet glazed with teriyaki sauce, served with seasonal vegetables, and mashed potato',
                        price: 'Rp 148.000',
                    },
                ],
            },
            {
                category: 'Pasta',
                id: 'menu-pasta',
                items: [
                    {
                        name: 'Balacan Seafood Noodles',
                        description: 'Stir-fried kwetiau rice noodles, bumbu balacan, prawn, calamary, fish balls, vegetables',
                        price: 'Rp 85.000',
                    },
                    {
                        name: 'Fettucine Kemangi Sauce',
                        description: 'Fettucine pasta, creamy kemangi sauce, pan seared chicken breast',
                        price: 'Rp 70.000',
                    },
                    {
                        name: 'Rigatoni With Creamy Korean Sauce',
                        description: 'Rigatoni pasta, gochujang, cheese, pan seared chicken breast',
                        price: 'Rp 70.000',
                    },
                ],
            },
            {
                category: 'Fried Rice',
                id: 'menu-fried-rice',
                items: [
                    {
                        name: 'Nasi Goreng Sapi Balado',
                        description: 'X.O fried rice, sapi balado, potato chips and lalapan',
                        price: 'Rp 80.000',
                    },
                    {
                        name: 'Nasi Goreng Rempah Sapi',
                        description: 'Spiced fried rice with beef, egg, crackers, and pickles',
                        price: 'Rp 80.000',
                    },
                    {
                        name: 'Legit Beef Fried Rice',
                        description: 'Fried rice with soy wagyu beef ragout',
                        price: 'Rp 75.000',
                    },
                    {
                        name: 'Butter Rice (Chicken/Beef)',
                        description: 'Fried rice with herb garlic butter & almond crumble',
                        price: 'Rp 75.000',
                    },
                ],
            },
            {
                category: 'Dessert',
                id: 'menu-dessert',
                items: [
                    {
                        name: 'Lemon Truffle Cremeux',
                        description: 'Creamy cheese cremeux and infused lemon served with berry compote',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Raspberry Roses',
                        description: 'Raspberry confit, vanilla mousse, & berry sauce',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Basque Burnt Cheese Cake',
                        description: 'Burnt cheese cake served with vanilla ice cream',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Klappertart',
                        description: 'Coconut kue, raisin, almond, aren butter sauce',
                        price: 'Rp 45.000',
                    },
                ],
            },
            {
                category: 'Patisserie',
                id: 'menu-patisserie',
                items: [
                    {
                        name: 'Raspberry Apple Puff',
                        price: 'Rp 38.000',
                    },
                    {
                        name: 'Almond Croissant',
                        price: 'Rp 38.000',
                    },
                    {
                        name: 'Danish Strawberry',
                        price: 'Rp 38.000',
                    },
                    {
                        name: 'Danish Cheese',
                        price: 'Rp 38.000',
                    },
                    {
                        name: 'Soussie vaniglie Chocolalt',
                        price: 'Rp 38.000',
                    },
                    {
                        name: 'Croissant Butter',
                        price: 'Rp 30.000',
                    },
                ],
            },
            {
                category: 'Healthy Juice',
                id: 'menu-healthy-juice',
                items: [
                    {
                        name: 'Yellow Sunset',
                        description: 'Fresh pineapple, sunkist orange, cranberry juice, orange juice',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Apple Fruvella',
                        description: 'Green apple, Dragon Fruit',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Troppical Juice',
                        description: 'Fresh Strawberry, pineapple, Sunkist orange, cranberry juice',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Bumi',
                        description: 'Fresh Hydroponic pokcoy, green apple, mixed with aromatic celery',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Rona',
                        description: 'Watermelon, fresh Strawberry, mixed with lychee',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Green Kyuri Refresh',
                        description: 'Fresh kyuri mixed with apple juice',
                        price: 'Rp 47.000',
                    },
                    {
                        name: 'Atma',
                        description: 'Fresh melon, Kyuri, mixied with apple juice',
                        price: 'Rp 47.000',
                    },
                ],
            },
            {
                category: 'Mocktails & Smoothies',
                id: 'menu-mocktails-smoothies',
                items: [
                    {
                        name: 'Lemongrass Fizz',
                        description: 'Aromatic mocktail with fragrant lemongrass, and lime, perfectly balanced with the sweetness of lychee flavour and apple juice',
                        price: 'Rp 49.000',
                    },
                    {
                        name: 'Sunkist Presso',
                        description: 'Fresh orange, vanilla syrup, orange juice & espresso',
                        price: 'Rp 55.000',
                    },
                    {
                        name: 'Berry Luxe',
                        description: 'Fresh strawberry, cranberry juice, mixed with fresh lemon, & coconut syrup',
                        price: 'Rp 50.000',
                    },
                    {
                        name: 'Senandung',
                        description: 'A sophisticated and refreshing fusion of calming chamomile tea and sweet cookie syrup',
                        price: 'Rp 49.000',
                    },
                    {
                        name: 'Pisang Rai',
                        description: 'Air tajin, pineapple juice, pandan, coconut milk, gula aren',
                        price: 'Rp 45.000',
                    },
                    {
                        name: 'Create Your Smoothies',
                        description: 'Banana, Dragon Fruit, Strawberry, Local Murbei Berry, Yogurt with fresh milk, honey, topped with Granola',
                        price: 'Rp 40.000',
                    },
                ],
            },
            {
                category: 'Coffee',
                id: 'menu-coffee',
                items: [
                    {
                        name: 'Kopi Berdialoogi',
                        description: 'Signature Coffee Bottle of Dialoogi',
                        price: 'Rp 45.000 (Ice)',
                    },
                    {
                        name: 'Mochaccino',
                        description: 'Espresso shoot mixed with chocolate & fresh milk',
                        price: 'Rp 35.000 (Hot) / Rp 42.000 (Ice)',
                    },
                    {
                        name: 'Caramel Macchiato',
                        description: 'Vanilla latte topped with caramel sauce & espresso',
                        price: 'Rp 42.000 (Ice)',
                    },
                    {
                        name: 'Aren Latte',
                        description: 'Cafe latte with palm sugar syrup',
                        price: 'Rp 40.000 (Ice)',
                    },
                    {
                        name: 'Cinnamon Dolce',
                        description: 'Cafe Latte with creamer & cinnamon',
                        price: 'Rp 40.000 (Ice)',
                    },
                    {
                        name: 'Caffe Latte',
                        description: 'Classic combination of fresh milk & espresso',
                        price: 'Rp 35.000 (Hot) / Rp 39.000 (Ice)',
                    },
                    {
                        name: 'Cappuccino',
                        description: 'Espresso shoot topped with steamed milk',
                        price: 'Rp 35.000 (Hot)',
                    },
                    {
                        name: 'Americano',
                        price: 'Rp 30.000 (Hot) / Rp 32.000 (Ice)',
                    },
                    {
                        name: 'Longblack',
                        price: 'Rp 30.000 (Hot) / Rp 34.000 (Ice)',
                    },
                    {
                        name: 'Espresso',
                        price: 'Rp 28.000 (Hot)',
                    },
                ],
            },
            {
                category: 'Tea & Other',
                id: 'menu-tea-other',
                items: [
                    {
                        name: 'Lychee Tea',
                        price: 'Rp 37.000 (Ice)',
                    },
                    {
                        name: 'Peach Tea',
                        price: 'Rp 37.000 (Ice)',
                    },
                    {
                        name: 'Chamomile Tea',
                        price: 'Rp 33.000 (Hot)',
                    },
                    {
                        name: 'Peppermint Tea',
                        price: 'Rp 33.000 (Hot)',
                    },
                    {
                        name: 'Lemon Tea',
                        price: 'Rp 33.000 (Hot) / Rp 35.000 (Ice)',
                    },
                    {
                        name: 'Black Tea',
                        price: 'Rp 27.000 (Hot) / Rp 29.000 (Ice)',
                    },
                    {
                        name: 'Mineral Water (750ml)',
                        price: 'Rp 30.000',
                    },
                ],
            },
            {
                category: 'Upgrade & Add-On',
                id: 'menu-upgrade-addon',
                items: [
                    {
                        name: 'Nasi Sela Ungu',
                        description: 'Inspired from karangasem bali mix rice with ubi sela ungu',
                        price: '+ Rp 17.500',
                    },
                    {
                        name: 'Nasi Daun Jeruk',
                        description: 'Aromatic steam rice mix with kaffir lime leaf',
                        price: '+ Rp 17.500',
                    },
                    {
                        name: 'Nasi Gurih Tempe',
                        description: 'Special chef creation mix local tempe with rice and lime leaf',
                        price: '+ Rp 17.500',
                    },
                    {
                        name: 'Rempah Butter Rice',
                        description: 'Coconut butter stirred fried rice with local aromatic n spice',
                        price: '+ Rp 17.500',
                    },
                    {
                        name: 'Aromatic Steamed Rice',
                        price: '+ Rp 17.500',
                    },
                ],
            },
        ],
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
 * Determines whether a restaurant is currently open based on verified operating hours.
 * Safely handles missing, invalid, or closed schedules.
 * @param {object} restaurant
 * @param {Date} [now]
 * @returns {boolean}
 */
function isRestaurantOpenNow(restaurant, now = new Date()) {
    const hours = getRestaurantHours(restaurant);
    if (!hours) return false;
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const dayName = days[now.getDay()];
    const todayHoursStr = hours[dayName];
    if (!todayHoursStr || typeof todayHoursStr !== 'string') return false;
    if (/24\s*(jam|hours?)/i.test(todayHoursStr)) return true;
    const timeMatch = todayHoursStr.match(/(\d{1,2}):(\d{2})\s*[–-]\s*(\d{1,2}):(\d{2})/);
    if (!timeMatch) return false;
    const currentMins = now.getHours() * 60 + now.getMinutes();
    const openMins = parseInt(timeMatch[1], 10) * 60 + parseInt(timeMatch[2], 10);
    const closeMins = parseInt(timeMatch[3], 10) * 60 + parseInt(timeMatch[4], 10);
    return currentMins >= openMins && currentMins < closeMins;
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

const FAVORITES_STORAGE_KEY = 'bitemap_favorites';
const BITEMAP_FAVORITES = new Set();

/**
 * Safely parses raw favorites JSON string and returns an array of valid canonical restaurant IDs.
 * Filters out malformed entries, non-strings, and unknown restaurant IDs.
 * @param {string|null} raw
 * @returns {Array<string>}
 */
function parseFavoritesString(raw) {
    if (!raw || typeof raw !== 'string') return [];
    try {
        const parsed = JSON.parse(raw);
        if (!Array.isArray(parsed)) return [];
        return parsed
            .filter(id => typeof id === 'string' && id.trim())
            .map(id => id.trim())
            .filter(id => !!getRestaurantById(id));
    } catch (_) {
        return [];
    }
}

/**
 * Loads persisted favorite restaurant IDs from browser localStorage.
 * Handles missing, empty, malformed, or restricted storage gracefully.
 */
function loadFavoritesFromStorage() {
    try {
        if (typeof window === 'undefined' || !window.localStorage) return;
        const raw = window.localStorage.getItem(FAVORITES_STORAGE_KEY);
        BITEMAP_FAVORITES.clear();
        if (raw) {
            const validIds = parseFavoritesString(raw);
            validIds.forEach(id => {
                BITEMAP_FAVORITES.add(id);
            });
        }
    } catch (e) {
        // Handle SecurityError, JSON parse errors, or quota exceptions safely
        console.warn('Unable to load favorites from localStorage:', e);
    }
}

/**
 * Persists the current active favorite IDs to browser localStorage.
 * Saves only an array of canonical string IDs — never full objects.
 */
function saveFavoritesToStorage() {
    try {
        if (typeof window === 'undefined' || !window.localStorage) return;
        const ids = Array.from(BITEMAP_FAVORITES);
        window.localStorage.setItem(FAVORITES_STORAGE_KEY, JSON.stringify(ids));
    } catch (e) {
        console.warn('Unable to save favorites to localStorage:', e);
    }
}

// Hydrate stored favorites on initial script evaluation
loadFavoritesFromStorage();

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
 * Toggles a restaurant in the centralized favorites set and persists changes.
 * Returns the new active state (true = saved, false = removed).
 * @param {string} restaurantId
 * @returns {boolean}
 */
function toggleFavorite(restaurantId) {
    if (!restaurantId) return false;
    let newState = false;
    if (BITEMAP_FAVORITES.has(restaurantId)) {
        BITEMAP_FAVORITES.delete(restaurantId);
        newState = false;
    } else {
        BITEMAP_FAVORITES.add(restaurantId);
        newState = true;
    }
    saveFavoritesToStorage();
    return newState;
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

/**
 * Resolves relative asset paths depending on whether the current page is
 * in /pages/ or at the root level.
 */
function getAssetPath(relativePath) {
    if (!relativePath || typeof relativePath !== 'string') return '';
    if (relativePath.startsWith('http://') || relativePath.startsWith('https://') || relativePath.startsWith('data:')) {
        return relativePath;
    }
    const path = window.location.pathname.replace(/\\/g, '/');
    const isInPages = path.includes('/pages/');
    if (isInPages) {
        return relativePath.startsWith('../') ? relativePath : '../' + relativePath;
    } else {
        return relativePath.startsWith('../') ? relativePath.substring(3) : relativePath;
    }
}

/**
 * Detects whether the current page context is PHP or static HTML.
 */
function getPageExtension() {
    const path = (typeof window !== 'undefined' && window.location && window.location.pathname) ? window.location.pathname.toLowerCase() : '';
    return (path.endsWith('.php') || path.includes('.php')) ? '.php' : '.html';
}

// ==========================================
// Dynamic Restaurant Card Rendering
// ==========================================

/**
 * Creates a single restaurant card DOM element from a data object.
 * Mirrors the exact markup of the existing static cards in explore.html.
 */
function createRestaurantCard(restaurant, linkBase = null, isActiveFavorite = null, customDistance = null) {
    if (!linkBase) {
        linkBase = 'restaurant' + getPageExtension();
    }
    const href = linkBase + '?id=' + encodeURIComponent(restaurant.id);
    const article = document.createElement('article');
    article.className = 'restaurant-card';
    article.dataset.id = restaurant.id;
    article.dataset.restaurantId = restaurant.id;

    const ratingHtml = typeof restaurant.rating === 'number'
        ? `<span class="rating-icon" aria-hidden="true">&#9733;</span> ${restaurant.rating.toFixed(1)}`
        : '<span>New &middot; No reviews yet</span>';

    let distanceText = null;
    if (customDistance != null) {
        distanceText = formatDistance(customDistance) || null;
    } else if (restaurant.distance != null) {
        distanceText = typeof restaurant.distance === 'number'
            ? restaurant.distance.toFixed(1) + ' km'
            : (String(restaurant.distance).trim() || null);
    }

    const metaParts = [ratingHtml];
    if (distanceText) {
        metaParts.push(distanceText);
    }
    const metaHtml = metaParts.join(' &bull; ');

    const isFav = (typeof isActiveFavorite === 'boolean') ? isActiveFavorite : isFavorite(restaurant.id);
    const favClass = isFav ? 'btn-favorite is-active' : 'btn-favorite';
    const favLabel = isFav ? `Remove ${restaurant.name} from favorites` : `Save ${restaurant.name} to favorites`;
    const favPressed = isFav ? 'true' : 'false';

    const cardImg = (restaurant.hero_image || restaurant.image) ? getAssetPath(restaurant.hero_image || restaurant.image) : '';
    const imgStyle = cardImg ? ` style="background-image: url('${cardImg}'); background-size: cover; background-position: center;"` : '';

    article.innerHTML = `<button type="button" class="${favClass}" aria-label="${favLabel}" aria-pressed="${favPressed}"><span aria-hidden="true">&hearts;</span></button>
      <a href="${href}" class="card-link-wrapper" aria-label="View ${restaurant.name}">
        <div class="restaurant-card-image" aria-hidden="true"${imgStyle}></div>
        <div class="restaurant-card-content">
          <h3 class="text-lead">${restaurant.name}</h3>
          <p class="text-small text-muted" style="margin-bottom: var(--space-1);">${restaurant.category}</p>
          <p class="text-meta text-muted">${metaHtml}</p>
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
    const linkBase = 'restaurant' + getPageExtension();
    restaurants.forEach(restaurant => {
        fragment.appendChild(createRestaurantCard(restaurant, linkBase));
    });

    // Clear only the injected comment placeholder — safe even if already empty
    grid.innerHTML = '';
    grid.appendChild(fragment);
}

// ==========================================
// Homepage Rail Rendering
// ==========================================

// ==========================================
// Phase 03 / Task 02: Geoapify Places API Integration
// ==========================================

const GEOAPIFY_API_KEY = (typeof window !== 'undefined' && (window.GEOAPIFY_API_KEY || (window.BITEMAP_CONFIG && window.BITEMAP_CONFIG.GEOAPIFY_API_KEY))) || 'YOUR_API_KEY';
const GEOAPIFY_PLACES_ENDPOINT = 'https://api.geoapify.com/v2/places';
const GEOAPIFY_AUTOCOMPLETE_ENDPOINT = 'https://api.geoapify.com/v1/geocode/autocomplete';
const GEOAPIFY_PLACE_DETAILS_ENDPOINT = 'https://api.geoapify.com/v2/place-details';

/**
 * Normalizes a Geoapify GeoJSON feature into a BiteMap discovery card object.
 * Maps available properties and applies graceful fallbacks for missing data.
 * @param {object} feature - GeoJSON feature from Geoapify Places API
 * @returns {object|null}
 */
function normalizeGeoapifyPlace(feature) {
    if (!feature || typeof feature !== 'object') return null;
    const props = feature.properties;
    if (!props || typeof props !== 'object') return null;

    // Feature must have at least a place name or address to be considered valid
    const name = props.name || props.address_line1;
    if (!name || typeof name !== 'string' || !name.trim()) return null;
    const cleanName = name.trim();

    const placeId = props.place_id ? `geo-${props.place_id}` : `geo-${Math.random().toString(36).slice(2, 9)}`;

    // Category detection from Geoapify hierarchical categories
    let category = 'Restaurant';
    let cuisine = null;
    const cats = Array.isArray(props.categories) ? props.categories : [];

    if (cats.some(c => c === 'catering.cafe' || c.startsWith('catering.cafe.'))) {
        category = 'Cafe & Coffee';
    } else if (cats.some(c => c === 'catering.fast_food' || c.startsWith('catering.fast_food.'))) {
        category = 'Fast Food';
    } else if (cats.some(c => c.includes('asian') || c.includes('noodle') || c.includes('japanese') || c.includes('chinese'))) {
        category = 'Asian Food';
    } else if (cats.some(c => c.includes('bakery') || c.includes('dessert'))) {
        category = 'Dessert & Bakery';
    } else if (cats.some(c => c === 'catering.restaurant' || c.startsWith('catering.restaurant.'))) {
        category = 'Restaurant';
    }

    const cuisineCat = cats.find(c => c.startsWith('catering.restaurant.') && c !== 'catering.restaurant');
    if (cuisineCat) {
        const raw = cuisineCat.replace('catering.restaurant.', '');
        cuisine = raw.charAt(0).toUpperCase() + raw.slice(1).replace(/_/g, ' ');
    }

    // Keyword fallback when categories array is empty or default
    if (category === 'Restaurant') {
        const lowerName = cleanName.toLowerCase();
        if (/ramen|sushi|udon|noodle|mie|bakmi|dimsum|bento|japanese|chinese|thai|korean/.test(lowerName)) {
            category = 'Asian Food';
            if (lowerName.includes('ramen') || lowerName.includes('sushi') || lowerName.includes('bento')) {
                cuisine = 'Japanese';
            }
        } else if (/kopi|coffee|cafe|kafe|espresso/.test(lowerName)) {
            category = 'Cafe & Coffee';
        } else if (/burger|pizza|fried chicken|fast food/.test(lowerName)) {
            category = 'Fast Food';
        } else if (/bakery|roti|cake|pastry|dessert|gelato|ice cream/.test(lowerName)) {
            category = 'Dessert & Bakery';
        }
    }

    // Distance conversion: distance < 1000m -> "350 m", >= 1000m -> "1.2 km"
    let distance = null;
    if (typeof props.distance === 'number' && !isNaN(props.distance)) {
        if (props.distance < 1000) {
            distance = `${Math.round(props.distance)} m`;
        } else {
            distance = `${(props.distance / 1000).toFixed(1)} km`;
        }
    }

    const location = props.formatted || props.address_line1 || props.city || 'Location unavailable';

    return {
        id: placeId,
        name: cleanName,
        category,
        cuisine,
        distance,
        rating: null, // OpenStreetMap does not provide review star ratings
        description: props.description || 'Description unavailable.',
        location,
        hours: props.opening_hours || null,
        gallery: [],
        menu: [],
        reservation_enabled: false,
        isExternal: true
    };
}

/**
 * Processes an array of Geoapify GeoJSON features, normalizes them,
 * and renders up to 5 discovery cards into the target rail.
 * @param {Array<object>} features - Array of GeoJSON features
 * @param {HTMLElement} rail - Container element (.content-rail)
 * @returns {number} Number of cards successfully rendered
 */
function renderGeoapifyPlaces(features, rail) {
    if (!rail || !Array.isArray(features)) return 0;
    const places = features
        .map(normalizeGeoapifyPlace)
        .filter(Boolean);

    if (places.length === 0) return 0;

    const fragment = document.createDocumentFragment();
    const linkBase = 'pages/restaurant' + getPageExtension();
    places.slice(0, 5).forEach(place => {
        fragment.appendChild(createRestaurantCard(place, linkBase));
    });

    rail.innerHTML = '';
    rail.appendChild(fragment);
    initFavorites(rail);
    return places.length;
}

/**
 * Controlled sample GeoJSON FeatureCollection used strictly for verifying
 * the normalization, DOM transformation, and rendering pipeline without
 * exposing or requiring a real API key.
 * Never added to BITEMAP_RESTAURANTS.
 */
const SAMPLE_GEOAPIFY_PLACES = {
    type: 'FeatureCollection',
    features: [
        {
            type: 'Feature',
            properties: {
                name: 'Kopi Nostalgia Menteng',
                formatted: 'Jl. HOS Cokroaminoto No. 42, Menteng, Jakarta Pusat',
                categories: ['catering', 'catering.cafe', 'catering.cafe.coffee'],
                distance: 350,
                place_id: 'sample-cafe-001'
            },
            geometry: {
                type: 'Point',
                coordinates: [106.8294, -6.1962]
            }
        },
        {
            type: 'Feature',
            properties: {
                name: 'Sinar Minang Nusantara',
                formatted: 'Jl. Sabang No. 18, Kebon Sirih, Jakarta Pusat',
                categories: ['catering', 'catering.restaurant', 'catering.restaurant.indonesian'],
                distance: 1200,
                place_id: 'sample-rest-002'
            },
            geometry: {
                type: 'Point',
                coordinates: [106.8251, -6.1865]
            }
        },
        {
            type: 'Feature',
            properties: {
                name: 'Tokyo Noodle Bar',
                formatted: 'Jl. Wahid Hasyim No. 84, Gondangdia, Jakarta Pusat',
                categories: ['catering', 'catering.restaurant', 'catering.restaurant.japanese', 'catering.restaurant.asian'],
                distance: 2450,
                place_id: 'sample-asian-003'
            },
            geometry: {
                type: 'Point',
                coordinates: [106.8335, -6.1887]
            }
        }
    ]
};

/**
 * Renders skeleton placeholder cards in the rail during asynchronous API loading.
 * @param {HTMLElement} rail
 * @param {number} [count=5]
 */
function renderRailLoading(rail, count = 5) {
    if (!rail) return;
    const fragment = document.createDocumentFragment();
    for (let i = 0; i < count; i++) {
        const skeleton = document.createElement('div');
        skeleton.className = 'restaurant-card animate-pulse';
        skeleton.setAttribute('aria-hidden', 'true');
        skeleton.innerHTML = `
            <div class="restaurant-card-image" style="background: rgba(36,33,29,0.06);"></div>
            <div class="restaurant-card-content">
                <div style="height: 1.25rem; background: rgba(36,33,29,0.08); border-radius: 4px; margin-bottom: 0.5rem; width: 75%;"></div>
                <div style="height: 0.875rem; background: rgba(36,33,29,0.05); border-radius: 4px; margin-bottom: 0.5rem; width: 50%;"></div>
                <div style="height: 0.75rem; background: rgba(36,33,29,0.04); border-radius: 4px; width: 65%;"></div>
            </div>
        `;
        fragment.appendChild(skeleton);
    }
    rail.innerHTML = '';
    rail.appendChild(fragment);
}

/**
 * Fallback renderer for "Popular Near You" rail.
 * Restores canonical BiteMap discovery cards if API fetch fails or is pending.
 * @param {HTMLElement} [rail]
 */
function renderCanonicalPopularRail(rail) {
    if (!rail) {
        const section = document.querySelector('[aria-labelledby="popular-heading"]');
        if (section) rail = section.querySelector('.content-rail');
    }
    if (!rail) return;

    const all = getRestaurants();
    const subset = [...all].sort((a, b) => b.rating - a.rating).slice(0, 5);
    const fragment = document.createDocumentFragment();
    const linkBase = 'pages/restaurant' + getPageExtension();
    subset.forEach(r => fragment.appendChild(createRestaurantCard(r, linkBase)));
    rail.innerHTML = '';
    rail.appendChild(fragment);
    initFavorites(rail);
}

/**
 * Fetches discovery places from Geoapify Places API for the "Popular Near You" rail.
 * Uses native fetch(), validates HTTP response status, parses GeoJSON FeatureCollection,
 * normalizes place features, and renders them into the rail.
 * Supports custom coordinates (e.g. from user geolocation) or defaults to Central Jakarta demo coords.
 * On error or unauthenticated placeholder key, falls back gracefully to canonical data.
 * @param {HTMLElement} rail
 * @param {{ lon?: number, lat?: number, longitude?: number, latitude?: number, radius?: number }|null} [coords=null]
 * @returns {Promise<number>} Number of places rendered
 */
async function fetchPopularNearYou(rail, coords = null) {
    if (!rail) return 0;

    // 1. Show loading skeleton cards while request is in flight
    renderRailLoading(rail);

    const isCustomCoords = !!(coords && (typeof coords.lon === 'number' || typeof coords.longitude === 'number') && (typeof coords.lat === 'number' || typeof coords.latitude === 'number'));
    const targetLon = isCustomCoords ? (coords.lon ?? coords.longitude) : 106.8456;
    const targetLat = isCustomCoords ? (coords.lat ?? coords.latitude) : -6.2088;
    const radius = coords && typeof coords.radius === 'number' ? coords.radius : 5000;

    const params = new URLSearchParams({
        categories: 'catering.restaurant,catering.cafe',
        filter: `circle:${targetLon},${targetLat},${radius}`,
        bias: `proximity:${targetLon},${targetLat}`,
        limit: '10',
        apiKey: GEOAPIFY_API_KEY
    });
    const url = `${GEOAPIFY_PLACES_ENDPOINT}?${params.toString()}`;

    const controller = typeof AbortController !== 'undefined' ? new AbortController() : null;
    const timeoutId = controller ? setTimeout(() => controller.abort(), 6000) : null;
    let isCommitted = false;

    try {
        const response = await fetch(url, controller ? { signal: controller.signal } : {});
        if (timeoutId) clearTimeout(timeoutId);

        if (!response.ok) {
            throw new Error(`Geoapify API responded with status ${response.status}`);
        }

        const data = await response.json();
        if (!data || typeof data !== 'object' || !Array.isArray(data.features) || data.features.length === 0) {
            if (isCustomCoords) {
                renderNearbyEmptyState(rail);
                isCommitted = true;
                return 0;
            }
            throw new Error('Invalid or empty GeoJSON FeatureCollection');
        }

        const count = renderGeoapifyPlaces(data.features, rail);
        if (count === 0) {
            if (isCustomCoords) {
                renderNearbyEmptyState(rail);
                isCommitted = true;
                return 0;
            }
            throw new Error('No valid places after normalization');
        }
        isCommitted = true;
        return count;
    } catch (error) {
        if (timeoutId) clearTimeout(timeoutId);
        if (!isCommitted) {
            // Graceful error fallback: restore canonical BiteMap discovery rail
            renderCanonicalPopularRail(rail);
            isCommitted = true;
        }
        throw error;
    }
}

// ==========================================
// Step C1 & C2: Location Autocomplete & Resolution
// ==========================================

let currentSelectedLocation = null;

/**
 * Defensive validator for selected location objects.
 * Verifies that coordinates are finite numbers within valid geographic ranges
 * (-90 <= lat <= 90, -180 <= lon <= 180), and that label or formatted address exists.
 * @param {object|null} loc
 * @returns {boolean}
 */
function isValidSelectedLocation(loc) {
    if (!loc || typeof loc !== 'object') return false;

    // Check latitude and longitude numeric finiteness
    const lat = loc.lat;
    const lon = loc.lon;
    if (typeof lat !== 'number' || typeof lon !== 'number' || !Number.isFinite(lat) || !Number.isFinite(lon)) {
        return false;
    }

    // Latitude must be between -90 and 90 degrees
    if (lat < -90 || lat > 90) return false;

    // Longitude must be between -180 and 180 degrees
    if (lon < -180 || lon > 180) return false;

    // Non-empty label or formatted string
    const label = (loc.label || loc.name || '').trim();
    const formatted = (loc.formatted || '').trim();
    if (!label && !formatted) return false;

    return true;
}

/**
 * Returns a shallow copy of the currently selected transient location state, or null.
 * Strictly transient in memory — never persisted in localStorage, sessionStorage, cookies, or indexedDB.
 * @returns {{ id: string, label: string, formatted: string, address_line1: string, address_line2: string, city: string, state: string, postcode: string, lat: number, lon: number, result_type: string, confidence: number|null }|null}
 */
function getSelectedLocation() {
    return currentSelectedLocation ? { ...currentSelectedLocation } : null;
}

/**
 * Normalizes and stores the transient selected location context in memory.
 * Strictly verifies coordinates via isValidSelectedLocation before accepting.
 * Rejects invalid coordinate records without mutating or corrupting active state.
 * @param {object|null} loc - Candidate location object
 * @returns {boolean} True if successfully stored or cleared, false if rejected
 */
function setSelectedLocation(loc) {
    if (!loc) {
        currentSelectedLocation = null;
        return true;
    }

    // Build canonical structured candidate
    const id = loc.id || (loc.place_id ? `loc-${loc.place_id}` : `loc-${Math.random().toString(36).slice(2, 9)}`);
    const label = (loc.label || loc.name || loc.address_line1 || loc.formatted || '').trim();
    const formatted = (loc.formatted || label).trim();
    const address_line1 = (loc.address_line1 || '').trim();
    const address_line2 = (loc.address_line2 || '').trim();
    const city = (loc.city || '').trim();
    const state = (loc.state || '').trim();
    const postcode = (loc.postcode || '').trim();
    const lat = (typeof loc.lat === 'number' && Number.isFinite(loc.lat)) ? loc.lat : null;
    const lon = (typeof loc.lon === 'number' && Number.isFinite(loc.lon)) ? loc.lon : null;
    const result_type = loc.result_type || 'unknown';
    const confidence = (typeof loc.confidence === 'number' && Number.isFinite(loc.confidence))
        ? loc.confidence
        : (loc.rank && typeof loc.rank.confidence === 'number' && Number.isFinite(loc.rank.confidence) ? loc.rank.confidence : null);

    const candidate = {
        id,
        label,
        formatted,
        address_line1,
        address_line2,
        city,
        state,
        postcode,
        lat,
        lon,
        result_type,
        confidence
    };

    if (!isValidSelectedLocation(candidate)) {
        // Defensive: reject invalid selection without corrupting existing state
        return false;
    }

    currentSelectedLocation = candidate;
    return true;
}

/**
 * Normalizes a raw Geoapify autocomplete result into a structured BiteMap location suggestion object.
 * Maps available properties and applies graceful fallbacks for missing data.
 * @param {object} item - Raw Geoapify autocomplete item
 * @returns {object|null}
 */
function normalizeGeoapifyAutocomplete(item) {
    if (!item || typeof item !== 'object') return null;
    const props = item.properties || item;

    const name = (props.name || props.address_line1 || props.formatted || '').trim();
    const formatted = (props.formatted || name).trim();
    if (!formatted && !name) return null;

    const id = props.place_id ? `loc-${props.place_id}` : `loc-${Math.random().toString(36).slice(2, 9)}`;

    let lat = null;
    let lon = null;
    if (typeof props.lat === 'number' && Number.isFinite(props.lat)) lat = props.lat;
    if (typeof props.lon === 'number' && Number.isFinite(props.lon)) lon = props.lon;
    if ((lat === null || lon === null) && item.geometry && Array.isArray(item.geometry.coordinates)) {
        if (typeof item.geometry.coordinates[0] === 'number' && Number.isFinite(item.geometry.coordinates[0])) {
            lon = item.geometry.coordinates[0];
        }
        if (typeof item.geometry.coordinates[1] === 'number' && Number.isFinite(item.geometry.coordinates[1])) {
            lat = item.geometry.coordinates[1];
        }
    }

    const confidence = (props.rank && typeof props.rank.confidence === 'number' && Number.isFinite(props.rank.confidence))
        ? props.rank.confidence
        : (typeof props.confidence === 'number' && Number.isFinite(props.confidence) ? props.confidence : null);

    return {
        id,
        name,
        label: name || formatted,
        formatted,
        address_line1: (props.address_line1 || '').trim(),
        address_line2: (props.address_line2 || '').trim(),
        city: (props.city || props.county || '').trim(),
        state: (props.state || '').trim(),
        postcode: (props.postcode || '').trim(),
        lat,
        lon,
        result_type: props.result_type || 'unknown',
        confidence
    };
}

/**
 * Queries Geoapify Address Autocomplete API for up to 5 location suggestions in Indonesia.
 * Debounced, cancellable via AbortSignal, and strictly transient.
 * @param {string} query - Location search text (minimum 2 chars)
 * @param {AbortSignal} [signal] - Optional abort signal
 * @returns {Promise<Array<object>>} Normalized suggestions
 */
async function fetchLocationAutocomplete(query, signal = null) {
    const cleanQuery = (query || '').trim();
    if (cleanQuery.length < 2) return [];

    const apiKey = (typeof window !== 'undefined' && window.GEOAPIFY_API_KEY) || GEOAPIFY_API_KEY;

    const params = new URLSearchParams({
        text: cleanQuery,
        format: 'json',
        limit: '5',
        filter: 'countrycode:id',
        lang: 'en',
        apiKey: apiKey
    });
    const url = `${GEOAPIFY_AUTOCOMPLETE_ENDPOINT}?${params.toString()}`;

    const response = await fetch(url, signal ? { signal } : {});
    if (!response.ok) {
        throw new Error(`Geoapify Autocomplete API responded with status ${response.status}`);
    }

    const data = await response.json();
    const rawItems = Array.isArray(data.results)
        ? data.results
        : (Array.isArray(data.features) ? data.features : []);

    return rawItems
        .map(normalizeGeoapifyAutocomplete)
        .filter(Boolean)
        .slice(0, 5);
}

/**
 * Initializes the debounced location autocomplete experience on .location-input elements
 * (#hero-location on homepage and #explore-location on explore page).
 * Manages 6 distinct states: Idle, Searching, Suggestions, Empty, Error, Selected.
 * Supports keyboard navigation (ArrowDown, ArrowUp, Enter, Escape) and click outside dismissal.
 */
function initLocationAutocomplete() {
    const inputs = document.querySelectorAll('.location-input, #hero-location, #explore-location');
    if (!inputs.length) return;

    inputs.forEach(input => {
        if (!input || input.dataset.autocompleteBound) return;
        input.dataset.autocompleteBound = 'true';

        // 1. Wrap input dynamically if not already wrapped
        let wrapper = input.parentElement;
        if (!wrapper || !wrapper.classList.contains('location-input-wrapper')) {
            wrapper = document.createElement('div');
            wrapper.className = 'location-input-wrapper relative flex-1 min-w-0';
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
            input.classList.remove('flex-1');
            input.classList.add('w-full');
        }

        // 2. Setup ARIA and autocomplete attributes on input
        const dropdownId = `${input.id || 'location'}-autocomplete-dropdown`;
        input.setAttribute('role', 'combobox');
        input.setAttribute('aria-autocomplete', 'list');
        input.setAttribute('aria-expanded', 'false');
        input.setAttribute('aria-haspopup', 'listbox');
        input.setAttribute('aria-controls', dropdownId);
        input.setAttribute('autocomplete', 'off');

        // 3. Create dropdown element
        let dropdown = wrapper.querySelector('.location-dropdown');
        if (!dropdown) {
            dropdown = document.createElement('ul');
            dropdown.className = 'location-dropdown hidden';
            dropdown.id = dropdownId;
            dropdown.setAttribute('role', 'listbox');
            dropdown.setAttribute('aria-label', 'Location suggestions');
            dropdown.style.display = 'none';
            wrapper.appendChild(dropdown);
        }

        let debounceTimer = null;
        let activeController = null;
        let currentSuggestions = [];
        let activeIndex = -1;

        function openDropdown() {
            dropdown.classList.remove('hidden');
            dropdown.style.display = 'block';
            input.setAttribute('aria-expanded', 'true');
        }

        function closeDropdown() {
            dropdown.classList.add('hidden');
            dropdown.style.display = 'none';
            input.setAttribute('aria-expanded', 'false');
            activeIndex = -1;
            input.removeAttribute('aria-activedescendant');
        }

        function renderLoading() {
            openDropdown();
            dropdown.innerHTML = `
                <li class="location-dropdown-status" role="status">
                    <span class="location-dropdown-spinner" aria-hidden="true">&#9687;</span>
                    <span>Searching locations...</span>
                </li>
            `;
        }

        function renderEmpty() {
            openDropdown();
            dropdown.innerHTML = `
                <li class="location-dropdown-status" role="status">
                    <span style="opacity: 0.5;" aria-hidden="true">&#128269;</span>
                    <span>No locations found.</span>
                </li>
            `;
        }

        function renderError(message) {
            openDropdown();
            dropdown.innerHTML = `
                <li class="location-dropdown-status is-error" role="alert">
                    <span aria-hidden="true">&#9888;</span>
                    <span>${message || 'Location search is temporarily unavailable.'}</span>
                </li>
            `;
        }

        function selectItem(item) {
            if (!item) return;
            const success = setSelectedLocation(item);
            if (!success) {
                renderError('Selected location has invalid coordinates.');
                return;
            }
            input.value = item.formatted || item.label || item.name;
            closeDropdown();
            // Dispatch native change event in case other listeners need to know
            input.dispatchEvent(new Event('change', { bubbles: true }));
        }

        function highlightOption(index) {
            const options = dropdown.querySelectorAll('.location-dropdown-item');
            options.forEach((opt, idx) => {
                if (idx === index) {
                    opt.classList.add('is-active');
                    opt.setAttribute('aria-selected', 'true');
                    input.setAttribute('aria-activedescendant', opt.id);
                    opt.scrollIntoView({ block: 'nearest' });
                } else {
                    opt.classList.remove('is-active');
                    opt.setAttribute('aria-selected', 'false');
                }
            });
        }

        function renderSuggestions(items) {
            currentSuggestions = items;
            activeIndex = -1;
            input.removeAttribute('aria-activedescendant');

            if (!items || items.length === 0) {
                renderEmpty();
                return;
            }

            openDropdown();
            dropdown.innerHTML = '';

            items.forEach((item, idx) => {
                const li = document.createElement('li');
                li.className = 'location-dropdown-item';
                li.id = `${dropdownId}-opt-${idx}`;
                li.setAttribute('role', 'option');
                li.setAttribute('aria-selected', 'false');

                const iconSpan = document.createElement('span');
                iconSpan.className = 'location-item-icon';
                iconSpan.setAttribute('aria-hidden', 'true');
                iconSpan.innerHTML = '&#128205;';

                const contentDiv = document.createElement('div');
                contentDiv.className = 'location-item-content';

                const titleSpan = document.createElement('span');
                titleSpan.className = 'location-item-title';
                titleSpan.textContent = item.name || item.formatted;
                contentDiv.appendChild(titleSpan);

                const subtitle = item.address_line2 || [item.city, item.state].filter(Boolean).join(', ');
                if (subtitle && subtitle !== item.name) {
                    const subSpan = document.createElement('span');
                    subSpan.className = 'location-item-subtitle';
                    subSpan.textContent = subtitle;
                    contentDiv.appendChild(subSpan);
                }

                li.appendChild(iconSpan);
                li.appendChild(contentDiv);

                li.addEventListener('mousedown', (e) => {
                    // Prevent blur before selection completes
                    e.preventDefault();
                    selectItem(item);
                });

                dropdown.appendChild(li);
            });
        }

        async function handleSearch(query) {
            const trimmed = (query || '').trim();
            if (trimmed.length < 2) {
                if (activeController) {
                    activeController.abort();
                    activeController = null;
                }
                currentSuggestions = [];
                closeDropdown();
                if (!trimmed) {
                    setSelectedLocation(null);
                }
                return;
            }

            if (activeController) {
                activeController.abort();
            }
            activeController = new AbortController();
            const signal = activeController.signal;

            renderLoading();

            try {
                const results = await fetchLocationAutocomplete(trimmed, signal);
                if (signal.aborted) return;
                renderSuggestions(results);
            } catch (err) {
                if (signal.aborted) return;
                renderError('Location search is temporarily unavailable.');
            } finally {
                if (activeController && activeController.signal === signal) {
                    activeController = null;
                }
            }
        }

        // Input event with 350ms debounce
        input.addEventListener('input', () => {
            // Check if user edited text away from the active selected location
            if (currentSelectedLocation) {
                const currentVal = input.value.trim();
                const selFormatted = (currentSelectedLocation.formatted || '').trim();
                const selLabel = (currentSelectedLocation.label || '').trim();
                if (currentVal !== selFormatted && currentVal !== selLabel) {
                    // Invalidate previous coordinate context immediately
                    setSelectedLocation(null);
                }
            }

            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                handleSearch(input.value);
            }, 350);
        });

        // Keydown keyboard navigation
        input.addEventListener('keydown', (e) => {
            const isDropdownOpen = dropdown.style.display !== 'none' && !dropdown.classList.contains('hidden');

            if (e.key === 'ArrowDown') {
                if (!isDropdownOpen && currentSuggestions.length > 0) {
                    e.preventDefault();
                    openDropdown();
                    activeIndex = 0;
                    highlightOption(activeIndex);
                } else if (isDropdownOpen && currentSuggestions.length > 0) {
                    e.preventDefault();
                    activeIndex = (activeIndex + 1) % currentSuggestions.length;
                    highlightOption(activeIndex);
                }
            } else if (e.key === 'ArrowUp') {
                if (isDropdownOpen && currentSuggestions.length > 0) {
                    e.preventDefault();
                    activeIndex = (activeIndex - 1 + currentSuggestions.length) % currentSuggestions.length;
                    highlightOption(activeIndex);
                }
            } else if (e.key === 'Enter') {
                if (isDropdownOpen && activeIndex >= 0 && activeIndex < currentSuggestions.length) {
                    e.preventDefault();
                    selectItem(currentSuggestions[activeIndex]);
                }
            } else if (e.key === 'Escape') {
                if (isDropdownOpen) {
                    e.preventDefault();
                    closeDropdown();
                }
            } else if (e.key === 'Tab') {
                closeDropdown();
            }
        });

        // Focus event: re-open if input has valid query & cached suggestions
        input.addEventListener('focus', () => {
            if (input.value.trim().length >= 2 && currentSuggestions.length > 0) {
                openDropdown();
            }
        });

        // Dismiss dropdown on outside clicks
        document.addEventListener('click', (e) => {
            if (!wrapper.contains(e.target)) {
                closeDropdown();
            }
        });
    });
}

// ==========================================
// Step C3: Live Search Query -> Geoapify Places
// ==========================================

const GEOAPIFY_GEOCODE_SEARCH_ENDPOINT = 'https://api.geoapify.com/v1/geocode/search';

/**
 * Searches external culinary places using Geoapify Places API.
 * Primary strategy: v2/places with catering categories filtered by circle (50km).
 * Secondary fallback: v1/geocode/search for dish/cuisine terms (e.g. "ramen", "martabak") across Indonesia.
 * Normalizes all valid features via normalizeGeoapifyPlace() with isExternal: true.
 * AbortController signals are supported for real-time request cancellation.
 * 
 * Supports location context: uses coordinates from selectedLocation if present;
 * otherwise gracefully falls back to default proximity coordinates (Central Jakarta demo baseline).
 * 
 * @param {string} query - Search term entered by user (min 2 chars)
 * @param {AbortSignal} [signal] - Optional abort signal
 * @param {object|null} [locationContext=null] - Optional location object with { lat, lon, label }
 * @returns {Promise<{ ok: boolean, query: string, places: Array<object>, count: number, error?: string, status: number, sourceEndpoint?: string, locationContext?: object|null, searchCenter?: { lon: number, lat: number } }>}
 */
async function fetchGeoapifyPlacesSearch(query, signal = null, locationContext = null) {
    const cleanQuery = (typeof query === 'string' ? query.trim() : '');
    if (cleanQuery.length < 2) {
        return { ok: true, query: cleanQuery, places: [], count: 0, status: 200, locationContext: null, searchCenter: null };
    }

    const apiKey = (typeof window !== 'undefined' && window.GEOAPIFY_API_KEY) || GEOAPIFY_API_KEY;
    if (!apiKey || apiKey === 'YOUR_API_KEY') {
        return { ok: false, query: cleanQuery, places: [], count: 0, error: 'API_KEY_UNAUTHENTICATED', status: 401, locationContext: null, searchCenter: null };
    }

    // Determine location context: explicit locationContext argument, or canonical getSelectedLocation()
    const loc = locationContext || (typeof getSelectedLocation === 'function' ? getSelectedLocation() : null);
    const hasValidLocation = isValidSelectedLocation(loc);

    // If valid selectedLocation exists, use its coordinates; otherwise fallback to C3 Central Jakarta demo baseline
    const targetLon = hasValidLocation ? loc.lon : 106.8456;
    const targetLat = hasValidLocation ? loc.lat : -6.2088;
    const radius = 50000;

    // 1. Primary endpoint: v2/places filtered by catering categories with target coordinates
    const placesParams = new URLSearchParams({
        categories: 'catering.restaurant,catering.cafe,catering.fast_food',
        name: cleanQuery,
        filter: `circle:${targetLon},${targetLat},${radius}`,
        bias: `proximity:${targetLon},${targetLat}`,
        limit: '12',
        apiKey: apiKey
    });
    const placesUrl = `${GEOAPIFY_PLACES_ENDPOINT}?${placesParams.toString()}`;

    try {
        const placesRes = await fetch(placesUrl, signal ? { signal } : {});
        if (!placesRes.ok) {
            return {
                ok: false,
                query: cleanQuery,
                places: [],
                count: 0,
                error: `HTTP_${placesRes.status}`,
                status: placesRes.status,
                locationContext: hasValidLocation ? { ...loc } : null,
                searchCenter: { lon: targetLon, lat: targetLat }
            };
        }

        const placesData = await placesRes.json();
        let features = Array.isArray(placesData.features) ? placesData.features : [];
        let sourceEndpoint = 'v2/places';

        // 2. Secondary fallback for dish or broad cuisine terms (e.g. "ramen") if v2/places returns 0 features
        if (features.length === 0) {
            const geocodeParams = new URLSearchParams({
                text: cleanQuery,
                filter: 'countrycode:id',
                bias: `proximity:${targetLon},${targetLat}`,
                limit: '12',
                apiKey: apiKey
            });
            const geocodeUrl = `${GEOAPIFY_GEOCODE_SEARCH_ENDPOINT}?${geocodeParams.toString()}`;
            const geocodeRes = await fetch(geocodeUrl, signal ? { signal } : {});
            if (!geocodeRes.ok) {
                return {
                    ok: false,
                    query: cleanQuery,
                    places: [],
                    count: 0,
                    error: `HTTP_${geocodeRes.status}`,
                    status: geocodeRes.status,
                    locationContext: hasValidLocation ? { ...loc } : null,
                    searchCenter: { lon: targetLon, lat: targetLat }
                };
            }
            const geocodeData = await geocodeRes.json();
            features = Array.isArray(geocodeData.features) ? geocodeData.features : [];
            sourceEndpoint = 'v1/geocode/search';
        }

        // 3. Normalize external features into BiteMap discovery card objects
        const places = features
            .map(normalizeGeoapifyPlace)
            .filter(Boolean);

        return {
            ok: true,
            query: cleanQuery,
            places,
            count: places.length,
            status: 200,
            sourceEndpoint,
            locationContext: hasValidLocation ? { ...loc } : null,
            searchCenter: { lon: targetLon, lat: targetLat }
        };
    } catch (err) {
        if (err.name === 'AbortError' || (signal && signal.aborted)) {
            throw err;
        }
        return {
            ok: false,
            query: cleanQuery,
            places: [],
            count: 0,
            error: err.message || 'NETWORK_ERROR',
            status: 0,
            locationContext: hasValidLocation ? { ...loc } : null,
            searchCenter: { lon: targetLon, lat: targetLat }
        };
    }
}

/**
 * Safely parses raw OpenStreetMap opening_hours string into BiteMap canonical hours format.
 * Maps standard day expressions (e.g. "Mo-Su 08:00-22:00") into day-keyed records.
 * Returns null if format is unparseable or empty.
 * @param {string} raw - Raw OSM opening_hours string
 * @returns {object|null}
 */
function parseOsmOpeningHours(raw) {
    if (!raw || typeof raw !== 'string') return null;
    const str = raw.trim();
    if (!str) return null;

    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const dayMap = {
        'mo': 'Monday', 'tu': 'Tuesday', 'we': 'Wednesday', 'th': 'Thursday',
        'fr': 'Friday', 'sa': 'Saturday', 'su': 'Sunday'
    };

    const result = {};

    if (str === '24/7') {
        days.forEach(d => { result[d] = '00:00 – 24:00'; });
        return result;
    }

    // Pattern like: "10:00-22:00"
    const simpleTime = str.match(/^(\d{1,2}:\d{2})\s*-\s*(\d{1,2}:\d{2})$/);
    if (simpleTime) {
        const formatted = `${simpleTime[1]} – ${simpleTime[2]}`;
        days.forEach(d => { result[d] = formatted; });
        return result;
    }

    // Split segments by semicolon
    const segments = str.split(';');
    let parsedAny = false;

    for (const seg of segments) {
        const trimmed = seg.trim();
        const match = trimmed.match(/([a-zA-Z,\s-]+)\s+(\d{1,2}:\d{2})\s*-\s*(\d{1,2}:\d{2})/i);
        if (match) {
            const dayPart = match[1].trim().toLowerCase();
            const timePart = `${match[2]} – ${match[3]}`;

            const rangeMatch = dayPart.match(/([a-z]{2})\s*-\s*([a-z]{2})/);
            if (rangeMatch) {
                const startDayKey = rangeMatch[1];
                const endDayKey = rangeMatch[2];
                const keys = ['mo', 'tu', 'we', 'th', 'fr', 'sa', 'su'];
                const sIdx = keys.indexOf(startDayKey);
                const eIdx = keys.indexOf(endDayKey);
                if (sIdx !== -1 && eIdx !== -1) {
                    for (let i = sIdx; i <= (eIdx >= sIdx ? eIdx : eIdx + 7); i++) {
                        const k = keys[i % 7];
                        result[dayMap[k]] = timePart;
                        parsedAny = true;
                    }
                }
            } else {
                const list = dayPart.split(',').map(s => s.trim().slice(0, 2));
                list.forEach(k => {
                    if (dayMap[k]) {
                        result[dayMap[k]] = timePart;
                        parsedAny = true;
                    }
                });
            }
        }
    }

    return parsedAny ? result : null;
}

/**
 * Normalizes a Geoapify Place Details GeoJSON feature into a safe BiteMap restaurant detail object.
 * Strictly adheres to verified API capability: never invents fake ratings, reviews, photos, or menus.
 *
 * @param {object} feature - GeoJSON feature from v2/place-details
 * @param {string} rawPlaceId - Raw Geoapify place identifier
 * @returns {object|null}
 */
function normalizeGeoapifyPlaceDetails(feature, rawPlaceId) {
    if (!feature || typeof feature !== 'object') return null;
    const props = feature.properties || {};

    const cleanName = (props.name || props.address_line1 || 'Restaurant').trim();
    const placeId = `geo-${rawPlaceId || props.place_id}`;

    // Category and cuisine detection
    const cats = Array.isArray(props.categories) ? props.categories : [];
    let category = 'Restaurant';
    let cuisine = null;

    if (cats.some(c => c.includes('cafe') || c.includes('coffee'))) {
        category = 'Cafe & Coffee';
    } else if (cats.some(c => c.includes('fast_food'))) {
        category = 'Fast Food';
    } else if (cats.some(c => c.includes('japanese') || c.includes('asian') || c.includes('chinese') || c.includes('korean') || c.includes('noodle'))) {
        category = 'Asian Food';
    } else if (cats.some(c => c.includes('bakery') || c.includes('dessert'))) {
        category = 'Dessert & Bakery';
    }

    // Cuisine detection from categories or catering object
    const cuisineCat = cats.find(c => c.startsWith('catering.restaurant.') && c !== 'catering.restaurant');
    if (cuisineCat) {
        const raw = cuisineCat.replace('catering.restaurant.', '');
        cuisine = raw.charAt(0).toUpperCase() + raw.slice(1).replace(/_/g, ' ');
    } else if (props.catering && props.catering.cuisine) {
        const raw = String(props.catering.cuisine);
        cuisine = raw.charAt(0).toUpperCase() + raw.slice(1).replace(/_/g, ' ');
    } else if (props.datasource?.raw?.cuisine) {
        const raw = String(props.datasource.raw.cuisine);
        cuisine = raw.charAt(0).toUpperCase() + raw.slice(1).replace(/_/g, ' ');
    }

    // Keyword fallback when category is still generic
    if (category === 'Restaurant') {
        const lowerName = cleanName.toLowerCase();
        if (/ramen|sushi|udon|noodle|mie|bakmi|dimsum|bento|japanese|chinese|thai|korean/.test(lowerName)) {
            category = 'Asian Food';
            if (lowerName.includes('ramen') || lowerName.includes('sushi') || lowerName.includes('bento')) {
                cuisine = cuisine || 'Japanese';
            }
        } else if (/kopi|coffee|cafe|kafe|espresso/.test(lowerName)) {
            category = 'Cafe & Coffee';
        } else if (/burger|pizza|fried chicken|fast food/.test(lowerName)) {
            category = 'Fast Food';
        } else if (/bakery|roti|cake|pastry|dessert|gelato|ice cream/.test(lowerName)) {
            category = 'Dessert & Bakery';
        }
    }

    // Description: only use if genuine text is provided
    const description = (props.description && typeof props.description === 'string' && props.description.trim())
        ? props.description.trim()
        : null;

    // Location / formatted address
    const location = props.formatted || props.address_line2 || [props.street, props.city, props.state, props.postcode].filter(Boolean).join(', ') || 'Location unavailable';

    // Coordinates
    const latitude = (typeof props.lat === 'number' && Number.isFinite(props.lat)) ? props.lat : (feature.geometry?.coordinates ? feature.geometry.coordinates[1] : null);
    const longitude = (typeof props.lon === 'number' && Number.isFinite(props.lon)) ? props.lon : (feature.geometry?.coordinates ? feature.geometry.coordinates[0] : null);

    // Distance if provided
    let distance = null;
    if (typeof props.distance === 'number' && !isNaN(props.distance)) {
        if (props.distance < 1000) {
            distance = `${Math.round(props.distance)} m`;
        } else {
            distance = `${(props.distance / 1000).toFixed(1)} km`;
        }
    }

    // Hours: parsed from OSM opening_hours string if available
    const hours = parseOsmOpeningHours(props.opening_hours);

    // Contact: website and phone
    const website = props.website || props.datasource?.raw?.website || null;
    const phone = props.phone || props.datasource?.raw?.phone || null;

    return {
        id: placeId,
        name: cleanName,
        category,
        cuisine,
        rating: null, // OpenStreetMap / Geoapify does not provide star review ratings
        description,
        location,
        latitude,
        longitude,
        distance,
        hours,
        website,
        phone,
        gallery: [], // No remote photos to avoid fake images; triggers existing warm placeholder
        menu: [], // OpenStreetMap has no restaurant menu data; triggers existing empty state
        reservation_enabled: false, // External places have no table reservation engine
        isExternal: true
    };
}

/**
 * Fetches verified external place details from Geoapify Place Details API (v2/place-details).
 * Supports request cancellation via AbortSignal.
 * Strictly avoids persisting data into storage or canonical arrays.
 *
 * @param {string} placeId - External place ID (e.g. "geo-..." or raw place ID)
 * @param {AbortSignal} [signal] - Optional abort signal
 * @returns {Promise<{ ok: boolean, status: number, restaurant: object|null, error?: string }>}
 */
async function fetchGeoapifyPlaceDetails(placeId, signal = null) {
    if (!placeId || typeof placeId !== 'string') {
        return { ok: false, status: 400, restaurant: null, error: 'INVALID_PLACE_ID' };
    }

    const rawPlaceId = placeId.startsWith('geo-') ? placeId.slice(4).trim() : placeId.trim();
    if (!rawPlaceId) {
        return { ok: false, status: 400, restaurant: null, error: 'INVALID_PLACE_ID' };
    }

    const apiKey = (typeof window !== 'undefined' && window.GEOAPIFY_API_KEY) || GEOAPIFY_API_KEY;
    if (!apiKey || apiKey === 'YOUR_API_KEY') {
        return { ok: false, status: 401, restaurant: null, error: 'API_KEY_UNAUTHENTICATED' };
    }

    const params = new URLSearchParams({
        id: rawPlaceId,
        apiKey: apiKey
    });
    const url = `${GEOAPIFY_PLACE_DETAILS_ENDPOINT}?${params.toString()}`;

    try {
        const res = await fetch(url, signal ? { signal } : {});
        if (!res.ok) {
            return {
                ok: false,
                status: res.status,
                restaurant: null,
                error: `HTTP_${res.status}`
            };
        }

        const data = await res.json();
        const features = Array.isArray(data.features) ? data.features : [];
        if (features.length === 0) {
            return {
                ok: false,
                status: 404,
                restaurant: null,
                error: 'PLACE_NOT_FOUND'
            };
        }

        const restaurant = normalizeGeoapifyPlaceDetails(features[0], rawPlaceId);
        return {
            ok: true,
            status: 200,
            restaurant
        };
    } catch (err) {
        if (err.name === 'AbortError' || (signal && signal.aborted)) {
            throw err;
        }
        return {
            ok: false,
            status: 0,
            restaurant: null,
            error: err.message || 'NETWORK_ERROR'
        };
    }
}

// Expose API test fixtures and processing methods safely for testing verification
if (typeof window !== 'undefined') {
    window.BiteMapApi = {
        normalizeGeoapifyPlace,
        renderGeoapifyPlaces,
        fetchPopularNearYou,
        initNearbyDiscovery,
        SAMPLE_GEOAPIFY_PLACES,
        // Step C1 & C2: Location Autocomplete Foundation & Selected Location Resolution
        normalizeGeoapifyAutocomplete,
        fetchLocationAutocomplete,
        initLocationAutocomplete,
        isValidSelectedLocation,
        getSelectedLocation,
        setSelectedLocation,
        // Step C3 & C4: External Places Search & Canonical Audit
        fetchGeoapifyPlacesSearch,
        getRestaurants,
        getRestaurantById,
        isFavorite,
        toggleFavorite,
        getFavoriteRestaurants,
        BITEMAP_RESTAURANTS,
        BITEMAP_FAVORITES,
        parseFavoritesString,
        refreshAllFavoriteButtons,
        initFavoritesCrossTabSync,
        renderDashboardFavoritesGrid,
        // Step C5: Place Details & External Detail Resolution
        parseOsmOpeningHours,
        normalizeGeoapifyPlaceDetails,
        fetchGeoapifyPlaceDetails,
        // Step C6 & C7: Geoapify Maps / Location Visualization & Lazy Loading
        isValidRestaurantCoordinate,
        initRestaurantMap,
        initLazyRestaurantMap,
        destroyRestaurantMap,
        getActiveRestaurantMap: () => activeRestaurantMap,
        getActiveLazyObserver: () => activeLazyObserver,
        getLazyMapStatus: () => lazyMapStatus
    };
}

/**
 * Renders up to 5 cards per homepage rail from BITEMAP_RESTAURANTS.
 * Each rail uses a derived subset — never a second hard-coded dataset.
 * linkBase uses pages/ prefix because index.html is at root level.
 */
function renderHomepageRails() {
    const all = getRestaurants();
    const MAX = 5;
    const linkBase = 'pages/restaurant' + getPageExtension();

    function fillRail(sectionId, filterFn, sortFn) {
        const section = document.querySelector('[aria-labelledby="' + sectionId + '"]');
        if (!section) return;
        const rail = section.querySelector('.content-rail');
        if (!rail) return;

        let subset = filterFn ? all.filter(filterFn) : [...all];
        if (sortFn) subset = subset.sort(sortFn);
        subset = subset.slice(0, MAX);

        rail.innerHTML = '';
        if (subset.length === 0) {
            const emptyEl = document.createElement('div');
            emptyEl.className = 'rail-empty-state w-full py-6 px-4 text-center bg-white/80 rounded-2xl border border-dark/10 flex flex-col items-center justify-center gap-1.5 shadow-sm';
            emptyEl.setAttribute('role', 'status');
            emptyEl.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-terracotta/10 text-terracotta flex items-center justify-center text-sm font-semibold mb-0.5" aria-hidden="true">&#10022;</div>
                <p class="text-sm font-semibold text-dark">Curating New Spots</p>
                <p class="text-xs text-dark/65 max-w-[320px]">We are hand-verifying dining spots and authentic menus in this category.</p>
            `;
            rail.appendChild(emptyEl);
            return;
        }

        const fragment = document.createDocumentFragment();
        subset.forEach(r => fragment.appendChild(createRestaurantCard(r, linkBase)));
        rail.appendChild(fragment);
        initFavorites(rail);
    }

    // Rail 1: "Featured in Malang" — renders canonical restaurants directly
    fillRail('popular-heading', null, null);

    // Rail 2: "Asian Dining & Specialties" — Okiru Ramen & Dialoogi Signature
    fillRail('cafe-heading', r => r.category === 'Asian Food' || r.category === 'Restaurant', null);

    // Rail 3: "Late Night & Quick Cravings" — Burger King
    fillRail('curated-heading', r => r.category === 'Fast Food', null);
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
 * Renders designed empty state when nearby discovery yields zero places.
 * @param {HTMLElement} rail
 */
function renderNearbyEmptyState(rail) {
    if (!rail) return;
    rail.innerHTML = `
        <div class="nearby-empty-state w-full text-center py-8 px-4 bg-white rounded-[20px] border border-dashed border-dark/15 flex flex-col items-center justify-center gap-2" role="status">
            <span class="text-2xl" aria-hidden="true">&#128269;</span>
            <p class="text-lead text-dark font-semibold">No nearby places found.</p>
            <p class="text-small text-muted text-dark/65 max-w-[360px]">We couldn't find restaurants or cafes within 5 km of your current location.</p>
            <a href="pages/explore.html" class="btn btn-outline inline-flex items-center justify-center gap-2 py-2 px-5 border-2 border-dark rounded-full text-xs font-semibold text-dark hover:bg-dark hover:text-white transition-colors duration-200 mt-2">Explore All Restaurants</a>
        </div>
    `;
}

/**
 * Initializes the frontend location-aware discovery experience for the "Popular Near You" section.
 * Manages geolocation permission via navigator.geolocation.getCurrentPosition, queries the
 * existing Geoapify Places API using real transient user coordinates, and updates the rail UI.
 * Never requests location automatically on page load. Never persists coordinates.
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
            statusEl.classList.remove('hidden');
            statusEl.style.display = 'block';
        } else {
            statusEl.textContent = '';
            statusEl.classList.add('hidden');
            statusEl.style.display = 'none';
        }
    }

    if (btnLocation.dataset.nearbyBound) return;
    btnLocation.dataset.nearbyBound = 'true';

    let isLocating = false;

    btnLocation.addEventListener('click', () => {
        // Prevent duplicate concurrent requests
        if (isLocating) return;
        isLocating = true;

        // 1. Immediate user feedback: disable button & show loading state
        btnLocation.disabled = true;
        btnLocation.setAttribute('aria-busy', 'true');
        btnLocation.innerHTML = '<span class="inline-block animate-spin" aria-hidden="true">&#9687;</span> Finding nearby places...';
        setStatus('Finding places near you...');
        renderRailLoading(rail);

        // 2. Check if Geolocation API is available in browser
        if (!navigator.geolocation) {
            isLocating = false;
            btnLocation.disabled = false;
            btnLocation.removeAttribute('aria-busy');
            btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Find near me';
            setStatus("Location isn't supported on this browser.");
            renderCanonicalPopularRail(rail);
            return;
        }

        // 3. Request browser location explicitly
        navigator.geolocation.getCurrentPosition(
            async (position) => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                // Coordinates are strictly transient — never persisted in storage or cookies
                try {
                    const count = await fetchPopularNearYou(rail, { lon: userLng, lat: userLat });
                    if (count > 0) {
                        if (subtitle) subtitle.textContent = 'Restaurants near your location.';
                        setStatus('Showing restaurants near your location.');
                        btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Location active';
                    } else {
                        if (subtitle) subtitle.textContent = 'No nearby places found.';
                        setStatus('No nearby places found within 5 km.');
                        btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Try again';
                    }
                } catch (apiError) {
                    // Handled gracefully: canonical fallback already rendered by fetchPopularNearYou
                    if (subtitle) subtitle.textContent = 'Restaurants people are loving right now.';
                    setStatus('Unable to load nearby places. Showing popular places instead.');
                    btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Find near me';
                } finally {
                    isLocating = false;
                    btnLocation.disabled = false;
                    btnLocation.removeAttribute('aria-busy');
                }
            },
            (err) => {
                isLocating = false;
                btnLocation.disabled = false;
                btnLocation.removeAttribute('aria-busy');
                btnLocation.innerHTML = '<span aria-hidden="true">&#9678;</span> Find near me';

                if (err && err.code === 1) {
                    // PERMISSION_DENIED
                    setStatus('Location access was denied. Explore restaurants by area instead.');
                } else if (err && err.code === 2) {
                    // POSITION_UNAVAILABLE
                    setStatus("We couldn't determine your location. Showing popular places instead.");
                } else if (err && err.code === 3) {
                    // TIMEOUT
                    setStatus('Finding your location took too long. Showing popular places instead.');
                } else {
                    setStatus('Unable to find your location. Showing popular places instead.');
                }

                // Preserve or restore popular rail content
                if (!rail.children.length || rail.querySelector('.animate-pulse')) {
                    renderCanonicalPopularRail(rail);
                }
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 30000
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
        const heroLoc = $('#hero-location');
        const loc = heroLoc ? heroLoc.value.trim() : 'Malang';
        const params = new URLSearchParams();
        if (query) params.set('q', query);
        if (loc) params.set('loc', loc);
        const qs = params.toString();
        const exploreUrl = 'pages/explore' + getPageExtension();
        window.location.href = qs ? exploreUrl + '?' + qs : exploreUrl;
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
    const openNow = Boolean(options.openNow);
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

        // 7. Open Now Filter: matches verified operating hours
        if (openNow) {
            if (!isRestaurantOpenNow(r)) {
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
    const emptyState = $('.empty-state', mainContent);
    const resultsCountEl = $('#results-count', mainContent) || $('.restaurant-results .text-meta', mainContent);
    const loadMoreContainer = $('.load-more-container', mainContent);
    const btnResetFilters = $('#btn-reset-filters', mainContent);
    const btnClearFilters = $('#btn-clear-filters', mainContent);
    const locationInput = $('#explore-location', mainContent) || $('#explore-location');
    const btnFilterOpenNow = $('.filter-btn-open-now', mainContent);

    const PAGE_SIZE = 12;
    let currentLimit = PAGE_SIZE;

    const btnLoadMore = loadMoreContainer ? loadMoreContainer.querySelector('button') : null;
    if (btnLoadMore && !btnLoadMore.dataset.loadMoreBound) {
        btnLoadMore.dataset.loadMoreBound = 'true';
        btnLoadMore.addEventListener('click', (e) => {
            e.preventDefault();
            currentLimit += PAGE_SIZE;
            performCanonicalFilters(true);
        });
    }

    // Map DOM cards by restaurant ID for non-destructive DOM toggling & reordering
    const cardMap = new Map();
    function indexCanonicalCards() {
        cardMap.clear();
        const cards = $$('.restaurant-card', restaurantGrid);
        cards.forEach(card => {
            const id = card.dataset.id || (card.querySelector('a')?.href.match(/id=([^&]+)/) || [])[1];
            if (id) {
                cardMap.set(id, card);
            }
        });
    }
    indexCanonicalCards();

    function restoreCanonicalGrid() {
        if (!restaurantGrid) return;
        renderRestaurantCards(getRestaurants(), restaurantGrid);
        indexCanonicalCards();
        initFavorites(restaurantGrid);
    }

    let debounceTimer = null;
    const urlParams = new URLSearchParams(window.location.search);
    const initialQuery = urlParams.get('q');
    const initialCategory = urlParams.get('category');
    const initialLoc = urlParams.get('loc');
    
    let currentCategory = '';

    if (searchInput && initialQuery) {
        searchInput.value = initialQuery;
    }

    if (locationInput) {
        locationInput.value = initialLoc || 'Malang';
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

    function performCanonicalFilters(isLoadMore = false) {
        if (!isLoadMore) {
            currentLimit = PAGE_SIZE;
        }

        const queryText = searchInput ? searchInput.value.trim() : '';

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
        const isOpenNow = Boolean(btnFilterOpenNow && btnFilterOpenNow.classList.contains('is-active'));

        // Filter and sort canonical dataset
        const allRestaurants = getRestaurants();
        const filtered = filterRestaurants(allRestaurants, {
            query: queryText,
            chipCategory: currentCategory,
            selectCategory,
            selectCuisine,
            minRating,
            maxDistance,
            openNow: isOpenNow,
            sort: sortVal
        });

        const pagedResults = filtered.slice(0, currentLimit);
        const pagedIds = new Set(pagedResults.map(r => r.id));
        let visibleCount = 0;

        // Ensure canonical cards are indexed
        const currentCards = $$('.restaurant-card', restaurantGrid);
        if (cardMap.size !== currentCards.length) {
            indexCanonicalCards();
        }

        // Toggle card visibility in DOM
        currentCards.forEach(card => {
            const id = card.dataset.id || (card.querySelector('a')?.href.match(/id=([^&]+)/) || [])[1];
            if (pagedIds.has(id)) {
                card.hidden = false;
                card.style.display = '';
                visibleCount++;
            } else {
                card.hidden = true;
                card.style.display = 'none';
            }
        });

        // Reorder visible DOM cards to reflect sorted order
        if (restaurantGrid) {
            pagedResults.forEach(r => {
                const card = cardMap.get(r.id);
                if (card) {
                    restaurantGrid.appendChild(card);
                }
            });
            // Keep hidden cards in grid for subsequent filter passes
            currentCards.forEach(card => {
                if (card.hidden) {
                    restaurantGrid.appendChild(card);
                }
            });
        }

        // Determine if any non-default filter is currently active
        const hasActiveFilters = Boolean(
            queryText ||
            currentCategory ||
            selectCategory ||
            selectCuisine ||
            minRating > 0 ||
            maxDistance < 999 ||
            isOpenNow ||
            sortVal !== 'Recommended'
        );

        // Update Result Count text: dynamic ("1 restaurant", "0 restaurants", or "N restaurants")
        const totalMatches = filtered.length;
        if (resultsCountEl) {
            if (totalMatches === 1) {
                resultsCountEl.textContent = '1 restaurant';
            } else if (totalMatches === 0) {
                resultsCountEl.textContent = '0 restaurants';
            } else {
                resultsCountEl.textContent = `${totalMatches} restaurants`;
            }
        }

        // Empty State handling
        if (emptyState) {
            if (totalMatches === 0) {
                emptyState.style.display = 'flex';
                emptyState.classList.remove('hidden');
                emptyState.removeAttribute('aria-hidden');
            } else {
                emptyState.style.display = 'none';
                emptyState.classList.add('hidden');
                emptyState.setAttribute('aria-hidden', 'true');
            }
        }

        // Load More handling: only visible when more results exist than currently displayed
        const hasMore = totalMatches > visibleCount;
        if (loadMoreContainer) {
            if (hasMore && visibleCount > 0) {
                loadMoreContainer.style.display = 'flex';
                loadMoreContainer.classList.remove('hidden');
                loadMoreContainer.removeAttribute('aria-hidden');
            } else {
                loadMoreContainer.style.display = 'none';
                loadMoreContainer.classList.add('hidden');
                loadMoreContainer.setAttribute('aria-hidden', 'true');
            }
        }

        // Clear Filters button in filter bar
        if (btnClearFilters) {
            if (hasActiveFilters) {
                btnClearFilters.style.display = 'inline-flex';
                btnClearFilters.classList.remove('hidden');
                btnClearFilters.removeAttribute('aria-hidden');
            } else {
                btnClearFilters.style.display = 'none';
                btnClearFilters.classList.add('hidden');
                btnClearFilters.setAttribute('aria-hidden', 'true');
            }
        }
        
        // URL synchronization (without reload)
        const newUrl = new URL(window.location);
        if (queryText) {
            newUrl.searchParams.set('q', queryText);
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
        currentLimit = PAGE_SIZE;
        if (debounceTimer) clearTimeout(debounceTimer);
        if (searchInput) searchInput.value = '';
        if (locationInput) locationInput.value = 'Malang';
        if (typeof setSelectedLocation === 'function') {
            setSelectedLocation(null);
        }
        currentCategory = '';
        updateCategoryUI();
        if (btnFilterOpenNow) {
            btnFilterOpenNow.classList.remove('is-active');
            btnFilterOpenNow.setAttribute('aria-pressed', 'false');
        }
        if (filterCatSelect) filterCatSelect.selectedIndex = 0;
        if (filterCuiSelect) filterCuiSelect.selectedIndex = 0;
        if (filterDistSelect) filterDistSelect.selectedIndex = 0;
        if (filterRatSelect) filterRatSelect.selectedIndex = 0;
        if (sortSelect) sortSelect.selectedIndex = 0;

        restoreCanonicalGrid();
        performCanonicalFilters();
    }

    // Attach interaction listeners
    if (btnFilterOpenNow && !btnFilterOpenNow.dataset.openNowBound) {
        btnFilterOpenNow.dataset.openNowBound = 'true';
        btnFilterOpenNow.addEventListener('click', (e) => {
            e.preventDefault();
            const wasActive = btnFilterOpenNow.classList.contains('is-active');
            if (wasActive) {
                btnFilterOpenNow.classList.remove('is-active');
                btnFilterOpenNow.setAttribute('aria-pressed', 'false');
            } else {
                btnFilterOpenNow.classList.add('is-active');
                btnFilterOpenNow.setAttribute('aria-pressed', 'true');
            }
            performCanonicalFilters();
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            if (debounceTimer) clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                performCanonicalFilters();
            }, 250);
        });

        const form = searchInput.closest('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                if (debounceTimer) clearTimeout(debounceTimer);
                performCanonicalFilters();
            });
        }
    }

    if (locationInput) {
        locationInput.addEventListener('change', () => {
            performCanonicalFilters();
        });
    }

    const nativeControls = [filterCatSelect, filterCuiSelect, filterDistSelect, filterRatSelect, sortSelect];
    nativeControls.forEach(control => {
        if (control) {
            control.addEventListener('change', () => {
                performCanonicalFilters();
            });
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
            performCanonicalFilters();
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
    performCanonicalFilters();
}

// ==========================================
// Favorites
// ==========================================

function initFavorites(container = document) {
    initFavoritesCrossTabSync();
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

/**
 * Refreshes all favorite buttons across the document to match current BITEMAP_FAVORITES.
 * Synchronizes ARIA pressed attributes, accessible labels, button text, and active styling.
 * @param {Document|HTMLElement} [container=document]
 */
function refreshAllFavoriteButtons(container = document) {
    if (!container || typeof container.querySelectorAll !== 'function') return;
    const favButtons = $$('button[aria-label*="favorites"], [data-detail="save-btn"], .btn-favorite', container);
    favButtons.forEach(btn => {
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
        if (restaurantId) {
            syncFavoriteButton(btn, restaurantId);
        }
    });
}

/**
 * Initializes reactive cross-tab synchronization for favorites using the native storage event.
 * Listens for external changes to 'bitemap_favorites' from other tabs, validates canonical IDs,
 * updates BITEMAP_FAVORITES, and re-renders affected UI components in real time.
 */
function initFavoritesCrossTabSync() {
    if (typeof window === 'undefined' || !window.addEventListener) return;
    if (window._bitemapFavSyncBound) return;
    window._bitemapFavSyncBound = true;

    window.addEventListener('storage', (event) => {
        // Only react to changes on our key or full storage clear (key === null)
        if (event.key !== FAVORITES_STORAGE_KEY && event.key !== null) return;
        if (event.storageArea && event.storageArea !== window.localStorage) return;

        // Key removed or storage cleared
        if (event.newValue === null || event.newValue === '') {
            BITEMAP_FAVORITES.clear();
        } else {
            const validIds = parseFavoritesString(event.newValue);
            BITEMAP_FAVORITES.clear();
            validIds.forEach(id => BITEMAP_FAVORITES.add(id));
        }

        // 1. Synchronize all favorite buttons on current page (cards & detail page)
        refreshAllFavoriteButtons();

        // 2. If on dashboard, re-render favorites grid and toggle empty states
        renderDashboardFavoritesGrid();
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
        fig.className = 'gallery-image-wrapper overflow-hidden relative cursor-pointer';
        fig.setAttribute('aria-label', item.alt || 'Gallery photo');
        fig.setAttribute('tabindex', '0');
        fig.setAttribute('role', 'button');

        const imgSrc = item && (item.src || item.image || item.url);
        if (imgSrc) {
            var img = document.createElement('img');
            img.src = getAssetPath(imgSrc);
            img.alt = item.alt || 'Gallery photo';
            img.className = 'w-full h-full object-cover transition-transform duration-300 hover:scale-105';
            img.loading = 'lazy';
            fig.appendChild(img);
        }

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
    const menuCategoryNav = document.querySelector('[data-detail="menu-category-nav"]');
    const menuCategoryPills = document.querySelector('[data-detail="menu-category-pills"]');
    const externalCta = document.querySelector('[data-detail="menu-external-cta"]');
    const externalLink = document.querySelector('[data-detail="menu-external-link"]');

    function syncExternalMenuCTA() {
        if (!externalCta || !externalLink) return;
        if (restaurant && restaurant.external_menu_url) {
            externalLink.href = restaurant.external_menu_url;
            externalCta.style.display = 'block';
            externalCta.removeAttribute('aria-hidden');
        } else {
            externalLink.removeAttribute('href');
            externalCta.style.display = 'none';
            externalCta.setAttribute('aria-hidden', 'true');
        }
    }

    function hideCategoryNav() {
        if (menuCategoryPills) menuCategoryPills.innerHTML = '';
        if (menuCategoryNav) {
            menuCategoryNav.style.display = 'none';
            menuCategoryNav.setAttribute('aria-hidden', 'true');
        }
    }

    function getConciseCategoryLabel(categoryName) {
        return String(categoryName || '').replace(/\s*\([^)]*\)\s*$/, '').trim();
    }

    if (!menuContainer) return;

    const categories = getRestaurantMenu(restaurant);

    if (categories.length === 0) {
        menuContainer.innerHTML = '';
        menuContainer.setAttribute('aria-hidden', 'true');
        hideCategoryNav();
        if (menuEmpty) {
            menuEmpty.style.display = 'block';
            menuEmpty.removeAttribute('aria-hidden');
        }
        syncExternalMenuCTA();
        return;
    }

    const fragment = document.createDocumentFragment();
    const pillsFragment = document.createDocumentFragment();
    let validCategoryIndex = 0;

    categories.forEach(function(cat) {
        if (!cat || !cat.items || cat.items.length === 0) return;

        const section = document.createElement('div');
        section.className = 'menu-section';
        const sectionId = cat.id || ('menu-' + cat.category.toLowerCase().replace(/[^a-z0-9]+/g, '-'));
        const headingId = sectionId + '-title';
        section.id = sectionId;
        section.setAttribute('aria-labelledby', headingId);

        if (sectionId === 'menu-upgrade-addon') {
            section.classList.add('menu-section--addon');
            const badge = document.createElement('span');
            badge.className = 'menu-section-badge menu-section-badge--addon';
            badge.textContent = 'ADD-ONS & TOPPINGS';
            section.appendChild(badge);
        } else if (sectionId === 'menu-promo') {
            section.classList.add('menu-section--promo');
            const badge = document.createElement('span');
            badge.className = 'menu-section-badge menu-section-badge--promo';
            badge.textContent = 'SPECIAL PROMO';
            section.appendChild(badge);
        }

        const h3 = document.createElement('h3');
        h3.id = headingId;
        h3.className = 'menu-section-title';
        h3.textContent = cat.category;
        section.appendChild(h3);

        // Build category quick-navigation pill
        if (menuCategoryPills) {
            const pillLi = document.createElement('li');
            pillLi.className = 'menu-category-pill-item';
            const pillLink = document.createElement('a');
            pillLink.className = 'menu-category-pill';
            if (sectionId === 'menu-upgrade-addon') {
                pillLink.classList.add('menu-category-pill--addon');
            } else if (sectionId === 'menu-promo') {
                pillLink.classList.add('menu-category-pill--promo');
            }
            if (validCategoryIndex === 0) {
                pillLink.classList.add('is-active');
                pillLink.setAttribute('aria-current', 'location');
            }
            pillLink.href = '#' + sectionId;
            pillLink.setAttribute('data-target-id', sectionId);
            const conciseLabel = getConciseCategoryLabel(cat.category);
            pillLink.textContent = conciseLabel;
            if (conciseLabel !== cat.category) {
                pillLink.setAttribute('title', cat.category);
            }
            pillLi.appendChild(pillLink);
            pillsFragment.appendChild(pillLi);
        }
        validCategoryIndex++;

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
                const priceStr = String(item.price);
                const priceMatch = priceStr.match(/^(.*?)\s*(\([^)]+\))$/);
                if (priceMatch && priceMatch[1] && priceMatch[2]) {
                    const mainSpan = document.createElement('span');
                    mainSpan.className = 'menu-item-price-main';
                    mainSpan.textContent = priceMatch[1];
                    const noteSpan = document.createElement('span');
                    noteSpan.className = 'menu-item-price-note';
                    noteSpan.textContent = priceMatch[2];
                    priceDiv.appendChild(mainSpan);
                    priceDiv.appendChild(document.createTextNode(' '));
                    priceDiv.appendChild(noteSpan);
                } else {
                    priceDiv.textContent = priceStr;
                }
                itemDiv.appendChild(priceDiv);
            }

            section.appendChild(itemDiv);
        });

        fragment.appendChild(section);
    });

    if (fragment.children.length === 0) {
        menuContainer.innerHTML = '';
        menuContainer.setAttribute('aria-hidden', 'true');
        hideCategoryNav();
        if (menuEmpty) {
            menuEmpty.style.display = 'block';
            menuEmpty.removeAttribute('aria-hidden');
        }
        syncExternalMenuCTA();
        return;
    }

    menuContainer.innerHTML = '';
    menuContainer.removeAttribute('aria-hidden');
    menuContainer.appendChild(fragment);

    if (menuCategoryNav && menuCategoryPills) {
        menuCategoryPills.innerHTML = '';
        menuCategoryPills.appendChild(pillsFragment);
        menuCategoryNav.style.display = 'block';
        menuCategoryNav.removeAttribute('aria-hidden');

        if (!menuCategoryPills.dataset.navBound) {
            menuCategoryPills.dataset.navBound = 'true';

            menuCategoryPills.addEventListener('click', function(e) {
                const link = e.target.closest('.menu-category-pill');
                if (!link) return;
                const allPills = menuCategoryPills.querySelectorAll('.menu-category-pill');
                allPills.forEach(function(p) {
                    p.classList.remove('is-active');
                    p.removeAttribute('aria-current');
                });
                link.classList.add('is-active');
                link.setAttribute('aria-current', 'location');
            });

            menuCategoryPills.addEventListener('keydown', function(e) {
                const link = e.target.closest('.menu-category-pill');
                if (!link) return;
                const pills = Array.from(menuCategoryPills.querySelectorAll('.menu-category-pill'));
                const idx = pills.indexOf(link);
                if (idx === -1) return;

                let nextIdx = -1;
                if (e.key === 'ArrowRight') {
                    nextIdx = (idx + 1) % pills.length;
                } else if (e.key === 'ArrowLeft') {
                    nextIdx = (idx - 1 + pills.length) % pills.length;
                } else if (e.key === 'Home') {
                    nextIdx = 0;
                } else if (e.key === 'End') {
                    nextIdx = pills.length - 1;
                }

                if (nextIdx !== -1) {
                    e.preventDefault();
                    pills[nextIdx].focus();
                }
            });
        }
    }

    if (menuEmpty) {
        menuEmpty.style.display = 'none';
        menuEmpty.setAttribute('aria-hidden', 'true');
    }

    syncExternalMenuCTA();
}

// ==========================================
// Dynamic Restaurant Location & Hours Rendering
// ==========================================

// ==========================================
// Geoapify Maps / Location Visualization (Step C6 & C7)
// ==========================================

let activeRestaurantMap = null;
let activeLazyObserver = null;
let lazyMapStatus = 'idle'; // 'idle' | 'observing' | 'initializing' | 'initialized' | 'failed' | 'destroyed'

/**
 * Escapes HTML characters for safe Leaflet popup rendering.
 * @param {string} str
 * @returns {string}
 */
function escapeMapHtml(str) {
    if (!str || typeof str !== 'string') return '';
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

/**
 * Validates restaurant latitude and longitude coordinates.
 * @param {number} lat - Latitude
 * @param {number} lon - Longitude
 * @returns {boolean} True if coordinates are valid finite numbers within bounds
 */
function isValidRestaurantCoordinate(lat, lon) {
    return typeof lat === 'number' && typeof lon === 'number' &&
           Number.isFinite(lat) && Number.isFinite(lon) &&
           lat >= -90 && lat <= 90 &&
           lon >= -180 && lon <= 180;
}

/**
 * Cleanly destroys any active restaurant map instance, disconnects lazy observer,
 * and resets the DOM container.
 * @param {HTMLElement|string} [container] - Map container element or selector
 */
function destroyRestaurantMap(container) {
    if (activeLazyObserver) {
        try {
            activeLazyObserver.disconnect();
        } catch (_) {}
        activeLazyObserver = null;
    }
    if (activeRestaurantMap) {
        if (activeRestaurantMap.resizeObserver) {
            try {
                activeRestaurantMap.resizeObserver.disconnect();
            } catch (_) {}
        }
        if (activeRestaurantMap.map) {
            try {
                activeRestaurantMap.map.remove();
            } catch (_) {}
        }
        activeRestaurantMap = null;
    }
    lazyMapStatus = 'idle';
    const el = typeof container === 'string' ? document.querySelector(container) : (container || document.querySelector('[data-detail="location-map"]'));
    if (el) {
        try {
            delete el._leaflet_id;
        } catch (_) {}
        el.innerHTML = '<span class="text-muted text-dark/65">Map Placeholder</span>';
    }
}

/**
 * Initializes an interactive Leaflet map using Geoapify raster tiles
 * centered at the given restaurant coordinates with a single marker.
 *
 * @param {object} options
 * @param {HTMLElement|string} options.container - Container element or CSS selector
 * @param {number} options.latitude - Valid latitude
 * @param {number} options.longitude - Valid longitude
 * @param {string} [options.name] - Restaurant name for popup / accessibility
 * @param {string} [options.address] - Restaurant formatted address
 * @returns {object|null} Map state object or null if initialization failed
 */
function initRestaurantMap({ container, latitude, longitude, name, address } = {}) {
    const el = typeof container === 'string' ? document.querySelector(container) : container;
    if (!el) return null;

    // 1. Validate coordinates
    if (!isValidRestaurantCoordinate(latitude, longitude)) {
        destroyRestaurantMap(el);
        return null;
    }

    // 2. Clean up any previous map instance to prevent leaks and duplicate initialization errors
    destroyRestaurantMap(el);

    // 3. Check Leaflet library availability
    if (typeof L === 'undefined') {
        lazyMapStatus = 'failed';
        el.innerHTML = '<div class="map-fallback flex flex-col items-center justify-center h-full p-4 text-center"><p class="text-dark/65 text-sm">Map unavailable.</p></div>';
        return null;
    }

    // 4. Check API Key
    const apiKey = (typeof window !== 'undefined' && (window.GEOAPIFY_API_KEY || (window.BITEMAP_CONFIG && window.BITEMAP_CONFIG.GEOAPIFY_API_KEY))) || GEOAPIFY_API_KEY;
    if (!apiKey || apiKey === 'YOUR_API_KEY') {
        lazyMapStatus = 'failed';
        el.innerHTML = '<div class="map-fallback flex flex-col items-center justify-center h-full p-4 text-center"><p class="text-dark/65 text-sm">Map unavailable (API key required).</p></div>';
        return null;
    }

    // 5. Clear container contents
    el.innerHTML = '';
    el.removeAttribute('aria-hidden');

    try {
        lazyMapStatus = 'initializing';

        // Create Leaflet map instance
        const map = L.map(el, {
            center: [latitude, longitude],
            zoom: 16,
            scrollWheelZoom: false,
            zoomControl: true,
            attributionControl: true
        });

        // Geoapify raster tile layer (osm-bright-smooth style)
        const tileUrl = `https://maps.geoapify.com/v1/tile/osm-bright-smooth/{z}/{x}/{y}.png?apiKey=${apiKey}`;
        const tileLayer = L.tileLayer(tileUrl, {
            maxZoom: 19,
            attribution: 'Powered by <a href="https://www.geoapify.com/" target="_blank" rel="noopener noreferrer">Geoapify</a> | &copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener noreferrer">OpenStreetMap</a> contributors'
        });
        tileLayer.addTo(map);

        tileLayer.on('tileerror', function() {
            // Subtle fallback: if tile fails to load, map container still shows center
        });

        // Terracotta branded SVG pin icon (#C85C3A)
        const pinSvg = `
          <svg width="32" height="42" viewBox="0 0 32 42" fill="none" xmlns="http://www.w3.org/2000/svg" style="filter: drop-shadow(0 2px 4px rgba(36,21,17,0.35));">
            <path d="M16 0C7.16344 0 0 7.16344 0 16C0 27.5 16 42 16 42C16 42 32 27.5 32 16C32 7.16344 24.8366 0 16 0Z" fill="#C85C3A"/>
            <circle cx="16" cy="15" r="6" fill="#F7F3EA"/>
          </svg>`;
        const pinIcon = L.divIcon({
            className: 'bitemap-marker-icon',
            html: pinSvg,
            iconSize: [32, 42],
            iconAnchor: [16, 42],
            popupAnchor: [0, -42]
        });

        const marker = L.marker([latitude, longitude], { icon: pinIcon, alt: name || 'Restaurant marker' }).addTo(map);

        if (name || address) {
            const safeName = name ? escapeMapHtml(name) : '';
            const safeAddress = address ? escapeMapHtml(address) : '';
            const popupTitle = safeName ? `<strong class="text-dark font-semibold text-sm block mb-1">${safeName}</strong>` : '';
            const popupAddress = safeAddress ? `<p class="text-dark/75 text-xs m-0 leading-relaxed">${safeAddress}</p>` : '';
            marker.bindPopup(`<div class="bitemap-map-popup p-1 font-sans">${popupTitle}${popupAddress}</div>`);
        }

        // Responsive resize observer to automatically adjust tile layout
        let resizeObserver = null;
        if (typeof ResizeObserver !== 'undefined') {
            resizeObserver = new ResizeObserver(() => {
                map.invalidateSize({ pan: false });
            });
            resizeObserver.observe(el);
        }

        // Invalidate size once rendered into layout and ensure center stays exact
        setTimeout(() => {
            try {
                map.invalidateSize({ pan: false });
                map.setView([latitude, longitude], 16, { animate: false });
            } catch (_) {}
        }, 150);

        activeRestaurantMap = {
            map,
            marker,
            tileLayer,
            resizeObserver,
            container: el,
            latitude,
            longitude,
            name: name || null,
            address: address || null
        };

        lazyMapStatus = 'initialized';
        return activeRestaurantMap;
    } catch (err) {
        console.warn('Map initialization error:', err);
        lazyMapStatus = 'failed';
        el.innerHTML = '<div class="map-fallback flex flex-col items-center justify-center h-full p-4 text-center"><p class="text-dark/65 text-sm">Map unavailable.</p></div>';
        return null;
    }
}

/**
 * Lazily initializes the restaurant map using IntersectionObserver.
 * Defers Leaflet initialization and Geoapify tile network requests until
 * the map container approaches the viewport (rootMargin: 300px 0px).
 *
 * @param {object} options
 * @param {HTMLElement|string} options.container - Map container element or selector
 * @param {number} options.latitude - Latitude
 * @param {number} options.longitude - Longitude
 * @param {string} [options.name] - Restaurant name
 * @param {string} [options.address] - Formatted address
 * @returns {string} Status of the lazy loader ('observing' | 'initialized' | 'failed')
 */
function initLazyRestaurantMap(options = {}) {
    const { container, latitude, longitude, name, address } = options;
    const el = typeof container === 'string' ? document.querySelector(container) : container;
    if (!el) return 'failed';

    // 1. Validate coordinates
    if (!isValidRestaurantCoordinate(latitude, longitude)) {
        destroyRestaurantMap(el);
        return 'failed';
    }

    // 2. Prevent duplicate initialization if this exact map is already active
    if (lazyMapStatus === 'initialized' && activeRestaurantMap && activeRestaurantMap.container === el) {
        if (activeRestaurantMap.latitude === latitude && activeRestaurantMap.longitude === longitude) {
            return 'initialized';
        }
    }

    // 3. Clean up any previous map or pending observer
    destroyRestaurantMap(el);

    // 4. Render lightweight placeholder (zero tile requests)
    el.innerHTML = `
      <div class="map-lazy-placeholder flex flex-col items-center justify-center w-full h-full text-dark/45 text-sm gap-2 select-none" data-detail="map-placeholder">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="text-terracotta/75">
          <path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"/>
          <circle cx="12" cy="10" r="3"/>
        </svg>
        <span class="font-medium text-xs tracking-wide">Loading map…</span>
      </div>
    `;

    // 5. Check if IntersectionObserver is supported
    if (typeof IntersectionObserver === 'undefined') {
        // Graceful fallback: initialize map directly if IntersectionObserver is unavailable
        initRestaurantMap(options);
        return lazyMapStatus;
    }

    // 6. Set up IntersectionObserver with rootMargin: 300px 0px
    lazyMapStatus = 'observing';
    const observer = new IntersectionObserver((entries, obs) => {
        for (const entry of entries) {
            if (entry.isIntersecting) {
                // Disconnect immediately to prevent duplicate triggers
                obs.disconnect();
                activeLazyObserver = null;
                // Initialize the real Leaflet map
                initRestaurantMap(options);
                break;
            }
        }
    }, {
        rootMargin: '300px 0px',
        threshold: 0.01
    });

    observer.observe(el);
    activeLazyObserver = observer;
    return 'observing';
}

/**
 * Renders the restaurant location and address.
 * Updates map placeholder aria-label to prevent data leakage.
 * Shows locked fallback "Location unavailable" if address is missing.
 * Initializes Geoapify map visualization lazily if valid coordinates are present.
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

            // Step C7: Lazily initialize Geoapify map only if valid coordinates exist
            if (restaurant && isValidRestaurantCoordinate(restaurant.latitude, restaurant.longitude)) {
                initLazyRestaurantMap({
                    container: locationMap,
                    latitude: restaurant.latitude,
                    longitude: restaurant.longitude,
                    name: restaurant.name,
                    address: location
                });
            } else {
                // Canonical restaurant without coordinates or place without coordinates
                destroyRestaurantMap(locationMap);
            }
        }
        if (addressText) {
            addressText.textContent = location;
        } else if (locationAddress) {
            locationAddress.innerHTML = '<p class="text-lead">' + location + '</p>';
        }
        if (locationAddress) {
            locationAddress.style.display = '';
            locationAddress.removeAttribute('aria-hidden');

            // Render optional contact info (phone / website) if available
            const existingContact = locationAddress.querySelector('.location-contact-info');
            if (existingContact) existingContact.remove();

            if (restaurant && (restaurant.website || restaurant.phone || restaurant.external_links)) {
                const contactDiv = document.createElement('div');
                contactDiv.className = 'location-contact-info mt-3 pt-3 border-t border-dark/10 flex flex-col gap-1.5 text-sm text-dark/75 break-words';
                if (restaurant.phone) {
                    const pPhone = document.createElement('p');
                    pPhone.innerHTML = `<strong>Phone:</strong> <a href="tel:${restaurant.phone}" class="hover:underline text-dark">${restaurant.phone}</a>`;
                    contactDiv.appendChild(pPhone);
                }
                if (Array.isArray(restaurant.external_links) && restaurant.external_links.length > 0) {
                    restaurant.external_links.forEach(link => {
                        if (!link || !link.url) return;
                        const pLink = document.createElement('p');
                        pLink.className = 'break-all';
                        pLink.style.cssText = 'word-break: break-all; overflow-wrap: anywhere;';
                        const label = link.label || 'Tautan';
                        pLink.innerHTML = `<a href="${link.url}" target="_blank" rel="noopener noreferrer" class="external-link hover:underline text-terracotta font-medium inline-flex items-center gap-1.5 break-all" style="word-break: break-all; overflow-wrap: anywhere;"><span>${label}</span> <svg class="w-3.5 h-3.5 inline shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg></a>`;
                        contactDiv.appendChild(pLink);
                    });
                } else if (restaurant.website) {
                    const pWeb = document.createElement('p');
                    pWeb.className = 'break-all';
                    pWeb.style.cssText = 'word-break: break-all; overflow-wrap: anywhere;';
                    pWeb.innerHTML = `<strong>Selengkapnya</strong> <a href="${restaurant.website}" target="_blank" rel="noopener noreferrer" class="hover:underline text-terracotta break-all" style="word-break: break-all; overflow-wrap: anywhere;">${restaurant.website}</a>`;
                    contactDiv.appendChild(pWeb);
                }
                locationAddress.appendChild(contactDiv);
            }
        }
        if (locationEmpty) {
            locationEmpty.style.display = 'none';
            locationEmpty.setAttribute('aria-hidden', 'true');
        }
    } else {
        if (locationMap) {
            destroyRestaurantMap(locationMap);
            locationMap.style.display = 'none';
            locationMap.setAttribute('aria-hidden', 'true');
        }
        if (locationAddress) {
            const existingContact = locationAddress.querySelector('.location-contact-info');
            if (existingContact) existingContact.remove();
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
        if (/24\s*(jam|hours?)/i.test(todayHoursStr)) {
            const statusBadge = document.createElement('span');
            statusBadge.className = 'hours-status-badge badge badge-success';
            statusBadge.style.marginLeft = 'var(--space-2)';
            statusBadge.style.fontSize = 'var(--font-size-xs)';
            statusBadge.style.verticalAlign = 'middle';
            statusBadge.textContent = 'Open 24 hours';
            hoursHeading.appendChild(statusBadge);
        } else {
            const timeMatch = todayHoursStr.match(/(\d{1,2}):(\d{2})\s*[–-]\s*(\d{1,2}):(\d{2})/);
            if (timeMatch) {
                const now = new Date();
                const currentMins = now.getHours() * 60 + now.getMinutes();
                const openMins = parseInt(timeMatch[1], 10) * 60 + parseInt(timeMatch[2], 10);
                const closeMins = parseInt(timeMatch[3], 10) * 60 + parseInt(timeMatch[4], 10);

                let statusText = '';
                let badgeClass = 'badge badge-neutral';

                if (currentMins >= openMins && currentMins < closeMins) {
                    if (openMins === 0 && closeMins === 1440) {
                        statusText = 'Open 24 hours';
                        badgeClass = 'badge badge-success';
                    } else if (closeMins - currentMins <= 30) {
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
            const existingNotice = main.querySelector('.reservation-not-found, .reservation-unavailable');
            if (existingNotice) existingNotice.remove();

            const notFound = document.createElement('section');
            notFound.className = 'page-header reservation-not-found';
            notFound.style.cssText = 'padding-block: var(--section-space-xl); text-align: center;';
            notFound.innerHTML = `
              <div class="container">
                <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; gap: var(--space-4); max-width: 520px; margin-inline: auto;">
                  <h1 class="empty-state-title">Restaurant not found</h1>
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

    // Handle restaurants with reservations disabled
    if (!restaurant.reservation_enabled) {
        document.title = `Reservations Unavailable – ${restaurant.name} – BiteMap`;
        const pageHeader = $('.page-header');
        if (pageHeader) pageHeader.style.display = 'none';
        if (reservationFlow) reservationFlow.style.display = 'none';

        const main = document.getElementById('main-content');
        if (main) {
            const existingNotice = main.querySelector('.reservation-not-found, .reservation-unavailable');
            if (existingNotice) existingNotice.remove();

            const notice = document.createElement('section');
            notice.className = 'page-header reservation-unavailable';
            notice.style.cssText = 'padding-block: var(--section-space-xl); text-align: center;';
            notice.innerHTML = `
              <div class="container">
                <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; gap: var(--space-4); max-width: 520px; margin-inline: auto;">
                  <h1 class="empty-state-title">Online reservations unavailable</h1>
                  <p class="empty-state-desc text-muted">Online reservations are currently unavailable for ${escapeMapHtml(restaurant.name)}. Please check back later or contact the restaurant directly.</p>
                  <div style="display: flex; gap: var(--space-3); flex-wrap: wrap; justify-content: center; margin-top: var(--space-2);">
                    <a href="restaurant.html?id=${encodeURIComponent(restaurant.id)}" class="btn btn-outline">View Restaurant</a>
                    <a href="explore.html" class="btn btn-primary">Back to Explore</a>
                  </div>
                </div>
              </div>
            `;
            if (typeof main.prepend === 'function') {
                main.prepend(notice);
            } else if (main.firstChild) {
                main.insertBefore(notice, main.firstChild);
            } else {
                main.appendChild(notice);
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
    const fallbackEl = document.querySelector('[data-detail="ticket-fallback"]');
    const ticketContent = document.querySelector('[data-detail="ticket-content"]');
    const printBtn = $('.btn-print-ticket');
    const viewRestaurantBtn = document.querySelector('[data-detail="ticket-view-restaurant"]') || $('.ticket-actions a.btn-primary');
    const ticketName = document.querySelector('[data-detail="ticket-restaurant-name"]') || $('.ticket-restaurant h3') || $('.ticket-restaurant h2');
    const ticketCategory = document.querySelector('[data-detail="ticket-restaurant-category"]') || $('.ticket-restaurant p');
    const ticketDate = document.querySelector('[data-detail="ticket-date"]');
    const ticketTime = document.querySelector('[data-detail="ticket-time"]');
    const ticketGuests = document.querySelector('[data-detail="ticket-guests"]');
    const ticketGuestItem = document.querySelector('[data-detail="ticket-guest-item"]');
    const ticketGuestName = document.querySelector('[data-detail="ticket-guest-name"]');

    if (!ticketName && !printBtn && !fallbackEl) return;

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const restaurant = id ? getRestaurantById(id) : null;

    if (!restaurant || !restaurant.reservation_enabled) {
        if (fallbackEl) {
            fallbackEl.style.display = '';
            fallbackEl.removeAttribute('aria-hidden');
        }
        if (ticketContent) {
            ticketContent.style.display = 'none';
            ticketContent.setAttribute('aria-hidden', 'true');
        }
        document.title = 'Reservation Ticket — BiteMap';
        return;
    }

    if (fallbackEl) {
        fallbackEl.style.display = 'none';
        fallbackEl.setAttribute('aria-hidden', 'true');
    }
    if (ticketContent) {
        ticketContent.style.display = '';
        ticketContent.removeAttribute('aria-hidden');
    }

    if (ticketName) ticketName.textContent = restaurant.name;
    if (ticketCategory) {
        const parts = [restaurant.category];
        if (restaurant.cuisine) parts.push(restaurant.cuisine);
        ticketCategory.textContent = parts.join(' · ');
    }
    if (viewRestaurantBtn) {
        viewRestaurantBtn.setAttribute('href', 'restaurant.html?id=' + encodeURIComponent(restaurant.id));
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

let activeDetailController = null;

function showRestaurantNotFound(main) {
    if (!main) return;
    destroyRestaurantMap();
    document.title = 'Restaurant Not Found – BiteMap';

    main.querySelectorAll('section, .location-hours-wrapper').forEach(function(el) {
        el.style.display = 'none';
    });

    const notFound = document.createElement('section');
    notFound.className = 'page-header restaurant-not-found';
    notFound.style.cssText = 'padding-block: var(--section-space-xl); text-align: center;';
    notFound.innerHTML = `
      <div class="container">
        <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; gap: var(--space-4); max-width: 520px; margin-inline: auto;">
          <h1 class="empty-state-title">Restaurant not found</h1>
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
}

function showRestaurantError(main, message) {
    if (!main) return;
    destroyRestaurantMap();
    document.title = 'Unable to Load Restaurant – BiteMap';

    main.querySelectorAll('section, .location-hours-wrapper').forEach(function(el) {
        el.style.display = 'none';
    });

    const errorSection = document.createElement('section');
    errorSection.className = 'page-header restaurant-error-state';
    errorSection.style.cssText = 'padding-block: var(--section-space-xl); text-align: center;';
    errorSection.innerHTML = `
      <div class="container">
        <div class="empty-state" style="display: flex; flex-direction: column; align-items: center; gap: var(--space-4); max-width: 520px; margin-inline: auto;">
          <h1 class="empty-state-title">Unable to load restaurant details</h1>
          <p class="empty-state-desc text-muted">${message || "We encountered an issue fetching live details for this place. Please try again later or return to Explore."}</p>
          <a href="explore.html" class="btn btn-primary" style="margin-top: var(--space-2);">Back to Explore</a>
        </div>
      </div>
    `;
    if (typeof main.prepend === 'function') {
        main.prepend(errorSection);
    } else if (main.firstChild) {
        main.insertBefore(errorSection, main.firstChild);
    } else {
        main.appendChild(errorSection);
    }
}

function renderRestaurantLoading(main) {
    if (!main) return;
    destroyRestaurantMap();
    document.title = 'Loading restaurant details… – BiteMap';

    // Remove any previous not-found or error notice
    const existingNotice = main.querySelector('.restaurant-not-found, .restaurant-error-state');
    if (existingNotice) existingNotice.remove();

    // Ensure sections are visible
    main.querySelectorAll('section, .location-hours-wrapper').forEach(function(el) {
        el.style.display = '';
    });

    const nameEl = document.querySelector('[data-detail="name"]');
    if (nameEl) nameEl.textContent = 'Loading place details…';

    const categoryEl = document.querySelector('[data-detail="category"]');
    if (categoryEl) categoryEl.textContent = '…';

    const metaEl = document.querySelector('[data-detail="meta"]');
    if (metaEl) metaEl.innerHTML = '<span class="inline-block animate-pulse text-dark/50" role="status">Loading restaurant details…</span>';

    const descEl = document.querySelector('[data-detail="description"]');
    if (descEl) descEl.textContent = 'Fetching verified details from Geoapify…';

    const descLongEl = document.querySelector('[data-detail="description-long"]');
    if (descLongEl) descLongEl.style.display = 'none';

    const reserveBtn = document.querySelector('[data-detail="reserve-btn"]');
    if (reserveBtn) reserveBtn.style.display = 'none';

    const ctaReserveBtn = document.querySelector('[data-detail="cta-reserve-btn"]');
    if (ctaReserveBtn) ctaReserveBtn.style.display = 'none';

    const ctaText = document.querySelector('[data-detail="reservation-cta-text"]');
    if (ctaText) ctaText.textContent = 'Loading details…';

    const addressText = document.querySelector('[data-detail="address-text"]');
    if (addressText) addressText.textContent = 'Loading address…';

    const locationMap = document.querySelector('[data-detail="location-map"]');
    if (locationMap) {
        locationMap.innerHTML = '<div class="flex items-center justify-center w-full h-full text-dark/40 text-sm animate-pulse"><span>Loading map…</span></div>';
    }

    const hoursList = document.querySelector('[data-detail="hours-list"]');
    if (hoursList) {
        hoursList.innerHTML = '<div class="text-sm text-dark/50 py-2 animate-pulse">Loading opening hours…</div>';
        hoursList.style.display = '';
    }

    const menuContainer = document.querySelector('[data-detail="menu-container"]');
    if (menuContainer) {
        menuContainer.innerHTML = '<div class="text-sm text-dark/50 py-4 animate-pulse">Checking menu availability…</div>';
        menuContainer.style.display = '';
    }

    const galleryGrid = document.querySelector('[data-detail="gallery-grid"]');
    if (galleryGrid) {
        galleryGrid.innerHTML = '';
    }

    // Hide empty state elements while loading
    ['about-empty', 'gallery-empty', 'menu-empty', 'location-empty', 'hours-empty'].forEach(key => {
        const el = document.querySelector(`[data-detail="${key}"]`);
        if (el) {
            el.style.display = 'none';
            el.setAttribute('aria-hidden', 'true');
        }
    });
}

function renderRestaurantContent(restaurant, main) {
    if (!restaurant) return;

    // Restore regular sections in case they were previously hidden
    if (main) {
        const existingNotice = main.querySelector('.restaurant-not-found, .restaurant-error-state');
        if (existingNotice) existingNotice.remove();
        main.querySelectorAll('section, .location-hours-wrapper').forEach(function(el) {
            el.style.display = '';
        });
    }

    // -- Bind identity fields -----------------------
    document.title = restaurant.name + ' – BiteMap';
    const nameEl = document.querySelector('[data-detail="name"]');
    if (nameEl) nameEl.textContent = restaurant.name;

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
        } else if (typeof restaurant.distance === 'string' && restaurant.distance.trim()) {
            metaParts.push(restaurant.distance.trim());
        }
        metaEl.innerHTML = metaParts.join(' &bull; ');
    }

    const heroImg = document.querySelector('[data-detail="hero-image"]');
    if (heroImg) {
        heroImg.setAttribute('aria-label', restaurant.name + ' exterior view');
        const heroPath = restaurant.hero_image || restaurant.image;
        if (heroPath) {
            heroImg.style.backgroundImage = 'url("' + getAssetPath(heroPath) + '")';
            heroImg.style.backgroundSize = 'cover';
            heroImg.style.backgroundPosition = 'center';
            heroImg.style.backgroundRepeat = 'no-repeat';
        } else {
            heroImg.style.backgroundImage = '';
        }
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

function initRestaurantDetail() {
    // Guard: only run on restaurant.html pages (identified by data-detail hook)
    const nameEl = document.querySelector('[data-detail="name"]');
    if (!nameEl) return;

    const main = document.getElementById('main-content');
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    // Clean up any previous not-found or error notice
    if (main) {
        const existingNotice = main.querySelector('.restaurant-not-found, .restaurant-error-state');
        if (existingNotice) existingNotice.remove();
    }

    if (!id || !id.trim()) {
        showRestaurantNotFound(main);
        return;
    }

    // 1. Check if ID matches a canonical local restaurant
    const canonicalRestaurant = getRestaurantById(id);
    if (canonicalRestaurant) {
        renderRestaurantContent(canonicalRestaurant, main);
        return;
    }

    // 2. Check if ID is an external Geoapify place
    if (id.startsWith('geo-')) {
        // Abort previous pending request if any to avoid race conditions
        if (activeDetailController) {
            activeDetailController.abort();
            activeDetailController = null;
        }
        activeDetailController = new AbortController();
        const signal = activeDetailController.signal;

        renderRestaurantLoading(main);

        fetchGeoapifyPlaceDetails(id, signal)
            .then(res => {
                if (signal.aborted) return;
                if (res.ok && res.restaurant) {
                    renderRestaurantContent(res.restaurant, main);
                } else if (res.status === 400 || res.status === 404) {
                    showRestaurantNotFound(main);
                } else {
                    showRestaurantError(main, 'We encountered an issue fetching live details for this place. Please try again or return to Explore.');
                }
            })
            .catch(err => {
                if (err.name === 'AbortError' || signal.aborted) return;
                showRestaurantError(main, 'We encountered a network issue loading this place. Please check your connection or return to Explore.');
            });
        return;
    }

    // 3. Unknown ID
    showRestaurantNotFound(main);
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
            emptyState.style.display = 'flex';
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
            emptyState.style.display = 'flex';
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
    const hasFavorites = count > 0;

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
            emptyState.style.display = 'flex';
            emptyState.removeAttribute('aria-hidden');
        }
    }
}

// ==========================================
// Dashboard Data Rendering Foundation
// ==========================================

/**
 * Renders the dashboard favorites grid from canonical data and updates empty state.
 */
function renderDashboardFavoritesGrid() {
    const favGrid = document.querySelector('[data-detail="dashboard-favorites-grid"]');
    if (!favGrid) return;
    const favoriteRestaurants = getFavoriteRestaurants();

    const fragment = document.createDocumentFragment();
    favoriteRestaurants.forEach(restaurant => {
        // Dashboard is in /pages/, so linkBase uses local page extension
        const linkBase = 'restaurant' + getPageExtension();
        fragment.appendChild(createRestaurantCard(restaurant, linkBase, true));
    });
    favGrid.innerHTML = '';
    favGrid.appendChild(fragment);
    initFavorites(favGrid);
    updateFavoritesState();
}

/**
 * Initializes dashboard data rendering for dashboard.html.
 * Renders persisted favorites from canonical BITEMAP_RESTAURANTS.
 * Aligns upcoming reservation restaurant identity with canonical data.
 * Controls section and empty-state visibility safely from local DOM state.
 * Does not implement fake accounts or backend booking.
 */
function initDashboard() {
    const dashboardHeader = $('.dashboard-header');
    if (!dashboardHeader) return;

    // 1. Render favorites grid from canonical data
    renderDashboardFavoritesGrid();

    // 2. Align upcoming reservation restaurant identity with canonical data
    const upcomingCard = document.querySelector('.upcoming-reservation-card');
    if (upcomingCard) {
        const id = upcomingCard.getAttribute('data-restaurant-id');
        const restaurant = id ? getRestaurantById(id) : null;
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
// Authentication Forms & Demonstration Notice
// ==========================================

function initAuth() {
    const authCard = $('.customer-auth-card');
    if (!authCard) return;

    const form = $('.auth-form', authCard);
    if (!form || form.dataset.authBound) return;
    form.dataset.authBound = 'true';

    function clearFieldError(input) {
        input.classList.remove('is-error');
        input.removeAttribute('aria-invalid');
        const parent = input.closest('.form-group') || input.parentNode;
        const errEl = parent ? parent.querySelector('.form-error-msg') : null;
        if (errEl) errEl.remove();
        input.removeAttribute('aria-describedby');
    }

    function setFieldError(input, message) {
        clearFieldError(input);
        input.classList.add('is-error');
        input.setAttribute('aria-invalid', 'true');
        const errorId = (input.id || 'field') + '-error';
        input.setAttribute('aria-describedby', errorId);

        const msgEl = document.createElement('span');
        msgEl.id = errorId;
        msgEl.className = 'form-error-msg';
        msgEl.setAttribute('role', 'alert');
        msgEl.textContent = message;
        input.insertAdjacentElement('afterend', msgEl);
    }

    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            if (input.classList.contains('is-error')) {
                clearFieldError(input);
            }
        });
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Clear existing errors & banners
        inputs.forEach(input => clearFieldError(input));
        const existingBanner = authCard.querySelector('.auth-status-banner');
        if (existingBanner) existingBanner.remove();

        let hasError = false;
        let firstInvalidInput = null;

        // 1. Full name validation (Register page)
        const nameInput = form.querySelector('#full-name');
        if (nameInput) {
            const val = nameInput.value.trim();
            if (!val) {
                setFieldError(nameInput, 'Please enter your full name.');
                hasError = true;
                if (!firstInvalidInput) firstInvalidInput = nameInput;
            }
        }

        // 2. Email validation (Login & Register)
        const emailInput = form.querySelector('#email');
        if (emailInput) {
            const val = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!val) {
                setFieldError(emailInput, 'Email address is required.');
                hasError = true;
                if (!firstInvalidInput) firstInvalidInput = emailInput;
            } else if (!emailRegex.test(val)) {
                setFieldError(emailInput, 'Please enter a valid email address.');
                hasError = true;
                if (!firstInvalidInput) firstInvalidInput = emailInput;
            }
        }

        // 3. Password validation (Login & Register)
        const passwordInput = form.querySelector('#password');
        if (passwordInput) {
            const val = passwordInput.value;
            if (!val) {
                setFieldError(passwordInput, 'Password is required.');
                hasError = true;
                if (!firstInvalidInput) firstInvalidInput = passwordInput;
            } else if (val.length < 8) {
                setFieldError(passwordInput, 'Password must be at least 8 characters long.');
                hasError = true;
                if (!firstInvalidInput) firstInvalidInput = passwordInput;
            }
        }

        // 4. Confirm password validation (Register)
        const confirmInput = form.querySelector('#password-confirm');
        if (confirmInput) {
            const val = confirmInput.value;
            const passVal = passwordInput ? passwordInput.value : '';
            if (!val) {
                setFieldError(confirmInput, 'Please confirm your password.');
                hasError = true;
                if (!firstInvalidInput) firstInvalidInput = confirmInput;
            } else if (val !== passVal) {
                setFieldError(confirmInput, 'Passwords do not match.');
                hasError = true;
                if (!firstInvalidInput) firstInvalidInput = confirmInput;
            }
        }

        // Always clear password inputs immediately on submit for security hygiene
        const passwordInputs = form.querySelectorAll('input[type="password"]');
        passwordInputs.forEach(p => { p.value = ''; });

        if (hasError) {
            if (firstInvalidInput) firstInvalidInput.focus();
            return;
        }

        // Honest demonstration notice banner
        const isRegister = !!nameInput;
        const banner = document.createElement('div');
        banner.className = 'auth-status-banner mt-6';
        banner.setAttribute('role', 'status');
        banner.setAttribute('aria-live', 'polite');
        banner.innerHTML = `
            <div style="font-weight: 600; margin-bottom: 4px; color: var(--color-primary, #C85C3A);">Demonstration Notice</div>
            <div>${isRegister ? 'Account creation' : 'User authentication'} is currently in preview mode. Server-side authentication and session management are scheduled for the upcoming backend phase. No credentials were saved or submitted.</div>
        `;

        form.insertAdjacentElement('afterend', banner);
    });
}

// ==========================================
// Admin Portal (Demonstration Navigation & Feedback)
// ==========================================

function initAdmin() {
    const adminMain = $('.admin-main');
    if (!adminMain) return;

    const sidebarNav = $('.admin-nav');
    if (sidebarNav && !sidebarNav.dataset.adminBound) {
        sidebarNav.dataset.adminBound = 'true';
        const navLinks = sidebarNav.querySelectorAll('a[href^="#"]');

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const targetId = link.getAttribute('href').slice(1);
                const targetEl = document.getElementById(targetId);
                if (targetEl) {
                    e.preventDefault();
                    // Update active state in sidebar
                    navLinks.forEach(l => {
                        l.removeAttribute('aria-current');
                    });
                    link.setAttribute('aria-current', 'page');

                    targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // Update URL hash without jumping
                    window.history.replaceState(null, '', '#' + targetId);
                }
            });
        });
    }

    // Inert management action feedback
    const managementSection = $('#management');
    if (managementSection && !managementSection.dataset.actionsBound) {
        managementSection.dataset.actionsBound = 'true';
        const actionButtons = managementSection.querySelectorAll('button');

        actionButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const card = btn.closest('.card');
                const actionTitle = (card && card.querySelector('h3')) ? card.querySelector('h3').textContent.trim() : 'This management feature';

                let notice = managementSection.querySelector('.admin-action-notice');
                if (!notice) {
                    notice = document.createElement('div');
                    notice.className = 'admin-action-notice auth-status-banner mt-6';
                    notice.setAttribute('role', 'status');
                    notice.setAttribute('aria-live', 'polite');
                    managementSection.appendChild(notice);
                }
                notice.innerHTML = `<div style="font-weight: 600; margin-bottom: 4px; color: var(--color-primary, #C85C3A);">Demonstration Preview</div><div><strong>${actionTitle}</strong> is a demonstration interface. Backend administrative API endpoints and live data synchronization are scheduled for the upcoming phase.</div>`;
                notice.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        });
    }
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
    initLocationAutocomplete();
    initRestaurantDetail();
    initDashboard();
    initMobileNavigation();
    initExploreFilters();
    initFavorites();
    initFavoritesCrossTabSync();
    initRestaurantGallery();
    initReservation();
    initReservationTicket();
    initAuth();
    initAdmin();
}

initBiteMap();