<?php

namespace App\Models;

use App\Models\Pivots\ProductProperty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    use SoftDeletes;

    /**
     * Property types
     */
    const TYPE_TEXT = 0;
    const TYPE_IMAGE = 1;
    const TYPE_NUMBER = 2;
    const TYPE_SELECT = 3;
    const TYPE_TEXTAREA = 4;
    const TYPE_SELECT_MULTI = 5;

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
        //
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
        'values' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->using(ProductProperty::class)
            ->withPivot('value');
    }

    /**
     * @param string|null $value
     * @return void
     */
    public function setKeyAttribute($value = null)
    {
        $value = $value ?? Str::slug($this->name);

        if (static::whereKey($value)->exists()) {
            $value = "{$value}-{$this->id}";
        }

        $this->attributes['key'] = $value;
    }

    /**
     * @return array
     */
    public function getHtmlTypeAttribute()
    {
        return self::getPropertyTypes(true)[$this->type];
    }

    /**
     * @param Builder $query
     * @param $category_id
     * @return Builder
     */
    public function scopeWhereCategory(Builder $query, $category_id)
    {
        return $query->whereHas('categories', function (Builder $query) use ($category_id) {
            $query->isChildren()
                ->where('categories.id', $category_id);
        });
    }

    /**
     * @param bool $withNames
     * @return array
     */
    public static function getPropertyTypes($withNames = false)
    {
        $list = [
            self::TYPE_TEXT => 'text',
            self::TYPE_IMAGE => 'img',
            self::TYPE_NUMBER => 'number',
            self::TYPE_SELECT => 'select',
            self::TYPE_TEXTAREA => 'textarea',
            self::TYPE_SELECT_MULTI => 'multiselect'
        ];

        if(! $withNames) {
            return array_keys($list);
        }

        return $list;
    }
}
