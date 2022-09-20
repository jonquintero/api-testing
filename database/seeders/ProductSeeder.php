<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();



        $json = File::get("database/data/products.json");

        $products = json_decode($json);

        collect($products->products)->each(function ($item, $key) {

            $skuId = Sku::firstOrCreate(['code' => $item->sku]);
            $categoryId = Category::firstOrCreate(['name' => $item->category]);

            Product::create([
                'sku_id' => $skuId->id,
                'category_id' => $categoryId->id,
                'name' => $item->name,
                'price' => $item->price
            ]);


        });

    }
}
