<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Brands ───────────────────────────────────────────
        DB::table('brands')->insert([
            ['brand_name' => 'MAC Cosmetics', 'description' => 'Professional makeup brand', 'is_active' => true],
            ['brand_name' => 'Maybelline', 'description' => 'Affordable everyday makeup', 'is_active' => true],
            ['brand_name' => 'NARS', 'description' => 'Luxury beauty brand', 'is_active' => true],
        ]);

        // ─── Categories ───────────────────────────────────────
        DB::table('categoies')->insert([
            ['category_name' => 'Lips', 'description' => 'Lipsticks and lip products', 'is_active' => true],
            ['category_name' => 'Eyes', 'description' => 'Eye makeup products', 'is_active' => true],
            ['category_name' => 'Face', 'description' => 'Face makeup products', 'is_active' => true],
            ['category_name' => 'Foundation', 'description' => 'Foundation and base products', 'is_active' => true],
            ['category_name' => 'Brushes', 'description' => 'Makeup brushes and tools', 'is_active' => true],
        ]);

        // ─── Products ─────────────────────────────────────────
        DB::table('products')->insert([
            [
                'name'        => 'Velvet Matte Lipstick',
                'description' => 'Long-lasting rich color in 18 shades. Smooth matte finish that lasts all day.',
                'price'       => 18.00,
                'stock'       => 50,
                'brand_id'    => 1,
                'category_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Smokey Eye Palette',
                'description' => 'Professional 12-shade eyeshadow palette for stunning smokey looks.',
                'price'       => 35.00,
                'stock'       => 30,
                'brand_id'    => 2,
                'category_id' => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Glow Foundation',
                'description' => 'Lightweight full coverage foundation in 30 shades. Natural glow finish.',
                'price'       => 42.00,
                'stock'       => 40,
                'brand_id'    => 3,
                'category_id' => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Loose Setting Powder',
                'description' => 'Buildable glow for cheeks and temples. Sets makeup for 24 hours.',
                'price'       => 27.00,
                'stock'       => 25,
                'brand_id'    => 1,
                'category_id' => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Pro Blending Brush Set',
                'description' => 'Professional 5-piece brush set for flawless blending.',
                'price'       => 22.00,
                'stock'       => 60,
                'brand_id'    => 2,
                'category_id' => 5,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        // ─── Product Images ───────────────────────────────────
        DB::table('product_images')->insert([
            ['product_id' => 1, 'image_url' => 'images/lipstick.jpg'],
            ['product_id' => 2, 'image_url' => 'images/eyeshadow.jpg'],
            ['product_id' => 3, 'image_url' => 'images/foundation.jpg'],
            ['product_id' => 4, 'image_url' => 'images/powder.jpg'],
            ['product_id' => 5, 'image_url' => 'images/brushes.jpg'],
        ]);

        // ─── Product Options ──────────────────────────────────
        DB::table('product_option')->insert([
            ['product_id' => 1, 'option_name' => 'Shade', 'option_type' => 'color'],
            ['product_id' => 3, 'option_name' => 'Shade', 'option_type' => 'color'],
        ]);

        // ─── Product Option Values ────────────────────────────
        DB::table('product_option_value')->insert([
            // Lipstick shades
            ['product_option_id' => 1, 'option_value' => 'Ruby Red', 'price_modifier' => 0, 'is_active' => true],
            ['product_option_id' => 1, 'option_value' => 'Nude Pink', 'price_modifier' => 0, 'is_active' => true],
            ['product_option_id' => 1, 'option_value' => 'Berry Bliss', 'price_modifier' => 0, 'is_active' => true],
            ['product_option_id' => 1, 'option_value' => 'Coral Crush', 'price_modifier' => 0, 'is_active' => true],
            // Foundation shades
            ['product_option_id' => 2, 'option_value' => 'Fair', 'price_modifier' => 0, 'is_active' => true],
            ['product_option_id' => 2, 'option_value' => 'Light', 'price_modifier' => 0, 'is_active' => true],
            ['product_option_id' => 2, 'option_value' => 'Medium', 'price_modifier' => 0, 'is_active' => true],
            ['product_option_id' => 2, 'option_value' => 'Dark', 'price_modifier' => 0, 'is_active' => true],
        ]);
    }
}