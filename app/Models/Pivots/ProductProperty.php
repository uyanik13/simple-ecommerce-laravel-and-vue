<?php

namespace App\Models\Pivots;

use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductProperty extends Pivot
{
    /**
     * @param $value
     * @return array
     */
    public function getValueAttribute($value)
    {
        return $this->property->type == Property::TYPE_SELECT_MULTI
            ? explode(", ", $value)
            : $value;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}