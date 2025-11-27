<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Naruto Uzumaki - Hokage T-Shirt',
                'description' => 'Premium cotton t-shirt featuring Naruto Uzumaki in his Hokage attire. Soft, comfortable, and perfect for everyday wear.',
                'price' => 24.99,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 50
            ],
            [
                'name' => 'One Piece - Straw Hat Crew T-Shirt',
                'description' => 'Official One Piece t-shirt with the Straw Hat Crew design. 100% cotton with vibrant, long-lasting print.',
                'price' => 22.99,
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 45
            ],
            [
                'name' => 'Attack on Titan - Wings of Freedom T-Shirt',
                'description' => 'Survey Corps inspired t-shirt with the iconic Wings of Freedom emblem. Comfortable fit for true Scouts.',
                'price' => 26.99,
                'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 35
            ],
            [
                'name' => 'My Hero Academia - UA High School T-Shirt',
                'description' => 'Show your hero spirit with this UA High School t-shirt. Premium cotton with embroidered logo details.',
                'price' => 23.99,
                'image' => 'https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 40
            ],
            [
                'name' => 'Demon Slayer - Hashira T-Shirt',
                'description' => 'Featuring all nine Hashira designs. Soft, breathable fabric perfect for training or casual wear.',
                'price' => 25.99,
                'image' => 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 30
            ],
            [
                'name' => 'Jujutsu Kaisen - Gojo Satoru T-Shirt',
                'description' => 'The strongest sorcerer deserves the coolest t-shirt. Features Gojo\'s iconic blindfold look.',
                'price' => 27.99,
                'image' => 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 25
            ],
            [
                'name' => 'Tokyo Revengers - Toman Gang T-Shirt',
                'description' => 'Official Tokyo Revengers T-shirt with Toman gang design. 100% premium cotton for maximum comfort.',
                'price' => 24.99,
                'image' => 'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 38
            ],
            [
                'name' => 'Dragon Ball Z - Super Saiyan T-Shirt',
                'description' => 'Go Super Saiyan with this vibrant Goku t-shirt. High-quality print that won\'t fade after washing.',
                'price' => 26.99,
                'image' => 'https://images.unsplash.com/photo-1572635148818-ef6fd45eb394?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 42
            ],
            [
                'name' => 'Chainsaw Man - Denji & Pochita T-Shirt',
                'description' => 'Show your love for Chainsaw Man with this Denji and Pochita design. Soft, comfortable everyday wear.',
                'price' => 25.99,
                'image' => 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 28
            ],
            [
                'name' => 'Spy x Family - Forger Family T-Shirt',
                'description' => 'Adorable t-shirt featuring Anya, Loid, and Yor Forger. Perfect for family outings or casual days.',
                'price' => 23.99,
                'image' => 'https://images.unsplash.com/photo-1587660962163-9ffda1c8c488?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'stock' => 33,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Successfully seeded ' . count($products) . ' t-shirts!');
    }
}