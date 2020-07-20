<?php

namespace Evention\Database\Seeds;

use Closure;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Schema;

class SampleDataSeeder extends Seeder
{
    /**
     * Seed some data
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        foreach ($this->callFactory(Product::class) as $product) {
            $this->callFactory(Review::class, [
                'product_id' => $product->id,
            ], 1, false);

            $this->callFactory(Image::class, [
                'product_id' => $product->id
            ], 1, false);
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * @param array $attributes
     * @param Closure|null $callback
     * @param int $count
     * @param bool $truncate
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function products($attributes = [], $count = 10, $truncate = true, Closure $callback = null)
    {
        return $this->callFactory(Product::class, $attributes, $count, $truncate, $callback);
    }

    /**
     * @param array $attributes
     * @param Closure|null $callback
     * @param int $count
     * @param bool $truncate
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function reviews($attributes = [], $count = 10, $truncate = true, Closure $callback = null)
    {
        return $this->callFactory(Review::class, $attributes, $count, $truncate, $callback);
    }

    /**
     * @param array $attributes
     * @param Closure|null $callback
     * @param int $count
     * @param bool $truncate
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function images($attributes = [], $count = 10, $truncate = true, Closure $callback = null)
    {
        return $this->callFactory(Image::class, $attributes, $count, $truncate, $callback);
    }
}