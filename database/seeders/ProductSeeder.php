<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $latestId = Product::orderBy('id', 'desc')->first()->id ?? 0;

        if ($latestId === 0) {
            foreach (static::PRODUCTS as $product) {
                Product::create([
                    'code' => 'P'.++$latestId,
                    ...$product
                ]);
            }
        }

        Product::factory(10)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['code' => 'P'.$latestId + $sequence->index + 1]
            ))
            ->create();
    }

    const PRODUCTS = [
        [
            'name' => "MASK ADULT Surgical 4 ply 50'S MEDICOS with box",
            'category' => 'Health Accessories',
            'brand' => 'Medicos',
            'type' => 'Hygiene',
            'description' => 'Colour: Blue (ear loop outside, ear loop inside- random assigned), Green, Purple, White, Lime Green, Yellow, Pink',
        ],
        [
            'name' => 'Party Cosplay Player Unknown Battlegrounds Clothes Hallowmas PUBG',
            'category' => "Men's Clothing",
            'brand' => 'No Brand',
            'type' => null,
            'description' =>  'Suitable for adults and children.',
        ],
        [
            'name' => 'Xiaomi REDMI 8A Official Global Version 5000 mAh battery champion 31 days 2GB+32GB',
            'category' => 'Mobile & Gadgets',
            'brand' => 'Xiaomi',
            'type' => 'Mobile phones',
            'description' => 'Xiaomi Redmi 8A',
        ],
        [
            'name' => 'Naelofar Sofis - Printed Square',
            'category' => 'Hijab',
            'brand' => 'Naelofar',
            'type' => 'Multi Colour Floral',
            'description' => 'Ornate Iris flower composition with intricate growing foliage',
        ],
        [
            'name' => 'Philips HR2051/HR2056/HR2059 Ice Crushing Blender Jar Mill',
            'category' => 'Small Kitchen Appliances',
            'brand' => 'Philips',
            'type' => 'Mixers and Blenders',
            'description' => 'Philips HR2051 Blender (350W, 1.25L Plastic Jar, 4 stars stainless steel blade)',
        ],
    ];
}
