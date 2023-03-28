<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Variation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()->count(6)->create();
        $categories->each(function ($c) {
            $c->products()->saveMany(Product::factory(30)->create()->each(function ($p) {
                $p->variations()->saveMany(Variation::factory(2)->create(['product_id' => $p->id]))->each(function ($v) {
                    $v->stock()->save(Stock::factory()->create(['variation_id' => $v->id]));
                    $v->price()->save(Price::factory()->create(['variation_id' => $v->id]));
                });
            }))->make();
        });
    }
}
