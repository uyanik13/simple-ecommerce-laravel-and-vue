<?php

namespace Evention\Elequent\Traits\Relations;

use App\Models\Product;

trait HasProduct
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}