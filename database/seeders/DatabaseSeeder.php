<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Design;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Safe to re-run: these accounts are updated if they already exist.
        User::updateOrCreate(
            ['email' => 'admin@nvcreative.com'],
            [
                'name' => 'NV Admin',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        $categories = collect([
            'Hoodies',
            'T-Shirts',
            'Cargo Pants',
            'Accessories',
        ])->mapWithKeys(fn ($name) => [$name => Category::updateOrCreate(['name' => $name])]);

        Product::updateOrCreate(
            ['name' => 'Neon Drift Hoodie'],
            [
                'description' => 'Oversized hoodie with custom NV CREATIVE neon artwork.',
                'price' => 59.99,
                'category_id' => $categories['Hoodies']->id,
                'is_new_arrival' => true,
                'sizes' => 'S,M,L,XL',
                'stock' => 50,
                'discount_percent' => 10,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Visionline Graphic Tee'],
            [
                'description' => 'Premium cotton t-shirt featuring Wear Your Vision print.',
                'price' => 29.99,
                'category_id' => $categories['T-Shirts']->id,
                'is_new_arrival' => true,
                'sizes' => 'S,M,L,XL',
                'stock' => 80,
                'discount_percent' => 5,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Streetform Cargo'],
            [
                'description' => 'Urban fit cargo pants built for all-day comfort.',
                'price' => 49.99,
                'category_id' => $categories['Cargo Pants']->id,
                'is_new_arrival' => false,
                'sizes' => 'M,L,XL',
                'stock' => 40,
                'discount_percent' => 0,
            ]
        );

        Design::updateOrCreate(
            ['title' => 'Gold Line Urban Concept'],
            ['description' => 'Gold-accent concept for limited winter streetwear drop.']
        );

        Design::updateOrCreate(
            ['title' => 'Neon Pulse Capsule'],
            ['description' => 'Futuristic neon-green layout for spring collection.']
        );
    }
}
