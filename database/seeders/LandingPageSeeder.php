<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\Category;
use App\Models\AboutSection;
use App\Models\Feature;
use App\Models\FooterSection;
use App\Models\SocialMedia;
use App\Models\Product;
use App\Models\Contact;
use App\Models\BusinessHour;
use Illuminate\Support\Str;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. HERO SECTION
        HeroSection::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Toko Roti Terbaik',
                'subtitle' => 'Segar & Lezat',
                'description' => 'Nikmati berbagai macam roti dan kue segar buatan tangan. Pesan online dengan mudah dan cepat.',
                'cake_image' => 'cake1.png',
                'strawberry_left' => 's1.png',
                'strawberry_right' => 's2.png',
                'button_text' => 'Lihat Produk',
                'button_link' => '#terlaris',
                'is_active' => true,
            ]
        );
        $this->command->info('✓ Hero section created');

        // 2. CATEGORIES
        $categories = [
            [
                'name' => 'Cup Cake',
                'image' => 'c1.png',
                'description' => 'Cup cake lembut dengan berbagai topping manis dan menarik',
                'order' => 1,
            ],
            [
                'name' => 'Donut',
                'image' => 'c2.png',
                'description' => 'Donat lembut dengan glaze dan topping premium',
                'order' => 2,
            ],
            [
                'name' => 'Cake',
                'image' => 'c4.png',
                'description' => 'Kue tart dan bolu dengan berbagai varian rasa',
                'order' => 3,
            ],
            [
                'name' => 'Biscuit',
                'image' => 'c7.png',
                'description' => 'Kue kering renyah dengan resep spesial',
                'order' => 4,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'image' => $cat['image'],
                    'description' => $cat['description'],
                    'order' => $cat['order'],
                    'is_active' => true,
                ]
            );
        }
        $this->command->info('✓ Categories created');

        // 3. ABOUT SECTION
        AboutSection::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Tentang Bakery Chrips',
                'description' => 'BakeryChrips adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik. Berdiri sejak 2020, kami telah melayani ribuan pelanggan dengan produk-produk berkualitas.',
                'image' => 'c8.png',
                'is_active' => true,
            ]
        );
        $this->command->info('✓ About section created');

        // 4. FEATURES
        $features = [
            [
                'title' => 'Bahan-bahan segar dan alami',
                'description' => 'Kami hanya menggunakan bahan-bahan berkualitas tinggi dan segar setiap hari',
                'icon' => 'bi-check-lg',
                'order' => 1,
            ],
            [
                'title' => 'Pengiriman cepat dan aman',
                'description' => 'Pengiriman dengan kemasan aman dan driver profesional',
                'icon' => 'bi-truck',
                'order' => 2,
            ],
            [
                'title' => 'Tampilan modern dan mudah digunakan',
                'description' => 'Website modern untuk kemudahan pemesanan',
                'icon' => 'bi-phone',
                'order' => 3,
            ],
            [
                'title' => 'Harga terjangkau',
                'description' => 'Kualitas premium dengan harga yang bersahabat',
                'icon' => 'bi-wallet',
                'order' => 4,
            ],
        ];

        foreach ($features as $feature) {
            Feature::updateOrCreate(
                ['title' => $feature['title']],
                [
                    'description' => $feature['description'],
                    'icon' => $feature['icon'],
                    'order' => $feature['order'],
                    'is_active' => true,
                ]
            );
        }
        $this->command->info('✓ Features created');

        // 5. FOOTER SECTION
        FooterSection::updateOrCreate(
            ['id' => 1],
            [
                'description' => 'Roti fresh setiap hari, dibuat dari bahan berkualitas dan rasa terbaik untuk keluarga. Nikmati kelezatan roti dan kue buatan tangan dengan resep tradisional dan sentuhan modern.',
                'address' => 'Jl. Raya Bandung No. 123, Bandung, Jawa Barat 40123',
                'phone' => '+62 812 3456 7890',
                'email' => 'bakerychrips@gmail.com',
                'copyright' => '© 2025 BakeryChrips. All Rights Reserved.',
                'is_active' => true,
            ]
        );
        $this->command->info('✓ Footer section created');

        // 6. SOCIAL MEDIA
        $socials = [
            [
                'platform' => 'Instagram',
                'icon' => 'bi-instagram',
                'url' => 'https://instagram.com/bakerychrips',
                'order' => 1,
            ],
            [
                'platform' => 'Facebook',
                'icon' => 'bi-facebook',
                'url' => 'https://facebook.com/bakerychrips',
                'order' => 2,
            ],
            [
                'platform' => 'TikTok',
                'icon' => 'bi-tiktok',
                'url' => 'https://tiktok.com/@bakerychrips',
                'order' => 3,
            ],
            [
                'platform' => 'Twitter',
                'icon' => 'bi-twitter',
                'url' => 'https://twitter.com/bakerychrips',
                'order' => 4,
            ],
        ];

        foreach ($socials as $social) {
            SocialMedia::updateOrCreate(
                ['platform' => $social['platform']],
                [
                    'icon' => $social['icon'],
                    'url' => $social['url'],
                    'order' => $social['order'],
                    'is_active' => true,
                ]
            );
        }
        $this->command->info('✓ Social media created');

        // 7. PRODUCTS
        $products = [
            [
                'name' => 'Cookies',
                'category' => 'Biscuit',
                'description' => 'Cookies renyah dengan chocochips dan kacang pilihan. Cocok untuk teman minum teh atau kopi.',
                'price' => 25000,
                'rating' => 4.8,
                'image' => 'c7.png',
                'is_best_seller' => true,
            ],
            [
                'name' => 'Chess Cake',
                'category' => 'Cake',
                'description' => 'Kue lembut dengan lapisan keju cream yang manis dan gurih. Topping buah segar di atasnya.',
                'price' => 25000,
                'rating' => 4.8,
                'image' => 'c9.png',
                'is_best_seller' => true,
            ],
            [
                'name' => 'Brownies Panggang',
                'category' => 'Cake',
                'description' => 'Brownies panggang lembut dengan rasa coklat kuat. Tekstur moist dan topping almond.',
                'price' => 15000,
                'rating' => 4.7,
                'image' => 'c5.png',
                'is_best_seller' => true,
            ],
            [
                'name' => 'Butter Cake',
                'category' => 'Cake',
                'description' => 'Kue mentega klasik dengan aroma butter premium. Lembut dan lumer di mulut.',
                'price' => 35000,
                'rating' => 4.9,
                'image' => 'cake1.png',
                'is_best_seller' => true,
            ],
            [
                'name' => 'Sweet Donuts',
                'category' => 'Donut',
                'description' => 'Donat lembut dengan glaze manis dan topping warna-warni. Tersedia berbagai varian topping.',
                'price' => 12000,
                'rating' => 4.6,
                'image' => 'c2.png',
                'is_best_seller' => true,
            ],
            [
                'name' => 'Strawberry Cake',
                'category' => 'Cake',
                'description' => 'Kue stroberi segar dengan krim manis dan potongan stroberi asli. Cocok untuk acara spesial.',
                'price' => 55000,
                'rating' => 4.9,
                'image' => 'c4.png',
                'is_best_seller' => true,
            ],
            [
                'name' => 'Cup Cake Red Velvet',
                'category' => 'Cup Cake',
                'description' => 'Cup cake red velvet dengan cream cheese frosting. Manis dan lembut.',
                'price' => 15000,
                'rating' => 4.5,
                'image' => 'c1.png',
                'is_best_seller' => false,
            ],
            [
                'name' => 'Roti Coklat',
                'category' => 'Cake',
                'description' => 'Roti lembut isi coklat meleleh. Topping meses warna-warni.',
                'price' => 18000,
                'rating' => 4.4,
                'image' => 'c5.png',
                'is_best_seller' => false,
            ],
            [
                'name' => 'Kue Kering Nastar',
                'category' => 'Biscuit',
                'description' => 'Kue kering nastar dengan selai nanas homemade. Renyah dan lumer.',
                'price' => 45000,
                'rating' => 4.7,
                'image' => 'c7.png',
                'is_best_seller' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'category' => $product['category'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'rating' => $product['rating'],
                    'image' => $product['image'],
                    'is_best_seller' => $product['is_best_seller'],
                ]
            );
        }
        $this->command->info('✓ Products created');

        // 8. CONTACT INFORMATION
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'whatsapp_number' => '+62 812 3456 7890',
                'whatsapp_message' => 'Halo%20BakeryChrips%2C%20saya%20mau%20tanya%20tentang%20produk%20dan%20pesanan',
                'address' => 'Jl. Raya Bandung No. 123, Bandung, Jawa Barat 40123',
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.731997569548!2d107.6181271!3d-6.917586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e62c3e3b44d1%3A0x654b78d6d0d0b2b9!2sBandung!5e0!3m2!1sen!2sid!4v1632987654321!5m2!1sen!2sid',
                'delivery_info' => 'Gratis ongkir area Bandung untuk pembelian minimal Rp 50.000',
                'parking_info' => 'Parkir luas dan aman untuk motor & mobil',
                'is_active' => true,
            ]
        );
        $this->command->info('✓ Contact information created');

        // 9. BUSINESS HOURS
        $hours = [
            [
                'day' => 'Senin - Jumat',
                'open_time' => '08:00',
                'close_time' => '20:00',
                'order' => 1,
            ],
            [
                'day' => 'Sabtu',
                'open_time' => '08:00',
                'close_time' => '22:00',
                'order' => 2,
            ],
            [
                'day' => 'Minggu',
                'open_time' => '09:00',
                'close_time' => '21:00',
                'order' => 3,
            ],
            [
                'day' => 'Hari Libur Nasional',
                'open_time' => '10:00',
                'close_time' => '18:00',
                'order' => 4,
            ],
        ];

        foreach ($hours as $hour) {
            BusinessHour::updateOrCreate(
                ['day' => $hour['day']],
                [
                    'open_time' => $hour['open_time'],
                    'close_time' => $hour['close_time'],
                    'is_closed' => false,
                    'order' => $hour['order'],
                ]
            );
        }
        $this->command->info('✓ Business hours created');

        $this->command->info('====================================');
        $this->command->info('✅ LANDING PAGE SEEDER COMPLETED!');
        $this->command->info('====================================');
        $this->command->info('Data yang telah diisi:');
        $this->command->info('- Hero Section: 1');
        $this->command->info('- Categories: ' . count($categories));
        $this->command->info('- About Section: 1');
        $this->command->info('- Features: ' . count($features));
        $this->command->info('- Footer Section: 1');
        $this->command->info('- Social Media: ' . count($socials));
        $this->command->info('- Products: ' . count($products));
        $this->command->info('- Contact: 1');
        $this->command->info('- Business Hours: ' . count($hours));
        $this->command->info('====================================');
    }
}