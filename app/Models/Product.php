<?php

namespace App\Models;

use App\Models\Pivots\ProductProperty;
use Evention\Elequent\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use SoftDeletes, Sluggable;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
    ];

    /**
     * Date casts.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    /**
     * Appends to JSON.
     *
     * @var array
     */
    protected $appends = [
        //
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category'
    ];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)
            ->notChild()
            ->published();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->using(ProductProperty::class)
            ->withPivot('value');
    }

    /**
     * @return Image
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getCoverAttribute()
    {
        if(Cache::has($this->getCoverCacheKey())) {
            return Cache::get($this->getCoverCacheKey());
        }

        $cover = $this->images()->getQuery()->isCover()->value('path');

        Cache::set($this->getCoverCacheKey(), $cover, now()->addHour());

        return $cover;
    }

    /**
     * @return string
     */
    public function getCoverCacheKey()
    {
        return 'product-cover-' . $this->id;
    }
}
