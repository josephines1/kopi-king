<?php

namespace Database\Seeders;

use App\Models\FrontPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrontPage::create([
            'name' => 'home',
            'slug' => 'home',
            'type' => 'page',
            'content' =>
            [
                'hero' => [
                    'title' => 'Welcome to KopiKing',
                    'text' => 'Step into a world of delightful flavors and inviting ambiance. Experience a culinary journey like no other, crafted with passion and served with warmth.',
                    'cta-text' => 'Explore Our Menu',
                    'cta-link' => 'http://laravel11-kopi-king.test/dashboard',
                    'image' => 'front-images/home-hero.jpg'
                ],
                'about' => [
                    'small-title' => 'About Us',
                    'title' => 'Tradition meets innovation',
                    'text' => 'At KopiKing, we take pride in offering you a dining experience that combines culinary creativity with the heart of traditional recipes. Every dish tells a story of flavor, quality, and love for food.',
                    'cta-text' => 'Learn More About Us',
                    'cta-link' => 'http://laravel11-kopi-king.test/dashboard'
                ],
                'product' => [
                    'small-title' => 'Our Signature Dishes',
                    'title' => 'Fresh, Flavorful, Crafted with Passion',
                    'cta-text' => 'View Our Full Menu',
                    'cta-link' => 'http://laravel11-kopi-king.test/dashboard'
                ],
                'contact' => [
                    'small-title' => 'Contact Us',
                    'title' => 'Get in Touch',
                    'text' => 'Whether you have questions, want to make a reservation, or just want to say hi, feel free to reach out to us. We’re always here to help!'
                ]
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        FrontPage::create([
            'name' => 'about',
            'slug' => 'about',
            'type' => 'page',
            'content' => [
                'hero' => [
                    'title' => 'About Us',
                    'text' => 'Established in 2024, KopiKing is built on the foundation of creating memorable experiences through food. Our philosophy is simple: quality ingredients, exceptional service, and a warm atmosphere.',
                    'image' => 'front-images/about-hero.jpg'
                ],
                'mission' => [
                    'small-title' => 'Mission',
                    'title' => 'Inspire and Delight',
                    'text' => 'To bring you closer to the heart of cooking through dishes that inspire and delight.',
                ],
                'vision' => [
                    'small-title' => 'Vision',
                    'title' => 'Creating Experiences',
                    'text' => 'To be the go-to destination for food enthusiasts, creating experiences that resonate with every bite.',
                ],
                'teams' => [
                    'small-title' => 'Meet Our Team',
                    'title' => 'Passionate. Skilled. Dedicated.',
                ],
                'contact' => [
                    'small-title' => 'Contact Us',
                    'title' => 'Get in Touch',
                    'text' => 'Whether you have questions, want to make a reservation, or just want to say hi, feel free to reach out to us. We’re always here to help!'
                ]
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        FrontPage::create([
            'name' => 'menus',
            'slug' => 'menus',
            'type' => 'page',
            'content' => [
                'hero' => [
                    'title' => 'Explore Our Menu',
                    'text' => 'From comforting classics to bold new creations, our menu is crafted to offer something for everyone. Explore our wide range of dishes, carefully prepared using the freshest ingredients.',
                    'image' => 'front-images/menus-hero.jpg'
                ],
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        FrontPage::create([
            'name' => 'contact',
            'slug' => 'contact',
            'type' => 'page',
            'content' => [
                'hero' => [
                    'title' => 'Contact Us',
                    'text' => 'Reach out to us for any inquiries or reservations. We’re just a click away!',
                    'image' => 'front-images/contact-hero.jpg'
                ],
                'location' => [
                    'small-title' => 'location',
                    'title' => 'Visit Us',
                    'text' => 'We’re located at Jakarta Selatan',
                    'cta-text' => 'Get Directions',
                    'cta-link' => 'http://laravel11-kopi-king.test/dashboard',
                    'latitude' => '-6.133860813147106',
                    'longitude' => '106.81449528194443',
                ],
                'contact' => [
                    'small-title' => 'Contact Us',
                    'title' => 'Get in Touch',
                    'text' => 'Whether you have questions, want to make a reservation, or just want to say hi, feel free to reach out to us. We’re always here to help!'
                ]
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        FrontPage::create([
            'name' => 'logo',
            'slug' => 'logo',
            'type' => 'logo',
            'content' => [
                'company' => [
                    'logo' => 'company-images/logo.svg',
                    'name' => 'KopiKing',
                ]
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
