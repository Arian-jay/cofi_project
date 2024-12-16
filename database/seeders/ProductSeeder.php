<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run()
    {

        // Seed products
        Product::insert([

            //promo
            ['name' => 'Biscoff cream',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/promo/biscoff-cream.png',
            'category_id' => 1,
            'updated_by' => 1],

            ['name' => 'dark hot chocolate',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/promo/dark-hot-chocolate.png',
            'category_id' => 1,
            'updated_by' => 1],

            ['name' => 'Peppermint Cocoa',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/promo/peppermint-cocoa.png',
            'category_id' => 1,
            'updated_by' => 1],

            //latte
            ['name' => 'Black Coffee',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/latte/classic black coffee.png',
            'category_id' => 2,
            'updated_by' => 1],

            ['name' => 'Caramel Macchiato',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/latte/classic caramel macchiato.png',
            'category_id' => 2,
            'updated_by' => 1],

            ['name' => 'Hot Cocoa',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/latte/classic hot cocoa.png',
            'category_id' => 2,
            'updated_by' => 1],

            ['name' => 'Classic Latte',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/latte/classic latte.png',
            'category_id' => 2,
            'updated_by' => 1],

            ['name' => 'Matcha Latte',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/latte/matcha latte.png',
            'category_id' => 2,
            'updated_by' => 1],

            ['name' => 'Strawberry Latte',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/latte/strawberry latte.png',
            'category_id' => 2,
            'updated_by' => 1],


            //cold
            ['name' => 'Dalgona coffee',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/cold/dalgona coffee.png',
            'category_id' => 3,
            'updated_by' => 1],

            
            ['name' => 'Strawberry Latte',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/cold/icecream espresso.png',
            'category_id' => 3,
            'updated_by' => 1],

            //premium

            ['name' => 'Berry',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/premium-roast/cofi premium roast series - berry.png',
            'category_id' => 4,
            'updated_by' => 1],
            
            ['name' => 'Chocolate',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/premium-roast/cofi premium roast series - chocolate.png',
            'category_id' => 4,
            'updated_by' => 1],

            ['name' => 'Honey',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/premium-roast/cofi premium roast series - honey.png',
            'category_id' => 4,
            'updated_by' => 1],

            ['name' => 'Plum',
            'description' => 'lami pa kang wendel',
            'price' => 500,
            'stock' => 20,
            'availability' => true,
            'image' => 'images/products/premium-roast/cofi premium roast series - plum.png',
            'category_id' => 4,
            'updated_by' => 1],


    ]);
    }
}
